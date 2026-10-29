<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ElearningStoreRequest;
use App\Http\Requests\Admin\ElearningUpdateRequest;
use App\Models\Elearning;
use App\Models\KategoriElearning;
use Exception;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ElearningController extends Controller
{
    public function index()
    {


        $elearnings = Elearning::latest()->paginate(10);
        $totalViews = Elearning::sum('views');
        $totalMateri = Elearning::whereNotNull('link_youtube')->count();
        $totalPdf = Elearning::whereNotNull('pdf')->count();
        $topElearning = Elearning::orderBy('views', 'desc')->first();

        return view('admin.elearning.index', compact('elearnings', 'totalMateri', 'totalViews', 'topElearning', 'totalPdf'));
    }

    public function create()
    {

        $categories = KategoriElearning::all();
        return view('admin.elearning.create', compact('categories'));
    }


    public function store(ElearningStoreRequest $request)
    {

        $validation = $request->validated();

        DB::beginTransaction();
        try {

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

        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat modul Elearning: ' . $exception->getMessage());
        }

    }

    public function show($id)
    {

        $elearning = Elearning::find($id)->first();

        // dd($elearning);
        return view('admin.elearning.detail', compact('elearning'));
    }

    public function edit($id)
    {

        $elearning = Elearning::find($id)->first();
        $categories = KategoriElearning::all();

        return view('admin.elearning.edit', compact('elearning', 'categories'));
    }

    public function update(ElearningUpdateRequest $request, $id)
    {
        $validation = $request->validated();

        DB::beginTransaction();
        try {
            $elearning = Elearning::findOrFail($id);

            $elearning->name = $validation['name'];
            $elearning->kategori_elearning_id = $validation['kategori_elearning_id'];
            $elearning->deskripsi = $validation['deskripsi'];
            $elearning->link_youtube = $validation['link_youtube'];
            $elearning->nama_mentor = $validation['nama_mentor'];
            $elearning->bidang_menthor = $validation['bidang_menthor'];
            $elearning->durasi = $validation['durasi'];
            $elearning->level = $validation['level'];
            $elearning->is_publish = $request->has('is_publish') ? 1 : 0;

            /**
             * ========================
             * PDF (OPTIONAL UPDATE)
             * ========================
             */
            if ($request->hasFile('pdf')) {

                // hapus file lama
                if ($elearning->pdf && Storage::disk('local')->exists($elearning->pdf)) {
                    Storage::disk('local')->delete($elearning->pdf);
                }

                $file = $request->file('pdf');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('pdf', $filename, 'local');

                $elearning->pdf = $path;
            }

            /**
             * ========================
             * THUMBNAIL (OPTIONAL)
             * ========================
             */
            if ($request->hasFile('thumbnail')) {

                if ($elearning->thumbnail && Storage::disk('local')->exists($elearning->thumbnail)) {
                    Storage::disk('local')->delete($elearning->thumbnail);
                }

                $elearning->thumbnail = $request->file('thumbnail')->store('thumbnail_elearning', 'local');
            }

            /**
             * ========================
             * PHOTO MENTOR (OPTIONAL)
             * ========================
             */
            if ($request->hasFile('photo_mentor')) {

                if ($elearning->photo_mentor && Storage::disk('local')->exists($elearning->photo_mentor)) {
                    Storage::disk('local')->delete($elearning->photo_mentor);
                }

                $elearning->photo_mentor = $request->file('photo_mentor')->store('mentor', 'local');
            }

            $elearning->save();

            DB::commit();

            return redirect()->route('admin.elearning.index')
                ->with('success', 'Modul Elearning berhasil diupdate');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function destroy($id){

    DB::beginTransaction();
    try {
        $elearning = Elearning::findOrFail($id);

        /**
         * ========================
         * HAPUS PDF
         * ========================
         */
        if ($elearning->pdf && Storage::disk('local')->exists($elearning->pdf)) {
            Storage::disk('local')->delete($elearning->pdf);
        }

        /**
         * ========================
         * HAPUS THUMBNAIL
         * ========================
         */
        if ($elearning->thumbnail && Storage::disk('local')->exists($elearning->thumbnail)) {
            Storage::disk('local')->delete($elearning->thumbnail);
        }

        /**
         * ========================
         * HAPUS FOTO MENTOR
         * ========================
         */
        if ($elearning->photo_mentor && Storage::disk('local')->exists($elearning->photo_mentor)) {
            Storage::disk('local')->delete($elearning->photo_mentor);
        }

        /**
         * ========================
         * HAPUS DATA
         * ========================
         */
        $elearning->delete();

        DB::commit();

        return redirect()->route('admin.elearning.index')->with('success', 'Modul Elearning berhasil dihapus');

    } catch (Exception $e) {
        DB::rollBack();

        return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
    }
}

    public function showFotoThumbnail($path)
    {
        // Cek apakah file ada di disk 'local' (folder storage/app)
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Foto tidak ditemukan');
        }
        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }

    public function showFotoMentor($path)
    {
        // Cek apakah file ada di disk 'local' (folder storage/app)
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Foto tidak ditemukan');
        }
        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }
    public function showPdfElearning($path)
    {
        // Cek apakah file ada di disk 'local' (folder storage/app)
        $path = urldecode($path); // 
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'file tidak ditemukan');
        }
        // Mengembalikan response file secara langsung
        return Storage::disk('local')->response($path);
    }
}
