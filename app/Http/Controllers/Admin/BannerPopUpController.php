<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerPopUpController extends Controller
{
    public function index(Request $request)
    {
        $popupGambar = PopupBanner::all();
        return view('admin.popup.index', compact('popupGambar'));
    }

    public function create()
    {
        $banner = PopupBanner::latest()->first();
        if ($banner){
            return redirect()->route('admin.banner.pop.up.index')->with('error', 'Popup banner sudah ada. Silakan edit banner yang ada.');
        }

        return view('admin.popup.create');
    }   

    public function store(Request $request)
    {

        $banner = PopupBanner::latest()->first();
        if ($banner){
            return redirect()->route('admin.banner.pop.up.index')->with('error', 'Popup banner sudah ada. Silakan edit banner yang ada.');
        }

       
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required'
        ]);

        DB::beginTransaction();

        try{
            $popupBanner = new PopupBanner();
            $popupBanner->status = $request->status ? 1 : 0;
            $popupBanner->banner_image = $request->file('banner_image')->store('popup_banners', 'local');
            $popupBanner->save();

            DB::commit();
            return redirect()->route('admin.banner.pop.up.index')->with('success', 'Popup banner berhasil ditambahkan.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan popup banner: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $popup = PopupBanner::findOrFail($id);
        return view('admin.popup.edit', compact('popup'));
    }

    public function update(Request $request, $id)
    {
        $popupBanner = PopupBanner::findOrFail($id);

        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable'
        ]);

        DB::beginTransaction();

        try{
            if ($request->hasFile('banner_image')) {
                // Hapus file gambar lama dari storage
                if ($popupBanner->banner_image) {
                    Storage::disk('local')->delete($popupBanner->banner_image);
                }
                // Simpan file gambar baru
                $popupBanner->banner_image = $request->file('banner_image')->store('popup_banners', 'local');
            }

            $popupBanner->status = $request->status ? 1 : 0;
            $popupBanner->save();

            DB::commit();
            return redirect()->route('admin.banner.pop.up.index')->with('success', 'Popup banner berhasil diperbarui.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui popup banner: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $popupBanner = PopupBanner::findOrFail($id);

        DB::beginTransaction();

        try{
            // Hapus file gambar dari storage
            if ($popupBanner->banner_image) {
                Storage::disk('local')->delete($popupBanner->banner_image);
            }

            $popupBanner->delete();

            DB::commit();
            return redirect()->route('admin.banner.pop.up.index')->with('success', 'Popup banner berhasil dihapus.');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus popup banner: ' . $e->getMessage());
        }
    }   
}
