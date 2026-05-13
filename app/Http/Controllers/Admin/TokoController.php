<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorProduk;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index(){

        $vendors = Vendor::orderByDesc('id')->get();
        return view('admin.toko.index', compact('vendors'));
    }

    public function show($id){

        $vendor = Vendor::findOrFail($id)->first();

        return view('admin.toko.detail', compact('vendor'));
    }

    public function listProduk(){

        $produks = VendorProduk::orderByDesc('id')->get();
        return view('admin.toko.produk.index', compact('produks'));
    }

    public function listProdukDetail($id){

        $produk = VendorProduk::findOrFail($id)->first();
        return view('admin.toko.produk.detail', compact('produk'));
    }
}
