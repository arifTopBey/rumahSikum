<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ElearningStoreRequest;
use App\Http\Requests\Admin\ElearningUpdateRequest;
use App\Http\Requests\Admin\EventOrganizerStoreRequest;
use App\Models\EventOrganizer;
use App\Models\KategoriEventOrganizer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventOrganizerController extends Controller
{
     public function index()
    {


        $elearnings = EventOrganizer::latest()->paginate(10);
    
        return view('admin.elearning.index', compact('elearnings'));
    }

    public function create()
    {

        $categories = KategoriEventOrganizer::all();
        return view('admin.elearning.create', compact('categories'));
    }


    public function store(EventOrganizerStoreRequest $request)
    {

        $validation = $request->validated();

        DB::beginTransaction();
        try {

        // return [
        //     'judul_event' => ['required', 'string', 'max:255'],
        //     'kategori_organizer_id' => ['required', 'integer', 'exists:kategori_event_organizers,id'],
        //     'waktu_mulai' => ['required', 'date', 'after_or_equal:now'],
        //     'waktu_selesai' => ['required', 'date', 'after:waktu_mulai'],
        //     'jenis_pelatihan' => ['required', 'in:online,webinar,workshop,bootcamp,offline'],
            
        //     // Validasi Kondisional: Wajib diisi jika jenis pelatihan adalah offline
        //     'nama_venue' => ['nullable', 'required_if:jenis_pelatihan,offline', 'string', 'max:255'],
        //     'kota' => ['nullable', 'required_if:jenis_pelatihan,offline', 'string', 'max:100'],
        //     'provinsi' => ['nullable', 'required_if:jenis_pelatihan,offline', 'string', 'max:100'],
        //     'alamat_lengkap' => ['nullable', 'required_if:jenis_pelatihan,offline', 'string'],

        //     'kuota_peserta' => ['nullable', 'integer', 'min:0'],
        //     'deskripsi_event' => ['nullable', 'string'],
        //     'banner_event' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], 
        // ];

            $event = new EventOrganizer();
            $event->judul_event = $validation['judul_event'];
            $event->kategori_organizer_id = $validation['kategori_organizer_id'];
            $event->waktu_mulai = $validation['waktu_mulai'];
            $event->waktu_selesai = $validation['waktu_selesai'];
            $event->nama_venue = $validation['nama_venue'];
            $event->kota = $validation['kota'];
            $event->provinsi = $validation['provinsi'];
            $event->kuota_peserta = $validation['kuota_peserta'];
            $event->deskripsi_event = $validation['deskripsi_event'];
            $event->is_publish = $request->has('is_publish') ? 1 : 0;
            $event->banner_event = $validation['banner_event']->store('event_organanizer_banner', 'local');
            
         
            $event->save();
            DB::commit();

            return redirect()->route('admin.elearning.index')->with('success', 'Modul Elearning berhasil disimpan');

        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat modul Elearning: ' . $exception->getMessage());
        }

    }

    public function show($id)
    {

        $elearning = EventOrganizer::find($id)->first();

        // dd($elearning);
        return view('admin.elearning.detail', compact('elearning'));
    }

    public function edit($id)
    {

        $elearning = EventOrganizer::find($id)->first();
        $categories = KategoriEventOrganizer::all();

        return view('admin.elearning.edit', compact('elearning', 'categories'));
    }

    public function update(ElearningUpdateRequest $request, $id)
    {
        $validation = $request->validated();

        DB::beginTransaction();
        try {
            $elearning = EventOrganizer::findOrFail($id);

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
        $elearning = EventOrganizer::findOrFail($id);

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

    // public function showFotoThumbnail($path)
    // {
    //     // Cek apakah file ada di disk 'local' (folder storage/app)
    //     if (!Storage::disk('local')->exists($path)) {
    //         abort(404, 'Foto tidak ditemukan');
    //     }
    //     // Mengembalikan response file secara langsung
    //     return Storage::disk('local')->response($path);
    // }


}
