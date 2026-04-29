<?php

namespace App\Exports;

use App\Models\SkalaUsaha;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class NibExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $status;
    protected $skala;
    protected $search;

    public function __construct($status = null, $skala = null, $search = null)
    {
        $this->status = $status;
        $this->skala  = $skala;
        $this->search = $search;
    }

    public function query()
    {
        $query = SkalaUsaha::with(['usahaKarakteristik', 'identitasUsaha']);

        // Filter Status NIB
        if ($this->status == 'Punya') {
            $query->whereHas('usahaKarakteristik', function ($q) {
                $q->whereNotNull('nomor_induk_berusaha')
                  ->where('nomor_induk_berusaha', '!=', '');
            });
        } elseif ($this->status == 'Tidak') {
            $query->whereHas('usahaKarakteristik', function ($q) {
                $q->whereNull('nomor_induk_berusaha');
            });
        }

        // Filter Skala — langsung di tabel skala_usaha (tidak perlu whereHas)
        if (!empty($this->skala) && $this->skala !== 'null') {
            $query->where('skala_usaha', $this->skala);
        }

        // Filter Search — gunakan scope yang sama dengan controller
        if (!empty($this->search)) {
            $query->search(['search' => $this->search]);
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->identitasUsaha->nama_lengkap_usaha              ?? '-',
            ucfirst($row->skala_usaha                             ?? '-'),
            $row->usahaKarakteristik->nomor_induk_berusaha ?? '-',
            $row->identitasUsaha->kecamatan                       ?? '-',
            $row->identitasUsaha->kelurahan                            ?? '-',
            // Kolom status NIB
            !empty($row->usahaKarakteristik->nomor_induk_berusaha) ? 'Punya' : 'Tidak',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Nomor Induk Berusaha',
            'Kecamatan',
            'Desa',
            'Status NIB',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}