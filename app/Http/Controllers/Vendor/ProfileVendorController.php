<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'store_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_produk_id' => 'required|exists:kategori_produk,id',
            'shop_description' => 'nullable|string',
            'shop_address' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kab_kota' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        try{
            $vendor = Vendor::findOrFail($id);
            if($request->hasFile('store_photo')) {

                Storage::disk('local')->delete($vendor->store_photo);

                $imagePath = $request->file('store_photo')->store('vendor_photos', 'local');

                $vendor->store_photo = $imagePath;
            }
            $vendor->shop_name = $request->shop_name;
            $vendor->kategori_produk_id = $request->kategori_produk_id;
            $vendor->shop_description = $request->shop_description;
            $vendor->shop_address = $request->shop_address;
            $vendor->kecamatan = $request->kecamatan;
            $vendor->provinsi = $request->provinsi;
            $vendor->kab_kota = $request->kab_kota;
            $vendor->kelurahan = $request->kelurahan;
            $vendor->kode_pos = $request->kode_pos;
            $vendor->save();

            DB::commit();
            return redirect()->route('vendor.profile.index')->with('success', 'Berhasil Update Profile Vendor');    

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal Update Profile Vendor ' . $e->getMessage());
        }

    }

}
