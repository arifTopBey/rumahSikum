<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        $categories = KategoriBerita::latest()->paginate(10); ;
        return view('admin.kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.kategori_berita.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kategori_berita,slug',
        ]);

        DB::beginTransaction();

        try{
            KategoriBerita::create($validatedData);

            DB::commit();
    
            return redirect()->route('admin.kategori.berita.index')->with('success', 'Kategori berita berhasil ditambahkan.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan kategori berita: ' . $e->getMessage());
        }
        // Simpan kategori berita ke database
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255'
        ]);

        DB::beginTransaction();

        try{
            $category = KategoriBerita::findOrFail($id);
        
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            DB::commit();
            return redirect()->back()->with('success','Kategori berhasil diupdate');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate kategori berita: ' . $e->getMessage());
        }
}

public function destroy($id){
    DB::beginTransaction();

    try{
        $category = KategoriBerita::findOrFail($id);
        $category->delete();

        DB::commit();
        return redirect()->back()->with('success','Kategori berhasil dihapus');

    }catch(\Exception $e){
        DB::rollBack();
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori berita: ' . $e->getMessage());
    }
}
    
}
