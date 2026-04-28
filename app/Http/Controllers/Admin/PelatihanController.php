<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PelatihanStoreRequest;
use App\Http\Requests\Admin\PelatihanUpdateRequest;
use App\Models\KategoriPelatihan;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihan = Pelatihan::latest()->paginate(10); 
        return view('admin.pelatihan.index', compact('pelatihan'));
    }

    public function create(){
        $categories = KategoriPelatihan::all();
        return view('admin.pelatihan.createPelatihan', compact('categories'));
        
    }


    public function store(PelatihanStoreRequest $request){

        $validated = $request->validated();

        DB::beginTransaction();
        try{

            $acara = new Pelatihan();
            $acara->kategori_pelatihan_id = $validated['kategori_pelatihan_id'];
            $acara->judul = $validated['judul'];
            $acara->slug = Str::slug($validated['judul']);
            $acara->deskripsi = $validated['deskripsi'];
            $acara->lokasi = $validated['lokasi'];
            $acara->tanggal_acara = $validated['tanggal_acara'];
            $acara->waktu_acara_mulai = $validated['waktu_acara_mulai'];
            $acara->waktu_acara_selesai = $validated['waktu_acara_selesai'];
            // $acara->kuota = $validated['kuota'];
            $acara->views = 0;
            // $acara->gambar = $validated['gambar']->store('acara', 'public');
            $acara->gambar = $validated['gambar']->store('pelatihan', 'local');
            $acara->save();
            DB::commit();
            return redirect()->route('admin.pelatihan.index')->with('success', 'Pelatihan berhasil disimpan');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan Pelatihan: ' . $e->getMessage());
        }

    }

    public function show($id){

        $pelatihan = Pelatihan::findOrFail($id);
        return view('admin.pelatihan.detail', compact('pelatihan'));
    }

     public function edit($id){

        $pelatihan = Pelatihan::findOrFail($id);
        $categories = KategoriPelatihan::all();

        return view('admin.pelatihan.edit', compact('pelatihan', 'categories'));
    }

     public function update(PelatihanUpdateRequest $request, $id){
        
        $validated = $request->validated();

        DB::beginTransaction();
        try{

            $acara = Pelatihan::findOrFail($id);
            $acara->kategori_pelatihan_id = $validated['kategori_pelatihan_id'];
            $acara->judul = $validated['judul'];
            $acara->slug = Str::slug($validated['judul']);
            $acara->deskripsi = $validated['deskripsi'];
            $acara->lokasi = $validated['lokasi'];
            $acara->tanggal_acara = $validated['tanggal_acara'];
            $acara->waktu_acara_mulai = $validated['waktu_acara_mulai'];
            $acara->waktu_acara_selesai = $validated['waktu_acara_selesai'];

            if($request->hasFile('gambar')){
                if($acara->gambar){
                        // Storage::disk('public')->delete($acara->gambar);
                        Storage::disk('local')->delete($acara->gambar);
                }
                $acara->gambar = $validated['gambar']->store('pelatihan', 'local');
              
                }

                $acara->save();
                DB::commit();
                return redirect()->route('admin.pelatihan.index')->with('success', 'Pelatihan berhasil diupdate');
            }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate pelatihan: ' . $e->getMessage());
        }
    }


    public function destroy($id){
        DB::beginTransaction();

        try{
            $pelatihan = Pelatihan::findOrFail($id);
            
            if($pelatihan->gambar){

                // Storage::disk('public')->delete($acara->gambar);
                Storage::disk('local')->delete($pelatihan->gambar);

            }
            $pelatihan->delete();

            DB::commit();
            return redirect()->route('admin.pelatihan.index')->with('success', 'Pelatihan berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus Pelatihan: ' . $e->getMessage());
        }
    }

    // showFotoPelatihan
     public function showFotoPelatihan($path) {   
    // Debug: Jika gambar tidak muncul, hapus komentar dd dibawah ini untuk cek path yang masuk
    // dd($path); 

    if (!Storage::disk('local')->exists($path)) {
        abort(404, "File tidak ada di storage/app/" . $path);
    }

    return Storage::disk('local')->response($path);
}

}
