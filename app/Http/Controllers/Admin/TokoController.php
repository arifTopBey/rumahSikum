<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorProduk;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {

        $vendors = Vendor::orderByDesc('id')->get();
        return view('admin.toko.index', compact('vendors'));
    }

    public function show($id)
    {

        $vendor = Vendor::findOrFail($id);

        return view('admin.toko.detail', compact('vendor'));
    }

    public function listProduk()
    {

        $produks = VendorProduk::orderByDesc('id')->get();
        return view('admin.toko.produk.index', compact('produks'));
    }

    public function listProdukDetail($id)
    {

        $produk = VendorProduk::findOrFail($id);
        return view('admin.toko.produk.detail', compact('produk'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,block',
            'catatan_admin' => 'nullable|string|max:500'
        ]);

        $produk = VendorProduk::findOrFail($id);
        $produk->status = $request->status;

        // Tambahkan kolom catatan_admin jika ada di DB (opsional)
        if ($request->has('catatan_admin')) {
            $produk->catatan_admin = $request->catatan_admin;
        }

        $produk->save();

        return redirect()->back()->with('success', 'Status moderasi produk berhasil diperbarui menjadi ' . ucfirst($request->status));
    }
}
