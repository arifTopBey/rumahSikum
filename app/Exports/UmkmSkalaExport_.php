<?php

namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;


class UmkmSkalaExport_ implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithChunkReading, ShouldQueue
{
    protected $skala;

    public function __construct($skala)
    {
        $this->skala = $skala;
    }

    public function query()
    {
        $query = LaporanKeuangan::query()
        ->join('identitasusaha', 'identitasusaha.id_badan_usaha', '=', 'usaha_laporan_keuangan.id_badan_usaha')
        ->select(
            'identitasusaha.nama_lengkap_usaha',
            'identitasusaha.provinsi',
            'identitasusaha.kabupaten',
            'identitasusaha.kecamatan',
            'usaha_laporan_keuangan.omzet_usaha'
        );

        if ($this->skala == 'mikro') {
            $query->where('usaha_laporan_keuangan.omzet_usaha', '<=', 2000000);
        }

        if ($this->skala == 'kecil') {
            $query->whereBetween('usaha_laporan_keuangan.omzet_usaha', [2000001, 15000000]);
        }

        if ($this->skala == 'menengah') {
            $query->whereBetween('usaha_laporan_keuangan.omzet_usaha', [15000001, 50000000]);
        }

        return $query;
    }

    // 🔹 Judul Kolom
    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Provinsi',
            'Kab/Kota',
            'Kecamatan',
            'Omzet'
        ];
    }

    // 🔹 Atur Isi Setiap Baris
    public function map($row): array
    {
         if ($row->omzet_usaha <= 2000000) {
        $skala = 'Mikro';
    } elseif ($row->omzet_usaha <= 15000000) {
        $skala = 'Kecil';
    } else {
        $skala = 'Menengah';
    }

    return [
        $row->nama_lengkap_usaha ?? '-',
        $skala,
        preg_replace('/^[0-9.]+\s+/', '', $row->provinsi ?? ''),
        preg_replace('/^[0-9.]+\s+/', '', $row->kabupaten ?? ''),
        preg_replace('/^[0-9.]+\s+/', '', $row->kecamatan ?? ''),
        number_format($row->omzet_usaha, 0, ',', '.'),
    ];
}

public function chunkSize(): int
{
    return 3000;
}
}
