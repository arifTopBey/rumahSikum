<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\VendorPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function instruction($invoice)
    {
        $order = Order::
            where('invoice_number', $invoice)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // [VALIDASI STATUS]: Jika status sudah bukan 'menunggu_pembayaran', lempar user ke riwayat pesanan
        if ($order->order_status !== 'menunggu_pembayaran') {
            session()->forget('active_invoice');
            return redirect()->route('orders.pending')
                ->with('info', 'Pesanan ini sudah diproses atau bukti pembayaran telah diunggah.');
        }

        $vendorId = $order->details->first()->vendor_id;
       

        // Ambil metode pembayaran aktif milik vendor terkait
        $paymentMethods = VendorPayment::where('vendor_id', $vendorId)
            ->where('type', $order->payment_method)
            ->where('is_active', true)
            ->get();

        return view('frontend.payment.index', compact('order', 'paymentMethods'));
    }

    // Proses Upload Bukti Bayar
    public function uploadProof(Request $request, $invoice)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order = Order::where('invoice_number', $invoice)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('bukti_pembayaran')) {
                $path = $request->file('bukti_pembayaran')->store('payment_proofs', 'local');
            
            $order->update([
                'bukti_pembayaran' => $path,
                'payment_status'   => 'waiting_verification', // Menunggu verifikasi penjual
                'order_status'     => 'diproses',
            ]);
        }

       

        return redirect()->route('orders.pending')
        ->with('success', 'Bukti pembayaran berhasil diunggah! Pesanan Anda sedang menunggu konfirmasi dari penjual.');
    }
}
