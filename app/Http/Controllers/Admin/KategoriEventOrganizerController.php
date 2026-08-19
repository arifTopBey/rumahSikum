<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriEventOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriEventOrganizerController extends Controller
{
        public function index(){

        $categories = KategoriEventOrganizer::latest()->paginate(10); 
        return view('admin.kategoriElearning.index', compact('categories'));
    }

     public function store(Request $request)
    {

       $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        DB::beginTransaction();

        try{
            
           $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
             ];

            if ($request->hasFile('icon')) {
                $data['icon'] = $request->file('icon')->store('kategori_event_organizers', 'local');
            }

            KategoriEventOrganizer::create($data);

            DB::commit();
    
            return redirect()->route('admin.kategori.elearning.index')->with('success', 'Kategori E-Learning berhasil ditambahkan.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan kategori Elearning: ' . $e->getMessage());
        }
    }

     public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
     ]);

        DB::beginTransaction();

        try{
            $category = KategoriEventOrganizer::findOrFail($id);

            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ];

            if ($request->hasFile('icon')) {
                // Hapus icon lama jika ada
                if ($category->icon) {
                    Storage::disk('local')->delete($category->icon);
                }
                $data['icon'] = $request->file('icon')->store('kategori-elearning', 'local');
            }
            $category->update($data);

            DB::commit();
            return redirect()->back()->with('success','Kategori E-learning berhasil diupdate');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate kategori elearning: ' . $e->getMessage());
        }
    }

    public function destroy($id){

        DB::beginTransaction();

        try{
            $category = KategoriEventOrganizer::findOrFail($id);
            $category->delete();

            DB::commit();
            return redirect()->back()->with('success','Kategori E-Learning berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori Elearning: ' . $e->getMessage());
        }
    }
}
