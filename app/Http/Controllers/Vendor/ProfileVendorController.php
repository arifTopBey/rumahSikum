<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ProfileVendorController extends Controller
{
    public function index(){

        $userId = auth()->user()->id;
        $vendor = Vendor::where('user_id', $userId)->first();
        $categories = KategoriProduk::orderByDesc('id')->get();
        return view('vendor.profile.index', compact('vendor', 'categories'));
    }
}
