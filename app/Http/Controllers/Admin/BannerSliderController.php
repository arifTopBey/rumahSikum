<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerSliderController extends Controller
{
    public function index(){
        
        $sliders = BannerSlider::orderByDesc('id')->get();
        return view('admin.banner_slider.index', compact('sliders'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'banner' => 'image|required|mimes:png,jpg,jpeg|max:2048',
            'button_url' => 'nullable|string|max:255'
        ]);


         DB::beginTransaction();

        try{
            $banner =  new BannerSlider();
            $banner->button_url = $validated['button_url'];
            $banner->banner = $validated['banner']->store('banner_ecommerce', 'local');
            $banner->save();

            DB::commit();   
            return redirect()->route('admin.slider.index')->with('success', 'berhasil membuat banner');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan banner: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id){

        $validated = $request->validate([
            'banner' => 'image|nullable|mimes:png,jpg,jpeg|max:2048',
            'button_url' => 'nullable|string|max:255'
        ]);


         DB::beginTransaction();

        try{
            $slider =  BannerSlider::findOrFail($id);
            $slider->button_url = $validated['button_url'];

        
             // ganti gambar lama ke gambar baru
             if($request->hasFile('banner')){

                if($slider->banner){
                    Storage::disk('local')->delete($slider->banner);
                }
                    $slider->banner = $validated['banner']->store('banner_ecommerce', 'local');
            }

            $slider->save();

            DB::commit();   
            return redirect()->route('admin.slider.index')->with('success', 'berhasil mengupdate banner');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan banner: ' . $e->getMessage());
        }
    }

    public function destroy($id){
        DB::beginTransaction();

        try{
            $slider = BannerSlider::findOrFail($id);
            
            if($slider->banner){
                // Storage::disk('public')->delete($slider->gambar);
                Storage::disk('local')->delete($slider->banner);
            }
            $slider->delete();

            DB::commit();
            return redirect()->route('admin.slider.index')->with('success', 'Banner berhasil dihapus');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus Banner: ' . $e->getMessage());
        }
    }

}
