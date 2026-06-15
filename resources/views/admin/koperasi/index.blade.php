@extends('admin.main.main')

@section('content')
<style>
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.85);
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
    /* Mempercantik tampilan pagination DataTables */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3em 0.8em !important;
        border-radius: 6px !important;
    }
</style>

<div id="loading-overlay">
    <div class="spinner-coop"></div>
    <h5 class="mt-3 text-secondary fw-bold">Memuat & Menyusun Data Koperasi...</h5>
    <small class="text-muted">Mohon tunggu sebentar</small>
</div>

<div class="container-fluid mt-4">
    <h4 class="mb-4 text-dark fw-bold">Data Koperasi Wilayah {{ $result['provinsi'] ?? 'BANTEN' }}</h4>

    <div class="card card-filter p-3 mb-4 shadow-sm border-0" style="border-radius: 12px; background: white;">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Wilayah Keanggotaan</label>
                <select class="form-select" id="filter-wilayah" style="border-radius: 8px;">
                    <option value="">Semua Wilayah ({{ $result['kabupaten'] ?? 'Tangerang' }})</option>
                    <option value="KAB. TANGERANG">Kabupaten Tangerang</option>
                    <option value="KOTA TANGERANG">Kota Tangerang</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Status Sertifikat</label>
                <select class="form-select" id="filter-sertifikat" style="border-radius: 8px;">
                    <option value="">Semua Status</option>
                    <option value="Sertifikat Aktif">Sertifikat Aktif</option>
                    <option value="Expired">Expired / Kosong</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-5">
            <label class="form-label fw-bold text-secondary">Pencarian Cepat</label>
            <div class="input-group mb-1">
                <input type="text" id="search-input" class="form-control" placeholder="Masukkan NIK, Nama Koperasi atau Kecamatan..." style="border-radius: 8px 0 0 8px;">
                <button id="btn-search-trigger" class="btn text-white px-4" style="background-color: #00997a; border-radius: 0 8px 8px 0;">Cari</button>
            </div>
            <small class="text-muted">* Mendukung sortir kolom tabel & paginasi otomatis</small>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 p-3" style="border-radius: 12px; background: white;">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0" id="table-koperasi" style="width: 100%;">
                        <thead class="text-white">
                            <tr>
                                <th style="background-color: #00997a; color: white; width: 5%" class="text-center">No</th>
                                <th style="background-color: #00997a; color: white; width: 12%">NIK</th>
                                <th style="background-color: #00997a; color: white; width: 15%">Nomor Badan Hukum</th>
                                <th style="background-color: #00997a; color: white; width: 10%">Tanggal BH</th>
                                <th style="background-color: #00997a; color: white; width: 20%">Nama Koperasi</th>
                                <th style="background-color: #00997a; color: white; width: 10%">Desa/Kelurahan</th>
                                <th style="background-color: #00997a; color: white; width: 10%">Kecamatan</th>
                                <th style="background-color: #00997a; color: white; width: 13%">Alamat</th>
                                <th style="background-color: #00997a; color: white; width: 2%" class="text-center">Jenis Koperasi</th>
                                <th style="background-color: #00997a; color: white; width: 3%" class="text-center">Detail</th>
                                <th class="d-none">Hidden Status</th> <th class="d-none">Hidden Kab</th>     </tr>
                        </thead>
                        <tbody>
                            @forelse($result['data'] ?? [] as $koperasi)
                            <tr>
                                <td class="text-center fw-bold">{{ $koperasi['No'] }}</td>
                                <td>
                                    <a href="#" class="text-decoration-none fw-bold" style="color: #00997a;">
                                        {{ $koperasi['NIK'] }}
                                    </a>
                                </td>
                                <td>{{ $koperasi['Nomor_Badan_Hukum_Pendirian'] }}</td>
                                <td class="text-nowrap">{{ $koperasi['Tanggal_Badan_Hukum_Pendirian'] }}</td>
                                <td class="fw-bold text-dark">{{ $koperasi['Nama_Koperasi'] }}</td>
                                <td>{{ $koperasi['Desa'] }}</td>
                                <td>{{ $koperasi['Kecamatan'] }}</td>
                                <td><small class="text-muted">{{ $koperasi['Alamat'] }}</small></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary px-2 py-1" style="font-size: 0.75rem;">{{ $koperasi['Jenis_Koperasi'] }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.koperasi.detail', $koperasi['NIK']) }}" class="btn btn-sm btn-outline-primary px-2" style="border-radius: 6px;">
                                        <i class="fa fa-eye"> Detail</i>
                                    </a>
                                </td>
                                <td class="d-none">{{ $koperasi['Status_Sertifikat'] }}</td>
                                <td class="d-none">{{ $koperasi['Kabupaten'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center text-muted py-4">Tidak ada data koperasi yang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Inisialisasi DataTables Client-Side
        var table = $('#table-koperasi').DataTable({
            "dom": "lrtip", // Menyembunyikan kolom pencarian bawaan DataTables agar memakai input buatan Anda sendiri
            "pageLength": 10, // Menampilkan data per 10 baris (Sistem Paginasi)
            "lengthMenu": [10, 25, 50, 100],
            "ordering": true, // Mengaktifkan fitur sortir klik header kolom
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json" // Bahasa Indonesia
            }
        });

        // 2. Tombol Cari Custom
        $('#btn-search-trigger').on('click', function() {
            table.search($('#search-input').val()).draw();
        });

        // Jalankan pencarian otomatis saat menekan tombol Enter di keyboard
        $('#search-input').on('keyup', function(e) {
            if (e.key === 'Enter') {
                table.search(this.value).draw();
            }
        });

        // 3. Dropdown Filter Wilayah Keanggotaan (Mencari di index kolom tersembunyi ke-11)
        $('#filter-wilayah').on('change', function() {
            table.column(11).search($(this).val()).draw();
        });

        // 4. Dropdown Filter Status Sertifikat (Mencari di index kolom tersembunyi ke-10)
        $('#filter-sertifikat').on('change', function() {
            var targetVal = $(this).val();
            // Menggunakan regex exact match agar datanya tersaring akurat
            table.column(10).search(targetVal ? '^' + targetVal + '$' : '', true, false).draw();
        });

        // 5. Menghilangkan Loading Overlay secara halus (Fade-out)
        const loader = document.getElementById('loading-overlay');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300);
        }
    });
</script>
@endsection