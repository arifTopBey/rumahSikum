<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsahaBerdasarkanDesilController extends Controller
{
    public function index(){

        // ============== point d berdasarkan desil ============================
        $data = DB::table('usaha_laporan_keuangan')
            ->whereNotNull('omzet_usaha')
            ->orderBy('omzet_usaha')
            ->pluck('omzet_usaha');

        $total = $data->count();
        $perDesil = floor($total / 10);


        $desil = [];

        for ($i = 1; $i <= 10; $i++) {

            $start = ($i - 1) * $perDesil;

            if ($i == 10) {
                $slice = $data->slice($start);
            } else {
                $slice = $data->slice($start, $perDesil);
            }

            $desil[] = [
                'desil' => "Desil $i",
                'min' => $slice->min(),
                'max' => $slice->max(),
                'jumlah' => $slice->count()
            ];
        }

        $labelsDesils = collect($desil)->pluck('desil');
        $valuesDesils = collect($desil)->pluck('jumlah');

        $desil14 = collect($desil)->slice(0, 4);
        $desil510 = collect($desil)->slice(4, 6);

        $totalDesil14 = $desil14->sum('jumlah');
        $totalDesil510 = $desil510->sum('jumlah');

        $laki14 = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('omzet_usaha')
            ->where('identitas_pengusaha.status_pengusaha', 1)
            ->limit($totalDesil14)
            ->count();

        $perempuan14 = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('omzet_usaha')
            ->where('identitas_pengusaha.status_pengusaha', 2)
            ->limit($totalDesil14)
            ->count();

        $data510 = DB::table('usaha_laporan_keuangan')
            ->join('identitas_pengusaha', 'identitas_pengusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
            ->whereNotNull('omzet_usaha')
            ->orderBy('omzet_usaha')
            ->offset($totalDesil14)
            ->limit($totalDesil510)
            ->get();

        $laki510 = $data510->where('status_pengusaha', 1)->count();
        $perempuan510 = $data510->where('status_pengusaha', 2)->count();
        // ============== batas menggunakan desil ==============================

        return view('admin.informasi_data_umkm.partial.desil', compact('labelsDesils', 'valuesDesils', 'perempuan14', 'laki14', 'perempuan510','laki510', 'totalDesil14', 'totalDesil510'));
    }
}
