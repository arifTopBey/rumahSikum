<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
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
}
