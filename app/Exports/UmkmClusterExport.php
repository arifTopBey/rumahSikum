<?php

namespace App\Exports;

use App\Models\UsahaKarakteristik;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\DB;

class UmkmClusterExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
    protected $cluster;
    protected $skala;
    protected $search;

    public function __construct($cluster = null, $skala = null, $search = null)
    {
        $this->cluster = $cluster;
        $this->skala   = $skala;
        $this->search  = $search;
    }

    public function query()
    {
        $query = UsahaKarakteristik::query()
            ->with(['identitasUsaha', 'keuangan', 'skalaUsaha'])
            ->whereNotNull('kode_kbli');

        // Filter Skala
        if (!empty($this->skala) && $this->skala !== 'null') {
            $query->whereHas('skalaUsaha', function ($q) {
                $q->where('skala_usaha', $this->skala);
            });
        }

        // Filter Cluster
        if (!empty($this->cluster)) {
            $query->where(function ($q) {
                $cluster = $this->cluster;
                if ($cluster == 'Kuliner') {
                    $q->whereIn(DB::raw('LEFT(kode_kbli, 2)'), ['10', '56']);
                } elseif ($cluster == 'Perdagangan') {
                    $q->whereIn(DB::raw('LEFT(kode_kbli, 2)'), ['46', '47']);
                } elseif ($cluster == 'Industri') {
                    $q->whereIn(DB::raw('LEFT(kode_kbli, 2)'), ['20', '23', '25']);
                } elseif ($cluster == 'Jasa') {
                    $q->whereIn(DB::raw('LEFT(kode_kbli, 2)'), ['77', '95']);
                } elseif ($cluster == 'Pertanian') {
                    $q->where(DB::raw('LEFT(kode_kbli, 2)'), '01');
                } elseif ($cluster == 'Lainnya') {
                    $q->whereNotIn(DB::raw('LEFT(kode_kbli, 2)'), ['10', '56', '46', '47', '20', '23', '25', '77', '95', '01']);
                }
            });
        }

        // Filter Search
        if (!empty($this->search)) {
            $query->whereHas('identitasUsaha', function ($q) {
                $q->where('nama_lengkap_usaha', 'like', "%{$this->search}%")
                  ->orWhere('alamat_lengkap',   'like', "%{$this->search}%")
                  ->orWhere('kecamatan',        'like', "%{$this->search}%")
                  ->orWhere('telpon',           'like', "%{$this->search}%");
            });
        }

        return $query;
    }

    public function map($row): array
    {
        return [
            $row->identitasUsaha->nama_lengkap_usaha ?? '-',
            ucfirst($row->skalaUsaha->skala_usaha ?? '-'),
            $row->kode_kbli ?? '-',
            $this->cluster ?? 'Semua',
            $row->identitasUsaha->kecamatan    ?? '-',
            $row->identitasUsaha->alamat_lengkap ?? '-',
            $row->identitasUsaha->telpon        ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Skala Usaha',
            'Kode KBLI',
            'Cluster',
            'Kecamatan',
            'Alamat',
            'Telepon',
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}