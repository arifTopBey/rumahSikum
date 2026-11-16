<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KategoriProdukStoreRequest;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class KategoriProdukController extends Controller
{
    public function index(){

        $categories = KategoriProduk::orderByDesc('id')->get();

        return view('admin.kategoriProduk.index', compact('categories'));
    }

    public function store(KategoriProdukStoreRequest $request){
        
         $validated = $request->validated();

        DB::beginTransaction();

        try{
            $kategoriProduk =  new KategoriProduk();
            $kategoriProduk->name = $validated['name'];
            $kategoriProduk->slug = Str::slug($validated['name']);
            $kategoriProduk->icon = $validated['icon']->store('iconKategoriProduk', 'local');
            $kategoriProduk->save();

            DB::commit();   
            return redirect()->route('admin.kategori.produk')->with('success', 'Kategori Produk Berhasil dibuat');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan berita: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id){
         DB::beginTransaction();
         $validated = $request->validate([
            'icon' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'name' =>  'nullable|string|max:255'
         ]);

        try{
            $kategoriProduk =  KategoriProduk::findOrFail($id);
            $kategoriProduk->name = $validated['name'];
            $kategoriProduk->slug = Str::slug($validated['name']);

            // ganti gambar lama ke gambar baru
             if($request->hasFile('icon')){

                if($kategoriProduk->gambar){
                    Storage::disk('local')->delete($kategoriProduk->icon);
                }
                    $kategoriProduk->icon = $validated['icon']->store('iconKategoriProduk', 'local');
                    // $kategoriProduk->icon = $validated['icon']->store('iconKategoriProduk', 'local');
            }
            $kategoriProduk->save();

            DB::commit();   
            return redirect()->route('admin.kategori.produk')->with('success', 'Kategori Produk Berhasil diedit');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan Kategori Produk: ' . $e->getMessage());
        }
    }

    public function delete($id){
         DB::beginTransaction();

        try{
            $category = KategoriProduk::findOrFail($id);
            
            if($category->icon){
                // Storage::disk('public')->delete($category->gambar);
                Storage::disk('local')->delete($category->icon);
            }
            $category->delete();

            DB::commit();
            return redirect()->route('admin.kategori.produk')->with('success', 'Kategori Produk berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus Kategori Produk: ' . $e->getMessage());
        }
    }

    public function showIconKategori($path) {    
    // Cek apakah file ada di disk 'local' (folder storage/app)
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Foto tidak ditemukan');
        }

        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }
}
