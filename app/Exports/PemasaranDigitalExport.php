<?php

namespace App\Exports;

use App\Models\ProduksiDanPemasaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PemasaranDigitalExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $digital;
    protected $skala;
    protected $search;

    public function __construct($digital = null, $skala = null, $search = null)
    {
        $this->digital = $digital;
        $this->skala   = $skala;
        $this->search  = $search;
    }

    public function query()
    {
        $statusValue = ($this->digital == 'Memiliki') ? 1 : 2;

        $query = ProduksiDanPemasaran::with(['identitasUsaha', 'skalaUsaha'])
            ->where('pemasaran_toko_sendiri', $statusValue);

        // Filter Search
        if (!empty($this->search)) {
            $search = $this->search;
            $query->whereHas('identitasUsaha', function ($q) use ($search) {
                $q->where('nama_lengkap_usaha', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('desa', 'like', "%{$search}%");
            });
        }

        // Filter Skala
        if (!empty($this->skala) && $this->skala !== 'null') {
            $skala = $this->skala;
            $query->whereHas('skalaUsaha', function ($q) use ($skala) {
                $q->where('skala_usaha', $skala);
            });
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            ucfirst($row->skalaUsaha->skala_usaha    ?? '-'),
            $row->identitasUsaha->kecamatan          ?? '-',
            $row->identitasUsaha->kelurahan               ?? '-',
            $row->pemasaran_toko_sendiri == 1 ? 'Memiliki' : 'Tidak Memiliki',
            // Tambah kolom lain dari ProduksiDanPemasaran sesuai kebutuhan
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Kecamatan',
            'Desa/Kecamatan',
            'Status Pemasaran Digital',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}