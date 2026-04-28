<?php

namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class UmkmWilayahKelurahanExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $kelurahan;
    protected $skala;
    protected $search;

    public function __construct($kelurahan, $skala = null, $search = null)
    {
        $this->kelurahan = $kelurahan;
        $this->skala = $skala;
        $this->search = $search;
    }

   public function query()
{
    // Gunakan Eager Loading untuk identitasUsaha dan skalaUsaha
    $query = LaporanKeuangan::with(['identitasUsaha', 'skalaUsaha']);

    // Filter kelurahan (Wajib ada)
    $query->whereHas('identitasUsaha', function ($q) {
        $q->where('kelurahan', 'like', "%{$this->kelurahan}%");
    });

    // dd($this->skala);
    // Filter Skala - Pastikan tidak kosong dan bukan string "null"
    if (!empty($this->skala) && $this->skala !== 'null') {
        $query->whereHas('skalaUsaha', function ($q) {
            // Gunakan where karena kita mencari nilai eksak (mikro/kecil/menengah)
            $q->where('skala_usaha', $this->skala);
        });
    }

    // Filter Search
    if (!empty($this->search)) {
        $query->whereHas('identitasUsaha', function ($q) {
            $q->where(function($sub) {
                $sub->where('nama_lengkap_usaha', 'like', "%{$this->search}%")
                    ->orWhere('kelurahan', 'like', "%{$this->search}%");
            });
        });
    }

    return $query;
}

public function map($row): array
{
    return [
        $row->identitasUsaha->nama_lengkap_usaha ?? '-',
        ucfirst($row->skalaUsaha->skala_usaha ?? '-'),
        $row->identitasUsaha->provinsi ?? '-',
        $row->identitasUsaha->kabupaten ?? '-',
        $row->identitasUsaha->kelurahan ?? '-',
    ];
}
    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Provinsi',
            'Kabupaten',
            'Kelurahan'
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}




