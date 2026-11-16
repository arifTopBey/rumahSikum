<?php

namespace App\Exports;

use App\Models\UsahaKarakteristik;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StatusUsahaExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $status;
    protected $skala;
    protected $search;

    protected $statusMap = [
        'pt'          => 1,
        'yayasan'     => 2,
        'cv'          => 3,
        'firma'       => 4,
        'nv'          => 5,
        'danaPensiun' => 6,
        'perorangan'  => 7,
        'lainnya'     => 8,
    ];

    protected $statusLabel = [
        'pt'          => 'PT',
        'yayasan'     => 'Yayasan',
        'cv'          => 'CV',
        'firma'       => 'Firma',
        'nv'          => 'NV',
        'danaPensiun' => 'Dana Pensiun',
        'perorangan'  => 'Perorangan',
        'lainnya'     => 'Lainnya',
        'none'        => 'Tidak Memiliki Status',
    ];

    public function __construct($status = null, $skala = null, $search = null)
    {
        $this->status = $status;
        $this->skala  = $skala;
        $this->search = $search;
    }

    public function query()
    {
        $query = UsahaKarakteristik::query()
            ->with(['identitasUsaha', 'keuangan', 'skalaUsaha']);

        // Filter Status Badan Usaha
        if (isset($this->statusMap[$this->status])) {
            $query->where('status_badan_usaha', $this->statusMap[$this->status]);
        } elseif ($this->status == 'none') {
            $query->whereNull('status_badan_usaha');
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
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            ucfirst($row->skalaUsaha->skala_usaha    ?? '-'),
            $this->statusLabel[$this->status]        ?? '-',
            $row->identitasUsaha->kecamatan          ?? '-',
            $row->identitasUsaha->alamat_lengkap      ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Status Badan Usaha',
            'Kecamatan',
            'Alamat',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}