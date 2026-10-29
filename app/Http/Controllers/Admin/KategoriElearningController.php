<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriElearning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriElearningController extends Controller
{
    public function index(){

        $categories = KategoriElearning::latest()->paginate(10); 
        return view('admin.kategoriElearning.index', compact('categories'));
    }

     public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kategori_berita,slug',
        ]);

        DB::beginTransaction();

        try{
            KategoriElearning::create($validatedData);

            DB::commit();
    
            return redirect()->route('admin.kategori.elearning.index')->with('success', 'Kategori E-Learning berhasil ditambahkan.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan kategori Elearning: ' . $e->getMessage());
        }
    }

     public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255'
        ]);

        DB::beginTransaction();

        try{
            $category = KategoriElearning::findOrFail($id);
        
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            DB::commit();
            return redirect()->back()->with('success','Kategori E-learning berhasil diupdate');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate kategori acara: ' . $e->getMessage());
        }
    }

    public function destroy($id){

        DB::beginTransaction();

        try{
            $category = KategoriElearning::findOrFail($id);
            $category->delete();

            DB::commit();
            return redirect()->back()->with('success','Kategori E-Learning berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori Elearning: ' . $e->getMessage());
        }
    }
}
