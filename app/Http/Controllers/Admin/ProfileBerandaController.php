<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilBeranda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileBerandaController extends Controller
{
    
    public function index(Request $request){
        $profiBeranda = ProfilBeranda::all();
        return view('admin.profil_beranda.index', compact('profiBeranda'));
    }



    public function create(){

        $profilBeranda = ProfilBeranda::latest()->first();
        if ($profilBeranda){
            return redirect()->route('admin.profil-beranda.index')->with('error', 'Video profil sudah ada. Silakan edit video yang ada.');
        }

        return view('admin.profil_beranda.create');
    }

    // public function store(Request $request){

    //     //  video_local VARCHAR(255) NULL,
    //     // video_youtube VARCHAR(255) NULL,
    //     // Validasi input
    //     $request->validate([
    //         'video_youtube' => 'required|url'
    //     ]);

    //    $profilBeranda = new ProfilBeranda();
    //    $profilBeranda->video_youtube = $request->video_youtube;
    //    $profilBeranda->save();

        
    //     return redirect()->route('admin.profil-beranda.index')->with('success', 'Video profil berhasil ditambahkan.');
    // }


     public function store(Request $request){

        //  video_local VARCHAR(255) NULL,
        // video_youtube VARCHAR(255) NULL,
        // Validasi input
        $request->validate([
            'video_youtube' => 'nullable|url',
            'video_local' => 'nullable|file|mimes:mp4,mov,avi|max:40240', // Maksimal 40MB,
            'status' => 'required|in:0,1'
        ]);

    //      video_local VARCHAR(255) NULL,
    // video_youtube VARCHAR(255) NULL,
    // status TINYINT(1) NOT NULL DEFAULT 1,

       $profilBeranda = new ProfilBeranda();
       $profilBeranda->video_youtube = $request->video_youtube;
       $profilBeranda->video_local = $request->file('video_local') ? $request->file('video_local')->store('videos', 'public') : null;
       $profilBeranda->status = $request->status;
       $profilBeranda->save();

        
        return redirect()->route('admin.profil-beranda.index')->with('success', 'Video profil berhasil ditambahkan.');
    }

    

    // public function edit($id){

    //     $profilBeranda = ProfilBeranda::findOrFail($id);
    //     return view('admin.profil_beranda.edit', compact('profilBeranda'));
    // }  

     public function edit($id){

        $video = ProfilBeranda::findOrFail($id);
        return view('admin.profil_beranda.edit', compact('video'));
    }  
    
    // public function update(Request $request, $id){

    //     // Validasi input
    //     $request->validate([
    //         'video_youtube' => 'required|url'
    //     ]);

    //     $profilBeranda = ProfilBeranda::findOrFail($id);
    //     $profilBeranda->video_youtube = $request->video_youtube;
    //     $profilBeranda->save();

    //     return redirect()->route('admin.profil-beranda.index')->with('success', 'Video profil berhasil diperbarui.');
    // }

    public function update(Request $request, $id){

        // Validasi input
        $request->validate([
            'video_youtube' => 'nullable|url',
            'video_local' => 'nullable|file|mimes:mp4,mov,avi|max:40240', // Maksimal 40MB,
            'status' => 'nullable'
        ]);

        $profilBeranda = ProfilBeranda::findOrFail($id);
        $profilBeranda->video_youtube = $request->video_youtube;
        
        if ($request->hasFile('video_local')) {
            // Hapus video lama jika ada
            if ($profilBeranda->video_local) {
                Storage::disk('public')->delete($profilBeranda->video_local);
            }
            $profilBeranda->video_local = $request->file('video_local')->store('videos', 'public');
        }

        $profilBeranda->status = $request->status;
        $profilBeranda->save();

        return redirect()->route('admin.profil-beranda.index')->with('success', 'Video profil berhasil diperbarui.');
    }

    public function destroy($id){

        $profilBeranda = ProfilBeranda::findOrFail($id);
        $profilBeranda->delete();

        return redirect()->route('admin.profil-beranda.index')->with('success', 'Video profil berhasil dihapus.');
    }


}
