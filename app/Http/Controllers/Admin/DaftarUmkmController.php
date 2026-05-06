<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DaftarUmkmController extends Controller
{
    public function index(Request $request){

         $categories = KategoriProduk::orderByDesc('id')->get();
         $userId = auth()->user()->id;

        $vendorRequest = Vendor::where('user_id', $userId)->first();
        return view('admin.daftarUmkm.index', compact('categories', 'vendorRequest'));

    }   
}
