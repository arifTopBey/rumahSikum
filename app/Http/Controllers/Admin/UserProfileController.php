<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index(Request $request, ){

        return view('admin.profile.index');
    }

    public function update(ProfileUpdateRequest $request, $id){

        $validated = $request->validated();

        DB::beginTransaction();

        try{
            $user =  User::findOrFail($id);
            $user->name = $validated['name'];
            $user->phone = $validated['phone'];
            $user->email = $validated['email'];
            if(isset($validated['password'])){
                $user->password = bcrypt($validated['password']);
            }
            if($request->hasFile('image_profile')){
                if($user->image_profile){
                    Storage::disk('local')->delete($user->image_profile);
                }
                    $user->image_profile = $validated['image_profile']->store('image_profile', 'local');
            }

            $user->save();
            DB::commit();   
            return redirect()->route('user.prfile.index', $user->id)->with('success', 'Profile berhasil diperbarui');

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan profile: ' . $e->getMessage());
        }


    }

    // akses foto profile
     public function showFotoProfil($path) {   
   
        if (!Storage::disk('local')->exists($path)) {
            abort(404, "File tidak ada di storage/app/" . $path);
        }

        return Storage::disk('local')->response($path);
    }

    
}
