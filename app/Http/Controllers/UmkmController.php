<?php

namespace App\Http\Controllers;

use App\Interface\UmkmInterface;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    protected UmkmInterface $umkmInterface;

    public function __construct(UmkmInterface $umkmInterface)
    {
        $this->umkmInterface = $umkmInterface;
    }

    public function index(Request $request)
    {
        // Ambil halaman saat ini dari URL, default ke 1
        $page = $request->get('page', 1);
        
        $result = $this->umkmInterface->getUmkmData(10, $page);

        // Berdasarkan struktur JSON API Anda biasanya data ada di dalam $result['data']
        $data = $result['data'] ?? [];
        
        return view('admin.umkm.index', compact('data', 'page'));
    }

    public function sebaranDataUmkm()
    {
        $result = $this->umkmInterface->getUmkmData(10, 1);
        $totalUmkm = $result['meta']['total_data'] ?? 0; 
        return view('admin.informasi_data_umkm.index', compact('totalUmkm'));
    }
}
