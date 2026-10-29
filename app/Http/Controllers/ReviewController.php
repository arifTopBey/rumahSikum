<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($orderId, $produkId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->where('order_status', 'selesai')
            ->firstOrFail();

        $orderDetail = OrderDetail::where('order_id', $orderId)
            ->where('produk_id', $produkId)
            ->with('produk')
            ->firstOrFail();

        // Cek apakah produk dalam order ini sudah pernah diulas
        $existingReview = Review::where('order_id', $orderId)
            ->where('produk_id', $produkId)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return redirect()->route('user.orders.detail_pesanan', $order->invoice_number)
                ->with('info', 'Anda sudah memberikan ulasan untuk produk ini.');
        }

        return view('frontend.ecommerce.ulasan', compact('order', 'orderDetail'));
    }

    /**
     * Simpan Ulasan Produk
     */
    public function store(Request $request, $orderId, $produkId)
    {
        $request->validate([
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'nullable|string|max:1000',
            'foto_ulasan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072', // Maksimal 3MB
        ], [
            'rating.required'  => 'Silakan pilih rating bintang terlebih dahulu.',
            'foto_ulasan.image'=> 'File harus berupa gambar.',
            'foto_ulasan.mimes'=> 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto_ulasan.max'  => 'Ukuran foto maksimal 3MB.',
        ]);

        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->where('order_status', 'selesai')
            ->firstOrFail();

        // Proteksi cegah ganda
        $existingReview = Review::where('order_id', $orderId)
            ->where('produk_id', $produkId)
            ->where('user_id', Auth::id())
            ->exists();

        if ($existingReview) {
            return redirect()->route('user.orders.show', $order->invoice_number)
                ->with('error', 'Ulasan untuk produk ini sudah ada.');
        }

        $fotoPath = null;
        if ($request->hasFile('foto_ulasan')) {
            $fotoPath = $request->file('foto_ulasan')->store('foto_ulasan', 'public');
        }

        Review::create([
            'order_id'    => $order->id,
            'produk_id'   => $produkId,
            'user_id'     => Auth::id(),
            'rating'      => $request->rating,
            'comment'     => $request->comment,
            'foto_ulasan' => $fotoPath,
        ]);

        return redirect()->route('user.orders.detail_pesanan', $order->invoice_number)
            ->with('success', 'Terima kasih atas ulasan yang Anda berikan!');
    }
}
