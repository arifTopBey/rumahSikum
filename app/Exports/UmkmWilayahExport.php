<?php

namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class UmkmWilayahExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $kecamatan;

    public function __construct($kecamatan)
    {
        $this->kecamatan = $kecamatan;
    }

    public function query()
    {
        return LaporanKeuangan::with('identitasUsaha')
            ->whereHas('identitasUsaha', function ($q) {
                $q->where('kecamatan', 'like', "%{$this->kecamatan}%");
            });
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Provinsi',
            'Kabupaten',
            'Kecamatan'
        ];
    }

    public function map($row): array
    {
        $skala = 'Menengah';

        if ($row->omzet_usaha <= 2000000) {
            $skala = 'Mikro';
        } elseif ($row->omzet_usaha <= 15000000) {
            $skala = 'Kecil';
        }

        return [
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            $skala,
            $row->identitasUsaha->provinsi ?? '-',
            $row->identitasUsaha->kabupaten ?? '-',
            $row->identitasUsaha->kecamatan ?? '-',
        ];
    }

     public function chunkSize(): int
    {
        return 2000;
    }
}
