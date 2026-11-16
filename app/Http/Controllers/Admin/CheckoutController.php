<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

        // [VALIDASI SESSION]: Cek apakah user punya order yang baru dibuat & belum diunggah bukti bayarnya
        if (session()->has('active_invoice')) {
            $activeInvoice = session('active_invoice');
            
            // Order 'menunggu_pembayaran' di DB
            $pendingOrder = Order::where('invoice_number', $activeInvoice)
                ->where('user_id', Auth::id())
                ->where('order_status', 'menunggu_pembayaran')
                ->first();

            if ($pendingOrder) {
                return redirect()->route('frontend.payment.instruction', $activeInvoice)
                    ->with('warning', 'Anda masih memiliki pesanan yang belum diselesaikan. Silakan selesaikan atau unggah bukti pembayaran.');
            } else {
                // Jika status order sudah berubah, hapus session
                session()->forget('active_invoice');
            }
        }


        $address = Address::where('user_id', auth()->user()->id)->first();
        // Tangkap string selected_items (contoh: "1,2,5")
        $selectedIdsRaw = $request->query('selected_items');


        if (!$selectedIdsRaw) {
            return redirect()->route('frontend.cart.list')->with('error', 'Silakan pilih minimal 1 produk untuk dibeli.');
        }

        $selectedIds = explode(',', $selectedIdsRaw);

        // Ambil data keranjang milik user yang sesuai ID dipilih
        $cartItems = Keranjang::with(['produk.vendor', 'produk.kategori'])
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('frontend.cart.index')->with('error', 'Item yang Anda pilih tidak ditemukan.');
        }

        // 3. CEK VALIDASI: Apakah vendor dari produk yang dipilih sudah mengatur pembayaran && vendor yang berbeda
        $vendorId = $cartItems->first()->produk->vendor_id;
        foreach ($cartItems as $item) {

          
            // dd($cartItems);
            if ($item->produk->vendor_id != $vendorId) {

                return redirect()->back()->with('error','Maaf, semua produk yang dipilih harus berasal dari vendor yang sama. Silakan pilih produk dari vendor yang sama.'
             );
    }
            $vendor = $item->produk->vendor ?? null;
            $isPaymentSet = $vendor && $vendor->payment->isNotEmpty();

            if (!$isPaymentSet) {
                $namaVendor = $vendor->nama_vendor ?? $vendor->name ?? 'salah satu produk';

                return redirect()->back()->with(
                    'error',
                    "Maaf, vendor ({$namaVendor}) belum mengatur metode/rekening pembayaran. Silakan pilih produk dari vendor lain."
                );
            }
        }


        // Hitung total belanja awal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += ($item->produk->harga ?? 0) * $item->qty;
        }

        // Contoh biaya pengiriman flat/simulasi (dapat disesuaikan)
        $shippingCost = 15000;
        // $totalPayment = $subtotal + $shippingCost;
        $totalPayment = $subtotal;

        // return view('frontend.checkout.index', compact('cartItems', 'subtotal', 'shippingCost', 'totalPayment', 'selectedIdsRaw', 'address'));
        return response()
        ->view('frontend.checkout.index', compact('cartItems', 'subtotal', 'shippingCost', 'totalPayment', 'selectedIdsRaw', 'address'))
        ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }

    public function process(Request $request)
    {



        $address = Address::where('user_id', auth()->user()->id)->first();
        if (!$address) {

            $request->validate([
                'label_name' => 'required|string|max:100',
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'email' => 'required|email|max:100',
                'kecamatan' => 'required|string|max:100',
                'zip' => 'required|string|max:10',
            ]);

            $address = Address::create([
                'user_id' => auth()->user()->id,
                'label_name' => $request->label_name,
                'name' => $request->name,
                'is_active' => 1,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'kecamatan' => $request->kecamatan,
                'zip' => $request->zip,
            ]);

        }
        $request->validate([
            'metode_bayar' => 'required|in:qris,transfer_bank',
            'metode_kirim' => 'required|in:ditoko,dikirim',
            'selected_items' => 'required|string',
        ]);

        // 1. Hitung ulang total
        $selectedIds = explode(',', $request->selected_items);
        $cartItems = Keranjang::with('produk')->whereIn('id', $selectedIds)->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += ($item->produk->harga ?? 0) * $item->qty;
        }
        $shippingCost = ($request->metode_kirim === 'dikirim') ? 15000 : 0;
        $totalPayment = $subtotal + $shippingCost;

        // 2. Buat Order baru
        $order = Order::create([
            'invoice_number' => 'INV-' . time() . '-' . rand(100, 999),
            'user_id' => Auth::id(),
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total_payment' => $totalPayment,
            'payment_method' => $request->metode_bayar, // 'qris' atau 'transfer_bank'
            'shipping_method' => $request->metode_kirim,
            'payment_status' => 'pending', // pending, paid, rejected
            'order_status' => 'menunggu_pembayaran',
        ]);

        // 3. Simpan detail item & hapus keranjang
        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'produk_id' => $item->produk_id,
                'vendor_id' => $item->produk->vendor_id,
                'qty' => $item->qty,
                'price' => $item->produk->harga,
            ]);
        }
        Keranjang::whereIn('id', $selectedIds)->delete();

        // [SET SESSION LOCK]: Simpan active_invoice ke session
        session(['active_invoice' => $order->invoice_number]);

        // 4. Redirect ke Halaman Instruksi Pembayaran
        return redirect()->route('frontend.payment.instruction', $order->invoice_number);
    }
}
