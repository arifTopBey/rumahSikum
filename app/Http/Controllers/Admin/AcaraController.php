<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcaraStoreRequest;
use App\Http\Requests\Admin\AcaraUpdateRequest;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AcaraController extends Controller
{
    public function index()
    {
        $acaras = Acara::latest()->paginate(10); ;
        return view('admin.acara.index', compact('acaras'));
    }

    public function create()
    {
        $categories = \App\Models\KategoriAcara::all();

        return view('admin.acara.create', compact('categories'));
    }

    public function store(AcaraStoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try{

            $acara = new Acara();
            $acara->kategori_acara_id = $validated['kategori_acara_id'];
            $acara->judul = $validated['judul'];
            $acara->slug = Str::slug($validated['judul']);
            $acara->deskripsi = $validated['deskripsi'];
            $acara->lokasi = $validated['lokasi'];
            $acara->tanggal_acara = $validated['tanggal_acara'];
            $acara->waktu_acara_mulai = $validated['waktu_acara_mulai'];
            $acara->waktu_acara_selesai = $validated['waktu_acara_selesai'];
            $acara->kuota = $validated['kuota'];
            $acara->views = 0;
            $acara->gambar = $validated['gambar']->store('acara', 'public');
            $acara->save();
            DB::commit();
            return redirect()->route('admin.acara.index')->with('success', 'Acara berhasil disimpan');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan acara: ' . $e->getMessage());
        }

        // Simpan acara ke database
    }

    public function show($id){

        $acara = Acara::findOrFail($id);
        return view('admin.acara.detail', compact('acara'));
    }

    public function edit($id){

        $acara = Acara::findOrFail($id);
        $categories = \App\Models\KategoriAcara::all();

        return view('admin.acara.edit', compact('acara', 'categories'));
    }

    public function update(AcaraUpdateRequest $request, $id){
        $validated = $request->validated();

        DB::beginTransaction();
        try{
            $acara = Acara::findOrFail($id);
            $acara->kategori_acara_id = $validated['kategori_acara_id'];
            $acara->judul = $validated['judul'];
            $acara->slug = Str::slug($validated['judul']);
            $acara->deskripsi = $validated['deskripsi'];
            $acara->lokasi = $validated['lokasi'];
            $acara->tanggal_acara = $validated['tanggal_acara'];
            $acara->waktu_acara_mulai = $validated['waktu_acara_mulai'];
            $acara->waktu_acara_selesai = $validated['waktu_acara_selesai'];
            $acara->kuota = $validated['kuota'];

            if($request->hasFile('gambar')){
                if($acara->gambar){
                    // Storage::disk('public')->delete($acara->gambar);
                    Storage::disk('local')->delete($acara->gambar);
                }
                // $acara->gambar = $validated['gambar']->store('acara', 'public');
                $acara->gambar = $validated['local']->store('acara', 'public');
            }

            $acara->save();
            DB::commit();
            return redirect()->route('admin.acara.index')->with('success', 'Acara berhasil diupdate');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate acara: ' . $e->getMessage());
        }
    }

   public function destroy($id){
        DB::beginTransaction();

        try{
            $acara = Acara::findOrFail($id);
            
            if($acara->gambar){
                Storage::disk('public')->delete($acara->gambar);
            }
            $acara->delete();

            DB::commit();
            return redirect()->route('admin.acara.index')->with('success', 'Acara berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus acara: ' . $e->getMessage());
        }
    }


}
