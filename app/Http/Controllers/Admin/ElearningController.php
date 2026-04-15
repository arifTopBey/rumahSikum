<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ElearningStoreRequest;
use App\Models\Elearning;
use App\Models\KategoriElearning;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ElearningController extends Controller
{
    public function index(){


        $elearnings = Elearning::latest()->paginate(10); 

        return view('admin.elearning.index', compact('elearnings'));
    }

    public function create(){

        $categories = KategoriElearning::all();
        return view('admin.elearning.create', compact('categories'));
    }


    public function store(ElearningStoreRequest $request){

        $validation = $request->validated();

        DB::beginTransaction();
        try{

            $elearning = new Elearning();
            $elearning->name = $validation['name'];
            $elearning->kategori_elearning_id = $validation['kategori_elearning_id'];
            $elearning->deskripsi = $validation['deskripsi'];
            $elearning->views = 0;

            if (isset($validation['pdf'])) {

                $file = $validation['pdf'];
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('pdf', $filename, 'local');
                $elearning->pdf = $path;
            }

            $elearning->thumbnail = $validation['thumbnail']->store('thumbnail_elearning', 'local');
            $elearning->link_youtube = $validation['link_youtube'];
            $elearning->nama_mentor = $validation['nama_mentor'];
            $elearning->photo_mentor = $validation['photo_mentor']->store('mentor', 'local');
            $elearning->bidang_menthor = $validation['bidang_menthor'];
            $elearning->durasi = $validation['durasi'];
            $elearning->is_publish = $request->has('is_publish') ? 1 : 0;
            $elearning->level = $validation['level'];
            $elearning->save();
            DB::commit();

            return redirect()->route('admin.elearning.index')->with('success', 'Modul Elearning berhasil disimpan');

        }catch(Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat modul Elearning: ' . $exception->getMessage());
        }

    }


    public function showFotoThumbnail($path){
         // Cek apakah file ada di disk 'local' (folder storage/app)
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Foto tidak ditemukan');
        }
        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }
    
    public function showFotoMentor($path){
         // Cek apakah file ada di disk 'local' (folder storage/app)
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Foto tidak ditemukan');
        }
        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }
}
