<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserOrderController extends Controller
{

    public function index(Request $request)
    {
        $status = $request->query('status', 'semua');
        $query = Order::with(['details.produk', 'details.vendor'])
            ->where('user_id', Auth::id());

        // Filter berdasarkan Tab Status
        if ($status === 'belum_bayar') {
            $query->where('payment_status', 'pending');
        } elseif ($status === 'dikemas') {
            $query->whereIn('payment_status', ['waiting_verification', 'paid'])
                  ->where('order_status', 'diproses');
        } elseif ($status === 'dikirim') {
            $query->where('order_status', 'dikirim');
        } elseif ($status === 'selesai') {
            $query->where('order_status', 'selesai');
        }

        $orders = $query->latest()->paginate(10);

        return view('admin.pesanan.index', compact('orders', 'status'));
    }

    public function pendingOrders()
    {
        $userId = Auth::id();

        // Ambil pesanan yang statusnya menunggu verifikasi pembayaran / konfirmasi penjual
        $orders = Order::with(['details.produk', 'details.vendor'])
            ->where('user_id', $userId)
            ->whereIn('payment_status', ['waiting_verification', 'pending'])
            ->where('order_status', '!=', 'batal')
            ->latest()
            ->paginate(10);

        return view('admin.konfirmasi_pembayaran.index', compact('orders'));
    }

    // Detail Pesanan
    public function show($invoice)
    {
        $order = Order::with(['details.produk', 'details.vendor'])
            ->where('invoice_number', $invoice)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('admin.konfirmasi_pembayaran.detail', compact('order'));
    }

    public function detail_pesanan($invoice)
    {
        $order = Order::with(['details.produk', 'details.vendor', 'user'])
            ->where('invoice_number', $invoice)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('admin.pesanan.detail', compact('order'));
    }


    public function confirmReceiptForm($invoice)
    {
        $order = Order::with('details.produk')
            ->where('invoice_number', $invoice)
            ->where('user_id', Auth::id())
            ->where('order_status', 'dikirim')
            ->firstOrFail();

        return view('admin.upload_bukti_barang.index', compact('order'));
    }

    /**
     * Simpan Bukti Penerimaan & Ubah Status ke Selesai
     */
    public function storeReceipt(Request $request, $id)
    {
        $request->validate([
            'bukti_penerimaan' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072', // Maksimal 3MB
        ], [
            'bukti_penerimaan.required' => 'Foto bukti penerimaan barang wajib diunggah.',
            'bukti_penerimaan.image'    => 'File harus berupa gambar.',
            'bukti_penerimaan.mimes'    => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'bukti_penerimaan.max'      => 'Ukuran foto maksimal 3MB.',
        ]);

        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Upload Gambar Bukti Terima
        if ($request->hasFile('bukti_penerimaan')) {
            // Hapus gambar lama jika ada
            if ($order->bukti_penerimaan && Storage::disk('local')->exists($order->bukti_penerimaan)) {
                Storage::disk('local')->delete($order->bukti_penerimaan);
            }

            $path = $request->file('bukti_penerimaan')->store('bukti_penerimaan', 'local');
            $order->bukti_penerimaan = $path;
        }

        // Update status order menjadi selesai
        $order->order_status = 'selesai';
        $order->received_at  = now();
        $order->save();

        return redirect()->route('user.orders.detail_pesanan', $order->invoice_number)
            ->with('success', 'Terima kasih! Pesanan telah berhasil dikonfirmasi selesai.');
    }
}
