<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriPelatihanController extends Controller
{
    public function index(){
         $categories = KategoriPelatihan::latest()->paginate(10); ;
        return view('admin.kategoriPelatihan.index', compact('categories'));
    }

      public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kategori_berita,slug',
        ]);

        DB::beginTransaction();

        try{
            KategoriPelatihan::create($validatedData);

            DB::commit();
    
            return redirect()->route('admin.kategori.pelatihan.index')->with('success', 'Kategori Pelatihan berhasil ditambahkan.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan kategori pelatihan: ' . $e->getMessage());
        }
    }

     public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255'
        ]);

        DB::beginTransaction();

        try{
            $category = KategoriPelatihan::findOrFail($id);
        
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            DB::commit();
            return redirect()->back()->with('success','Kategori Pelatihan berhasil diupdate');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate kategori Pelatihan: ' . $e->getMessage());
        }
    }

    public function destroy($id){

        DB::beginTransaction();

        try{
            $category = KategoriPelatihan::findOrFail($id);
            $category->delete();

            DB::commit();
            return redirect()->back()->with('success','Kategori Pelatihan berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori Pelatihan: ' . $e->getMessage());
        }
    }
}
