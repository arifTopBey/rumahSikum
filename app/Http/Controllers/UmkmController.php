<?php

namespace App\Http\Controllers;

use App\Interface\UmkmDataInterface;
use App\Models\IdentitasUsaha;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    // protected UmkmDataInterface $umkmInterface;

    // public function __construct(UmkmDataInterface $umkmInterface)
    // {
    //     $this->umkmInterface = $umkmInterface;
    // }

    public function index(Request $request)
    {

        $data = IdentitasUsaha::orderByDesc('id_badan_usaha')->search(request(['search']))->paginate(10)->withQueryString();



        return view('admin.umkm.index', compact('data'));
    }

    public function show($id_badan_usaha)
    {
        // $data = IdentitasUsaha::with(['usahaKarakteristik', 'laporanKeuangan', 'tenagaKerja', 'tanggalPendataan'])->findOrFail($id_badan_usaha);
        $data = IdentitasUsaha::where('id_badan_usaha', $id_badan_usaha)->with(['laporanKeuangan'])->first();

        return view('admin.umkm.show', compact('data'));
    }

    // public function sebaranDataUmkm()
    // {
    //     $result = $this->umkmInterface->getUmkmData(10, 1);
    //     $totalUmkm = $result['meta']['total_data'] ?? 0; 
    //     return view('admin.informasi_data_umkm.index', compact('totalUmkm'));
    // }
}
