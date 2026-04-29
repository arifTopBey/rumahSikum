<?php

namespace App\Exports;

use App\Models\UsahaKarakteristik;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PertumbuhanUsahaExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $tahun;
    protected $skala;
    protected $search;

    public function __construct($tahun = null, $skala = null, $search = null)
    {
        $this->tahun  = $tahun;
        $this->skala  = $skala;
        $this->search = $search;
    }

    public function query()
    {
        $query = UsahaKarakteristik::query()
            ->with(['identitasUsaha', 'skalaUsaha'])
            ->where('tahun_mulai_operasi', $this->tahun);

        // Filter Skala
        if (!empty($this->skala) && $this->skala !== 'null') {
            $skala = $this->skala;
            $query->whereHas('skalaUsaha', function ($q) use ($skala) {
                $q->where('skala_usaha', $skala);
            });
        }

        // Filter Search
        if (!empty($this->search)) {
            $search = $this->search;
            $query->whereHas('identitasUsaha', function ($q) use ($search) {
                $q->where('nama_lengkap_usaha', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('desa', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            ucfirst($row->skalaUsaha->skala_usaha    ?? '-'),
            $row->tahun_mulai_operasi                ?? '-',
            $row->identitasUsaha->kecamatan          ?? '-',
            $row->identitasUsaha->kelurahan          ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Tahun Mulai Operasi',
            'Kecamatan',
            'Desa/Kelurahan',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}