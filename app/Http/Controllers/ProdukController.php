<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorStoreRequest;
use App\Models\Vendor;
use Exception;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index(){

       

        return view('dashboard.produk.index');
    }

    public function vendorStore(VendorStoreRequest $request){

        $validated = $request->validated(); 

        DB::beginTransaction();
        try{
            $vendor = new Vendor();
            $vendor->user_id = auth()->user()->id;
            $vendor->name = $validated['name'];
            $vendor->shop_name = $validated['shop_name'];
            $vendor->phone = $validated['phone'];
            $vendor->kecamatan = $validated['kecamatan'];
            $vendor->kab_kota = $validated['kab_kota'];
            $vendor->kelurahan = $validated['kelurahan'];
            $vendor->provinsi = $validated['provinsi'];
            $vendor->kode_pos = $validated['kode_pos'];
            $vendor->identity_number = $validated['identity_number'];
            $vendor->kategori_produk_id = $validated['kategori_produk_id'];
            $vendor->shop_address = $validated['shop_address'];
            $vendor->store_photo = $validated['store_photo']->store('foto_toko', 'local');
            $vendor->identity_photo = $validated['identity_photo']->store('foto_ktp', 'local');
            
            $vendor->save();
            DB::commit();
            
            return redirect()->route('user.daftar.umkm')->with('success', 'Berhasil membuat Pengajuan');

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus Banner: ' . $e->getMessage());
        }


    }
}
