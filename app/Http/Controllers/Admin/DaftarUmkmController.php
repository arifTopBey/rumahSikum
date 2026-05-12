<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\User;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DaftarUmkmController extends Controller
{
    public function index(Request $request){

         $categories = KategoriProduk::orderByDesc('id')->get();
         $userId = auth()->user()->id;

        $vendorRequest = Vendor::where('user_id', $userId)->first();
        return view('admin.daftarUmkm.index', compact('categories', 'vendorRequest'));

    }   

    public function list_daftar_umkm(){

        $vendorRequests = Vendor::orderByDesc('id')->get();
        return view('admin.daftarUmkm.list_pengajuan_umkm', compact('vendorRequests'));
    }

    public function detail_pengajuan_umkm($id){

        $vendor = Vendor::findOrFail($id);
        return view('admin.daftarUmkm.detailPengajuan', compact('vendor'));
    }


    public function showFotoKtp($path){
        
          $path = urldecode($path); // 
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'file tidak ditemukan');
        }
        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }

    public function updateStatusUmkm($id, Request $request){

        try{
           
            $message = "";
            $vendor = Vendor::findOrFail($id)->first();
            if($request->success == 1){
                $vendor->status_store = 1;
                $message = "Umkm Berhasil Disetujui";
            }elseif($request->failed == 3){
                $vendor->status_store = 3;
                $message = "Umkm Berhasil Ditolak";
            }else{
                $vendor->status_store = 0;
                $message = "Umkm Berhasil Ditolak";
            }

            $vendor->save();

            // $user = User::where('id', auth()->user()->id)->first();
            $user = User::where('id', $vendor->user_id)->first();

            if($request->success == 1){
                $user->user_role = 'vendor';
            }else{                    
                $user->user_role = 'user';
            }
            $user->save();

            DB::commit();   
            return redirect()->route('admin.daftar.umkm')->with('success', $message);

        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }

    }
}
