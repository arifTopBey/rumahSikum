<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NarasumberStoreRequest;
use App\Models\EventOrganizer;
use App\Models\Narasumber;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NarasumberController extends Controller
{
     public function index($id){

        $narasumber = Narasumber::where('event_organizer_id', $id)->get();
        $event = EventOrganizer::where('id', $id)->first();

        return view('admin.elearning.narasumber.index', compact('narasumber', 'event'));
    }

    public function store(NarasumberStoreRequest $request, $id){

        $event = EventOrganizer::where('id', $id)->first();

        $validated = $request->validated();

        DB::beginTransaction();

        try{

            $narasumber = new Narasumber();
            $narasumber->event_organizer_id = $event->id;
            $narasumber->nama = $validated['nama'];
            $narasumber->keahlian_jabatan = $validated['keahlian_jabatan'];
            $narasumber->bio = $validated['bio'];
            $narasumber->foto = $validated['foto']->store('narasumber', 'local');
           
            $narasumber->save();
            DB::commit();

            return redirect()->route('admin.narasumber.index', $event->id)->with('success', 'Narasumber berhasil disimpan');

        }catch(Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat Materi: ' . $exception->getMessage());
        }
    }

    public function destroy($idEvent, $id){

          $event = EventOrganizer::where('id', $idEvent)->first();

         DB::beginTransaction();
        try{

            $narasumber = Narasumber::where('event_organizer_id', $event->id)->where('id', $id)->first();
             if($narasumber->foto){
                Storage::disk('local')->delete($narasumber->foto);
            }
            $narasumber->delete();
           
            DB::commit();

            return redirect()->route('admin.narasumber.index', $event->id)->with('success', 'Narasumber berhasil disimpan');

        }catch(Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat Materi: ' . $exception->getMessage());
        }
    }
}
