<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index(){
        
        $users = User::orderByDesc('id')->get();
        return view('admin.pengguna.index', compact('users'));
    }

    public function show($id){

        $user = User::where('id', $id)->first();    
        return view('admin.pengguna.detail', compact('user'));
    }

    public function update($id){

    DB::beginTransaction();
        try{

        }catch(Error $e){
            DB::rollBack();

        }
    }
    
    public function edit($id){

    }

    public function destroy($id){

        DB::beginTransaction();
        
        try{
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();

            return redirect()->route('admin.daftar.pengguna.index')->with('success', 'user berhasil dihapus');
        }catch(Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal Hapus User ' . $e->getMessage());
        }
    }
}




