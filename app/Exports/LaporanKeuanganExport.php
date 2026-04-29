<?php

namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class LaporanKeuanganExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $keuangan;
    protected $skala;
    protected $search;

    public function __construct($keuangan = null, $skala = null, $search = null)
    {
        $this->keuangan = $keuangan;
        $this->skala    = $skala;
        $this->search   = $search;
    }

    public function query()
    {
        $status = ($this->keuangan == 'Memiliki') ? 1 : 2;

        $query = LaporanKeuangan::with(['identitasUsaha', 'skalaUsaha'])
            ->where('status_pencatatan_keuangan', $status);

        // Filter Search — gunakan scope yang sama dengan filterLaporanKeuangan
        if (!empty($this->search)) {
            $query->search(['search' => $this->search]);
        }

        // Filter Skala
        if (!empty($this->skala) && $this->skala !== 'null') {
            $query->whereHas('skalaUsaha', function ($q) {
                $q->where('skala_usaha', $this->skala);
            });
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->identitasUsaha->nama_lengkap_usaha          ?? '-',
            ucfirst($row->skalaUsaha->skala_usaha             ?? '-'),
            $row->identitasUsaha->kecamatan                   ?? '-',
            $row->identitasUsaha->telpon                      ?? '-',
            $row->status_pencatatan_keuangan == 1 ? 'Memiliki' : 'Tidak Memiliki',
            // Tambahkan kolom lain sesuai kebutuhan
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Kecamatan',
            'Telepon',
            'Status Pencatatan Keuangan',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}