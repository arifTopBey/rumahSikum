<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdressStoreRequest;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index(Request $request){

        $addresses = Address::all();
        return view('admin.alamat.index', compact('addresses'));
    }

    public function store(AdressStoreRequest $request){
    
        $validated = $request->validated();
        DB::beginTransaction();

        try{

            $address = new Address();
            $address->name = $validated['name'];
            $address->label_name = $validated['label_name'];
            $address->user_id = auth()->user()->id;
            $address->phone = $validated['phone'];
            $address->email = $validated['email'];
            $address->address = $validated['address'];
            $address->kecamatan = $validated['kecamatan'];
            $address->zip = $validated['zip'];
            $address->save();

            DB::commit();
            return redirect()->route('user.address')->with('success', 'Berhasil membuat alamat pengiriman');
            // Address::create($validated);
            
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat Alamat: ' . $e->getMessage());
        }
        
    }

    public function update(Request $request, $id){

        $address = Address::findOrFail($id);

        DB::beginTransaction();

        try{
                $address->update([
                    'label_name' => $request->label_name,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'kecamatan' => $request->kecamatan,
                    'zip' => $request->zip,
                ]);
                DB::commit();

            return redirect()->back()->with('success', 'Alamat berhasil diupdate');
            
        }catch(Exception $e){

            return redirect()->back()->with('error', 'Gagal Mengapdate Alamat: ' . $e->getMessage());

    }

}

    public function destroy($id){
         DB::beginTransaction();
        try{

            $address = Address::findOrFail($id);
            $address->delete();
            DB::commit();

            return redirect()->route('user.address')->with('success', 'Berhasil Menghapus Alamat pengiriman');
            
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus  Alamat: ' . $e->getMessage());
        }

    }



}
