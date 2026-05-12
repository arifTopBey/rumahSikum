<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\ProdukStoreRequest;
use App\Http\Requests\Vendor\ProdukUpdateRequest;
use App\Models\KategoriProduk;
use App\Models\ProdukPhoto;
use App\Models\Vendor;
use App\Models\VendorProduk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    
    public function index(){

        $produks = VendorProduk::orderByDesc('id')->get();

        return view('vendor.produk.index', compact('produks'));
    }

    public function create(){

        $categories = KategoriProduk::orderByDesc('id')->get();
        return view('vendor.produk.create', compact('categories'));
    }

    public function store(ProdukStoreRequest $request){

        DB::beginTransaction();
        $validated = $request->validated();

        try{
            $vendor = Vendor::where('user_id', auth()->user()->id)->first();

            $produk = new VendorProduk();
            $produk->nama_produk = $validated['nama_produk'];
            $produk->vendor_id = $vendor->id;
            $produk->slug = Str::slug($validated['nama_produk']);
            $produk->harga = $validated['harga'];
            $produk->stok = $validated['stok'];
            $produk->produk_deskripsi = $validated['produk_deskripsi'];
            $produk->kategori_produk_id = $validated['kategori_produk_id'];
            $produk->status_produk = $validated['status_produk'];
            $produk->produk_thumbnail = $validated['produk_thumbnail']->store('vendor_produk', 'local');
            $produk->save();

            if($request->hasFile('photos_produks')){

                 foreach ($request->file('photos_produks') as $photo) {

                    $photoPath = $photo->store('produk_gallery', 'local');

                    ProdukPhoto::create([
                        'produk_id' => $produk->id,
                        'photos_produks' => $photoPath,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('vendor.produk.index')->with('success', 'produk berhasil dibuat 🎉');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'gagal membuat produk ' . $e->getMessage());

        }
    }

     public function showThumbnailProduk($path){
        
          $path = urldecode($path); // 
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'file tidak ditemukan');
        }
        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }

    public function show($id){

        $produk = VendorProduk::findOrFail($id)->first();

        return view('vendor.produk.detail', compact('produk'));
    }


    public function edit($id){

         $categories = KategoriProduk::orderByDesc('id')->get();
         $produk = VendorProduk::findOrFail($id)->first();
         return view('vendor.produk.edit', compact('categories', 'produk'));
    }

    public function update(ProdukUpdateRequest $request, $id) {
    DB::beginTransaction();
    $validated = $request->validated();

    try {
        $produk = VendorProduk::findOrFail($id);
        
        $produk->nama_produk = $validated['nama_produk'];
        $produk->slug = Str::slug($validated['nama_produk']);
        $produk->harga = $validated['harga'];
        $produk->stok = $validated['stok'];
        $produk->produk_deskripsi = $validated['produk_deskripsi'];
        $produk->kategori_produk_id = $validated['kategori_produk_id'];
        $produk->status_produk = $validated['status_produk'];

        if ($request->hasFile('produk_thumbnail')) {
            // Hapus foto lama dari storage jika ada
            if ($produk->produk_thumbnail && Storage::disk('local')->exists($produk->produk_thumbnail)) {
                Storage::disk('local')->delete($produk->produk_thumbnail);
            }
            // Simpan foto baru
            $produk->produk_thumbnail = $request->file('produk_thumbnail')->store('vendor_produk', 'local');
        }

        $produk->save();

        // 3. Logika Hapus Foto Galeri yang Dicentang (Jika ada)
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = ProdukPhoto::find($photoId);
                if ($photo) {
                    // Hapus file fisik dari storage
                    if (Storage::disk('local')->exists($photo->photos_produks)) {
                        Storage::disk('local')->delete($photo->photos_produks);
                    }
                    // Hapus data dari database
                    $photo->delete();
                }
            }
        }

        // 4. Logika Tambah Foto Galeri Baru (Jika ada)
        if ($request->hasFile('photos_produks')) {
            foreach ($request->file('photos_produks') as $photo) {
                $photoPath = $photo->store('produk_gallery', 'local');

                ProdukPhoto::create([
                    'produk_id' => $produk->id,
                    'photos_produks' => $photoPath,
                ]);
            }
        }

        DB::commit();
        return redirect()->route('vendor.produk.index')->with('success', 'Produk berhasil diperbarui ✨');

    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Gagal memperbarui produk: ' . $e->getMessage());
    }
}
}
