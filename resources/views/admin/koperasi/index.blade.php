@extends('admin.main.main')

@section('content')
<style>
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        transition: opacity 0.3s ease;
    }
    .spinner-coop {
        width: 3rem;
        height: 3rem;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #00997a;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div id="loading-overlay">
    <div class="spinner-coop"></div>
    <h5 class="mt-3 text-secondary fw-bold">Memuat & Menyusun Data Koperasi...</h5>
    <small class="text-muted">Mohon tunggu sebentar</small>
</div>

<div class="container-fluid mt-4">
    <h4 class="mb-4 text-dark fw-bold">Data Koperasi Wilayah {{ $result['provinsi'] ?? '' }}</h4>

    
    <div class="card card-filter p-3 mb-4 shadow-sm border-0">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Wilayah Keanggotaan</label>
                <select class="form-select" id="filter-wilayah">
                    <option value="">Semua Wilayah ({{ $result['kabupaten'] ?? 'Tangerang' }})</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Status Sertifikat</label>
                <select class="form-select" id="filter-sertifikat">
                    <option value="">Semua Status</option>
                    <option value="Sertifikat Aktif">Sertifikat Aktif</option>
                    <option value="Expired">Expired / Kosong</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-5">
            <label class="form-label fw-bold">Pencarian Cepat</label>
            <div class="input-group mb-1">
                <input type="text" id="search-input" class="form-control" placeholder="Masukkan NIK, Nama Koperasi...">
                <button class="btn text-white" style="background-color: #00997a;">Cari</button>
            </div>
            <small class="text-muted">* Menampilkan {{ count($result['data'] ?? []) }} data teratas</small>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0" id="table-koperasi">
                        <thead class="text-center text-white">
                            <tr>
                                <th style="background-color: #00997a; color: white; width: 5%">No</th>
                                <th style="background-color: #00997a; color: white; width: 12%">NIK</th>
                                <th style="background-color: #00997a; color: white; width: 15%">Nomor Badan Hukum</th>
                                <th style="background-color: #00997a; color: white; width: 10%">Tanggal BH</th>
                                <th style="background-color: #00997a; color: white; width: 20%">Nama Koperasi</th>
                                <th class="fs-7" style="background-color: #00997a; color: white; width: 3%">Desa/Kelurahan</th>
                                <th style="background-color: #00997a; color: white; width: 10%">Kecamatan</th>
                                <th style="background-color: #00997a; color: white; width: 10%">Alamat</th>
                                <th style="background-color: #00997a; color: white; width: 2%">Jenis Koperasi</th>
                                <th style="background-color: #00997a; color: white; width: 5%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($result['data'] ?? [] as $koperasi)
                            <tr>
                                <td class="text-center fw-bold">{{ $koperasi['No'] }}</td>
                                <td>
                                    <a href="#" class="text-decoration-none fw-bold text-primary">
                                        {{ $koperasi['NIK'] }}
                                    </a>
                                </td>
                                <td>{{ $koperasi['Nomor_Badan_Hukum_Pendirian'] ?? '-' }}</td>
                                <td class="text-nowrap">{{ $koperasi['Tanggal_Badan_Hukum_Pendirian'] ?? '-' }}</td>
                                <td class="fw-bold text-dark">{{ $koperasi['Nama_Koperasi'] }}</td>
                                <td class="fs-7" >{{ $koperasi['Desa'] ?? '-' }}</td>
                                <td class="fs-7">{{ str_replace($koperasi['Kecamatan'] ?? '', '', '') ? $koperasi['Kecamatan'] : $koperasi['Kecamatan'] }}</td>
                                <td><small class="text-muted">{{ $koperasi['Alamat'] ?? '-' }}</small></td>
                                <td class="text-center fs-7">
                                    <span class="badge bg-secondary">{{ $koperasi['Jenis_Koperasi'] ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.koperasi.detail', $koperasi['NIK']) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-eye">Detail</i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Tidak ada data koperasi yang ditampilkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Menghilangkan efek loading setelah seluruh DOM dan data selesai di-render browser
        const loader = document.getElementById('loading-overlay');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300); // transisi halus hilang
        }
    });
</script>
@endsection