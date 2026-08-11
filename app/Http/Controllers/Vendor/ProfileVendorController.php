<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileVendorController extends Controller
{
    public function index(){

        $userId = auth()->user()->id;
        $vendor = Vendor::where('user_id', $userId)->first();
        $categories = KategoriProduk::orderByDesc('id')->get();
        return view('vendor.profile.index', compact('vendor', 'categories'));
    }

    public function update(Request $request, $id){

        DB::beginTransaction();

        try{
            $vendor = Vendor::findOrFail($id);
            $vendor->nama_toko = $request->nama_toko;
            $vendor->kategori_produk_id = $request->kategori_produk_id;
            $vendor->deskripsi_toko = $request->deskripsi_toko;
            $vendor->alamat_toko = $request->alamat_toko;
            $vendor->no_telepon = $request->no_telepon;
            $vendor->save();

            DB::commit();
            return redirect()->route('vendor.profile.index')->with('success', 'Berhasil Update Profile Vendor');    

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal Update Profile Vendor ' . $e->getMessage());
        }

    }

}
