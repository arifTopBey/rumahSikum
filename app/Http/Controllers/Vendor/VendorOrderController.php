<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function pendingPayments()
    {
        $vendorId = Auth::user()->vendor->id;

       
        $orders = Order::whereHas('details', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->with(['user', 'details' => function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId)->with('produk');
            }])
            ->where('payment_status', 'waiting_verification')
            ->latest()      
            ->paginate(10);

        return view('vendor.konfirmasi_pembayran.index', compact('orders'));
    }

    /**
     * Memproses aksi Terima (Approve) atau Tolak (Reject) Bukti Pembayaran
     */
    public function verifyPayment(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'note'   => 'nullable|string|max:255',
        ]);

        $order = Order::findOrFail($id);

        if ($request->action === 'approve') {
            $order->update([
                'payment_status' => 'paid',
                'order_status'   => 'diproses',
            ]);

            return redirect()->back()->with('success', "Pembayaran untuk Invoice #{$order->invoice_number} berhasil dikonfirmasi!");
        } else {
            $order->update([
                'payment_status' => 'rejected',
                'order_status'   => 'batal',
            ]);

            return redirect()->back()->with('error', "Pembayaran untuk Invoice #{$order->invoice_number} telah ditolak.");
        }
    }



    // Halaman List Semua Pesanan Masuk (Sisi Vendor)
    public function index(Request $request)
    {
        $vendorId = Auth::user()->vendor->id; // Sesuaikan dengan cara mengambil ID Vendor yang terautentikasi
        $status = $request->query('status', 'semua');

        $query = Order::whereHas('details', function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })->with(['user', 'details' => function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId)->with('produk');
        }]);

        // Filter berdasarkan Tab Status
        if ($status === 'perlu_dikirim') {
            $query->where('payment_status', 'paid')
                  ->where('order_status', 'diproses');
        } elseif ($status === 'dikirim') {
            $query->where('order_status', 'dikirim');
        } elseif ($status === 'selesai') {
            $query->where('order_status', 'selesai');
        } elseif ($status === 'batal') {
            $query->where('order_status', 'batal');
        }

        $orders = $query->latest()->paginate(10);

        return view('vendor.kelola_pesanan.index', compact('orders', 'status'));
    }

    // Update Status Pengiriman (Misal: Ubah ke 'dikirim' atau 'selesai')
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:diproses,dikirim,selesai,batal',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => $request->order_status
        ]);

        return redirect()->back()->with('success', "Status pesanan #{$order->invoice_number} berhasil diperbarui!");
    }

    public function show($invoice)
    {
        $vendorId = Auth::user()->vendor->id; // Sesuaikan dengan cara mengambil ID Vendor yang terautentikasi

        $order = Order::whereHas('details', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->with(['user', 'details' => function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId)->with('produk');
            }])
            ->where('invoice_number', $invoice)
            ->firstOrFail();

        return view('vendor.cek_bukti.index', compact('order'));
    }
}
