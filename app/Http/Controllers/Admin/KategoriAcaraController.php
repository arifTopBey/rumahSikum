<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriAcara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriAcaraController extends Controller
{
    public function index()
    {
        $categories = KategoriAcara::latest()->paginate(10); ;

        return view('admin.kategoriAcara.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.kategoriAcara.create');
    }

     public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kategori_berita,slug',
        ]);

        DB::beginTransaction();

        try{
            KategoriAcara::create($validatedData);

            DB::commit();
    
            return redirect()->route('admin.kategori.acara.index')->with('success', 'Kategori acara berhasil ditambahkan.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan kategori acara: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255'
        ]);

        DB::beginTransaction();

        try{
            $category = KategoriAcara::findOrFail($id);
        
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            DB::commit();
            return redirect()->back()->with('success','Kategori Acara berhasil diupdate');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate kategori acara: ' . $e->getMessage());
        }
}

    public function destroy($id){

        DB::beginTransaction();

        try{
            $category = KategoriAcara::findOrFail($id);
            $category->delete();

            DB::commit();
            return redirect()->back()->with('success','Kategori Acara berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori acara: ' . $e->getMessage());
        }
}


}
