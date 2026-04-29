<?php

namespace App\Exports;

use App\Models\UsahaPerizinan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PerizinanExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $izin;
    protected $skala;
    protected $search;

    protected $izinLabel = [
        'pirt'  => 'PIRT',
        'bpom'  => 'BPOM',
        'tdp'   => 'TDP',
        'halal' => 'Halal',
    ];

    public function __construct($izin = null, $skala = null, $search = null)
    {
        $this->izin   = $izin;
        $this->skala  = $skala;
        $this->search = $search;
    }

    public function query()
    {
        $query = UsahaPerizinan::with(['identitasUsaha', 'laporanKeuangan', 'skalaUsaha']);

        // Filter Izin
        if ($this->izin == 'pirt') {
            $query->where('memiliki_pirt', 1);
        } elseif ($this->izin == 'bpom') {
            $query->where('memiliki_bpom', 1);
        } elseif ($this->izin == 'tdp') {
            $query->where('memiliki_tdp', 1);
        } elseif ($this->izin == 'halal') {
            $query->where('memiliki_sertifikat_halal', 1);
        }

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
                  ->orWhere('kecamatan', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->identitasUsaha->nama_lengkap_usaha         ?? '-',
            ucfirst($row->skalaUsaha->skala_usaha            ?? '-'),
            $row->identitasUsaha->kecamatan                  ?? '-',
            $this->izinLabel[$this->izin]                    ?? '-',
            $row->memiliki_pirt                 == 1 ? 'Ya' : 'Tidak',
            $row->memiliki_bpom                 == 1 ? 'Ya' : 'Tidak',
            $row->memiliki_tdp                  == 1 ? 'Ya' : 'Tidak',
            $row->memiliki_sertifikat_halal     == 1 ? 'Ya' : 'Tidak',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Kecamatan',
            'Filter Izin Aktif',
            'PIRT',
            'BPOM',
            'TDP',
            'Halal',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}