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


        // $invoice =  Order::where('user_id', Auth::id())->orWhere('order_status', 'menunggu_pembayaran')->latest()->first();
        // $invoice = 
        // cek session untuk halaman checkout
        //   if (session('payment_access') === $invoice->invoice_number) {

        //     return redirect()->route('frontend.payment.instruction', $invoice->invoice_number);
        //  }

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

        // 3. CEK VALIDASI: Apakah vendor dari produk yang dipilih sudah mengatur pembayaran
        foreach ($cartItems as $item) {
            $vendor = $item->produk->vendor ?? null;
            // dd($vendor->payment);


            // $isPaymentSet = $vendor && (!empty($vendor->nomor_rekening) || !empty($vendor->nama_bank ) || !empty($vendor_type)); 

            // if (!$isPaymentSet) {
            //     $namaVendor = $vendor->nama_vendor ?? $vendor->name ?? 'salah satu produk';
            //     return redirect()->back()->with('error', "Maaf, vendor ({$namaVendor}) belum mengatur metode/rekening pembayaran. Silakan pilih produk dari vendor lain.");
            // }
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

        return view('frontend.checkout.index', compact('cartItems', 'subtotal', 'shippingCost', 'totalPayment', 'selectedIdsRaw', 'address'));
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

        // set session untuk pembayaran
        session([
            'payment_access' => $order->invoice_number,
        ]);

        // 4. Redirect ke Halaman Instruksi Pembayaran
        return redirect()->route('frontend.payment.instruction', $order->invoice_number);
    }
}
