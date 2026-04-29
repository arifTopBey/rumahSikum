<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class PertumbuhanUsahaMikroOldy implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $tahun, $search, $skala;

    public function __construct($tahun, $search, $skala)
    {
        $this->tahun = $tahun;
        $this->search = $search;
        $this->skala = $skala;
    }

    public function collection()
    {
        $query = DB::table('usaha_karakteristik as uk')
            ->join('identitasusaha as iu', 'uk.id_badan_usaha', '=', 'iu.id_badan_usaha')
            ->join('usaha_laporan_keuangan as ulk', 'ulk.id_badan_usaha', '=', 'iu.id_badan_usaha')
            ->select(
                'iu.nama_lengkap_usaha',
                'ulk.omzet_usaha',
                'iu.provinsi',
                'iu.kabupaten',
                'iu.kecamatan',
                'uk.tahun_mulai_operasi'
            )
            ->where('uk.tahun_mulai_operasi', $this->tahun);

        // Filter skala
        if ($this->skala) {
            if ($this->skala == 'mikro') {
                $query->where('ulk.omzet_usaha', '<=', 2000000);
            } elseif ($this->skala == 'kecil') {
                $query->whereBetween('ulk.omzet_usaha', [2000001, 15000000]);
            } elseif ($this->skala == 'menengah') {
                $query->whereBetween('ulk.omzet_usaha', [15000001, 50000000]);
            }
        }

        // Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('iu.nama_lengkap_usaha', 'like', "%{$this->search}%")
                  ->orWhere('iu.kecamatan', 'like', "%{$this->search}%")
                  ->orWhere('iu.kelurahan', 'like', "%{$this->search}%");
            });
        }

        // return $query->get();
        return $query->get()->map(function ($item) {
        return [
            'Nama Usaha' => $item->nama_lengkap_usaha,
            'Omzet' => $item->omzet_usaha,

            // 🔥 HAPUS KODE DEPAN
            'Provinsi' => preg_replace('/^[0-9.]+\s*/', '', $item->provinsi),
            'Kabupaten' => preg_replace('/^[0-9.]+\s*/', '', $item->kabupaten),
            'Kecamatan' => preg_replace('/^[0-9.]+\s*/', '', $item->kecamatan),

            'Tahun Mulai' => $item->tahun_mulai_operasi,
        ];
      });
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Omzet',
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Tahun Mulai'
        ];
    }
}