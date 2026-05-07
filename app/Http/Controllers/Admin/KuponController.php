<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KuponStoreRequest;
use App\Http\Requests\Admin\KuponUpdateRequest;
use App\Models\Kupon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuponController extends Controller
{
    public function index(){

        $kupons = Kupon::orderByDesc('id')->get();
        return view('admin.kupon.index', compact('kupons'));
    }

    public function create(){

        return view('admin.kupon.create');
    }

    public function store(KuponStoreRequest $request){

        $validated = $request->validated();
        DB::beginTransaction();
        try{
            $kupon = new Kupon();
            $kupon->nama_kupon = $validated['nama_kupon'];
            $kupon->code_kupon = $validated['code_kupon'];
            $kupon->diskon_value = $validated['diskon_value'];
            $kupon->max_use = $validated['max_use'];
            $kupon->tanggal_mulai = $validated['tanggal_mulai'];
            $kupon->tanggal_berakhir = $validated['tanggal_berakhir'];
            $kupon->status_kupon = $validated['status_kupon'];
            $kupon->save();

            DB::commit();
            return redirect()->route('admin.kupon.index')->with('success', 'Kupon berhasil disimpan');

        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Membuat Kupon ' . $exception->getMessage());
        }
    }

    public function rules(): array
    {
        return [
            'nama_kupon' => 'required|string|max:255',

            'code_kupon' => 'required|string|max:255|unique:kupons,code_kupon',

            'diskon_value' => 'required|integer|min:1',

            'status_kupon' => 'nullable',

            'max_use' => 'required|integer|min:1',

            'tanggal_mulai' => 'required|date',

            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }

    public function edit($id){

        $kupon = Kupon::findOrFail($id)->first();

        return view('admin.kupon.edit', compact('kupon'));
    }

    public function update(KuponUpdateRequest $request, $id){

        $validated = $request->validated();
        DB::beginTransaction();
        try{
            $kupon =  Kupon::findOrFail($id);
            $kupon->nama_kupon = $validated['nama_kupon'];
            $kupon->code_kupon = $validated['code_kupon'];
            $kupon->diskon_value = $validated['diskon_value'];
            $kupon->max_use = $validated['max_use'];
            $kupon->tanggal_mulai = $validated['tanggal_mulai'];
            $kupon->tanggal_berakhir = $validated['tanggal_berakhir'];
            $kupon->status_kupon = $validated['status_kupon'];
            $kupon->save();

            DB::commit();
            return redirect()->route('admin.kupon.index')->with('success', 'Kupon berhasil diupdate');

        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Update Kupon ' . $exception->getMessage());
        }
    }

    public function delete($id){

        DB::beginTransaction();

        try{
            $category = Kupon::findOrFail($id);
            
            $category->delete();

            DB::commit();
            return redirect()->route('admin.kupon.index')->with('success', 'Kupon  berhasil dihapus');

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus Kupon: ' . $e->getMessage());
        }

    }
}
