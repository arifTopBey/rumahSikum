<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BeritaStoreRequest;
use App\Http\Requests\Admin\BeritaUpdateStoreRequest;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    
    public function index()
    {    
        $beritas = Berita::latest()->paginate(10); ;
   

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        $categories = KategoriBerita::all();
        return view('admin.berita.create', compact('categories'));
    }

    public function store(BeritaStoreRequest $request){

        $validated = $request->validated();

        DB::beginTransaction();

        try{
            $berita = new Berita();
            $berita->judul = $validated['judul'];
            $berita->slug = Str::slug($validated['judul']);
            $berita->deskripsi = $validated['deskripsi'];
            $berita->kategori_id = $validated['kategori_id'];
            $berita->user_id = auth()->user()->id;
            $berita->views = 0;
            $berita->is_published = $request->has('is_published') ? 1 : 0;
            $berita->gambar = $validated['gambar']->store('berita', 'local');
            // $berita->gambar = $validated['gambar']->store('berita', 'public');

            $berita->save();

            DB::commit();   
            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil disimpan');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan berita: ' . $e->getMessage());
        }
    }

    public function show($id){

        $berita = Berita::findOrFail($id);
        return view('admin.berita.detail', compact('berita'));
    }

    public function edit($id){

        $categories = KategoriBerita::all();
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita', 'categories'));
    }

    public function update(BeritaUpdateStoreRequest $request, $id){

         $validated = $request->validated();

        DB::beginTransaction();

        try{
            $berita =  Berita::findOrFail($id);
            $berita->judul = $validated['judul'];
            $berita->slug = Str::slug($validated['judul']);
            $berita->deskripsi = $validated['deskripsi'];
            $berita->kategori_id = $validated['kategori_id'];
            $berita->user_id = auth()->user()->id;
            $berita->views = 0;
            $berita->is_published = $request->has('is_published') ? 1 : 0;

            if($request->hasFile('gambar')){
                if($berita->gambar){
                    Storage::disk('local')->delete($berita->gambar);
                    }
                    $berita->gambar = $validated['gambar']->store('berita', 'local');
            }

            $berita->save();

            DB::commit();   
            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diedit');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan berita: ' . $e->getMessage());
        }
    }


    public function destroy($id){
        DB::beginTransaction();

        try{
            $berita = Berita::findOrFail($id);
            
            if($berita->gambar){
                // Storage::disk('public')->delete($berita->gambar);
                Storage::disk('local')->delete($berita->gambar);
            }
            $berita->delete();

            DB::commit();
            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }


    public function showFotoBerita2($path){    

        $fullPath = storage_path('storage/private' . $path);
        
        if (!file_exists($fullPath)) {
            return response()->json([
                'error' => 'File not found',
                'path_received' => $path,
                'full_path' => $fullPath,
            ], 404);
        }

        return Storage::disk('local')->response($fullPath);
    }

    public function showFotoBerita($path) {    
    // Cek apakah file ada di disk 'local' (folder storage/app)
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Foto tidak ditemukan');
        }

        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }
}
