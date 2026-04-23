<?php 
// app/Exports/UsahaBerdasarkanOmset.php
namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsahaBerdasarkanOmset implements FromQuery, WithHeadings, WithChunkReading, WithMapping
{
    protected $skala;
    protected $search;

    public function __construct($skala = null, $search = null)
    {
        $this->skala   = $skala;
        $this->search  = $search;
    }

    public function query()
    {
        $query = LaporanKeuangan::with('identitasUsaha');

        if ($this->skala == 'Di Bawah 2 Miliar') {
            $query->where('omzet_usaha', '<', 2000000000);
        } elseif ($this->skala == '2 Miliar - 15 Miliar') {
            $query->whereBetween('omzet_usaha', [2000000000, 15000000000]);
        } elseif ($this->skala == '15 Miliar - 50 Miliar') {
            $query->whereBetween('omzet_usaha', [15000000001, 50000000000]);
        }

        if ($this->search) {
            $query->search(['search' => $this->search]);
        }

        return $query;
    }

    public function map($row): array
    {
        $skalaLabel = '';
        if ($row->omzet_usaha <= 2_000_000_000) {
            $skalaLabel = 'Usaha Mikro';
        } elseif ($row->omzet_usaha <= 15_000_000_000) {
            $skalaLabel = 'Usaha Kecil';
        } else {
            $skalaLabel = 'Usaha Menengah';
        }

        return [
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            $skalaLabel,
            preg_replace('/^[0-9.]+\s+/', '', $row->identitasUsaha->provinsi  ?? '-'),
            preg_replace('/^[0-9.]+\s+/', '', $row->identitasUsaha->kabupaten ?? '-'),
            preg_replace('/^[0-9.]+\s+/', '', $row->identitasUsaha->kecamatan ?? '-'),
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Provinsi',
            'Kab/Kota',
            'Kecamatan',
        ];
    }

    public function chunkSize(): int
    {
        return 5000; // proses 5000 baris per batch
    }
}