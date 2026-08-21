<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRegistrationRequest;
use App\Models\EventRegistration;
use Exception;
use Illuminate\Support\Facades\DB;

class EventRegistrationController extends Controller
{
    
    public function store(EventRegistrationRequest $request, $id){

          $validated = $request->validated();

         DB::beginTransaction();

        try{

            $register = new EventRegistration();
            $register->user_id = auth()->user()->id;
            $register->event_organizer_id = $id;
            $register->nama = $validated['nama'];
            $register->no_hp = $validated['no_hp'];
            $register->email = $validated['email'];
            $register->alamat = $validated['alamat'];
            $register->status = 'terdaftar';
            $register->jenis_usaha = $validated['jenis_usaha'];
            $register->nama_usaha = $validated['nama_usaha'];
            $register->lokasi_merchant = $validated['lokasi_merchant'];
            $register->pendapatan_bulanan = $validated['pendapatan_bulanan'];
            $register->save();
            DB::commit();

            return redirect()->back()->with('success', 'Berhasil daftar Event');
        }catch(Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat Materi: ' . $exception->getMessage());
        }
        
    }
}
