<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MateriStoreRequest;
use App\Models\EventMaterial;
use App\Models\EventOrganizer;
use Exception;
use Illuminate\Support\Facades\DB;

class EventMaterialController extends Controller
{
    public function index($id){

        $materi = EventMaterial::where('event_organizer_id', $id)->get();
        $event = EventOrganizer::where('id', $id)->first();

        return view('admin.elearning.materi.index', compact('materi', 'event'));
    }

    public function store(MateriStoreRequest $request, $id){

        $event = EventOrganizer::where('id', $id)->first();

        $validated = $request->validated();

        DB::beginTransaction();

        try{

            $materi = new EventMaterial();
            $materi->event_organizer_id = $event->id;
            $materi->tipe_materi = $validated['tipe_materi'];
            $materi->judul = $validated['judul'];
            $materi->deskripsi = $validated['deskripsi'];

            if(isset($validated['file'])){
                $materi->file = $validated['file'];
            }

            $materi->tautan = $validated['tautan'];
            $materi->save();
            DB::commit();

            return redirect()->route('admin.elearning.materi.index', $event->id)->with('success', 'Materi Elearning berhasil disimpan');

        }catch(Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat Materi: ' . $exception->getMessage());
        }
    }

    public function destroy($idEvent, $id){

          $event = EventOrganizer::where('id', $idEvent)->first();

         DB::beginTransaction();
        try{

            $materi = EventMaterial::where('event_organizer_id', $event->id)->where('id', $id);
           
            $materi->delete();
            DB::commit();

            return redirect()->route('admin.elearning.materi.index', $event->id)->with('success', 'Materi Elearning berhasil disimpan');

        }catch(Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat Materi: ' . $exception->getMessage());
        }
    }
}