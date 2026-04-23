<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PertumbuhanUsahaMikro;
use App\Exports\UsahaBerdasarkanOmset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportPertumbuhan(Request $request){
        $tahun = $request->tahun;
        $search = $request->search;
        $skala = $request->skala;

        return Excel::download(
            new PertumbuhanUsahaMikro($tahun, $search, $skala),
            'pertumbuhan-usaha.xlsx'
        );
    }

    public function exportBerdasarkanOmset(Request $request){

        // return Excel::download(
        //     new UsahaBerdasarkanOmset(
        //         $request->skala,
        //         $request->search
        //     ),
        //     'usaha-berdasarkan-omset.xlsx'
        // );

        set_time_limit(300);
        ini_set('memory_limit', '512M');

        return Excel::download(
            new UsahaBerdasarkanOmset(
                $request->skala,
                $request->search
            ),
            'usaha-berdasarkan-omset.xlsx'
        );
    }
}
