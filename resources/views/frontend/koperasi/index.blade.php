@extends('frontend.main.index')

@section('content')
<header class="koperasi-header">
        <div class="container text-center">
            <h1 class="fw-800 display-5 mb-3">Penguatan Ekonomi Kerakyatan</h1>
            <p class="opacity-75 mb-5">Manajemen transparan dan modern untuk Koperasi di Kabupaten Tangerang.</p>
            
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold mb-0">1,240</h2>
                    <small class="opacity-50 text-uppercase ls-1">Koperasi Terdaftar</small>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold mb-0">85K+</h2>
                    <small class="opacity-50 text-uppercase ls-1">Anggota Aktif</small>
                </div>
            </div>
        </div>
    </header>

    <section class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card h-100">
                    <div class="icon-circle"><i data-lucide="file-text"></i></div>
                    <h5 class="fw-bold">Legalitas & Izin</h5>
                    <p class="text-muted small">Panduan lengkap pendirian koperasi baru dan pengurusan NIK Koperasi.</p>
                    <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold">Pelajari Selengkapnya &rarr;</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card h-100">
                    <div class="icon-circle"><i data-lucide="bar-chart-3"></i></div>
                    <h5 class="fw-bold">Pelaporan RAT</h5>
                    <p class="text-muted small">Sistem pelaporan Rapat Anggota Tahunan secara digital dan mandiri.</p>
                    <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold">Input Laporan &rarr;</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card h-100">
                    <div class="icon-circle"><i data-lucide="shield-check"></i></div>
                    <h5 class="fw-bold">Koperasi Sehat</h5>
                    <p class="text-muted small">Cek status kesehatan dan kepatuhan koperasi Anda di Kabupaten Tangerang.</p>
                    <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold">Cek Status &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <main class="container py-5 mt-4">
        <div class="row mb-4 align-items-end">
            <div class="col-md-6">
                <h3 class="fw-bold">Direktori Koperasi</h3>
                <p class="text-muted">Temukan koperasi berdasarkan wilayah dan jenis usaha.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex gap-2 justify-content-md-end">
                    <input type="text" class="form-control rounded-pill border-0 shadow-sm px-4" placeholder="Cari nama koperasi..." style="width: 250px;">
                    <button class="btn btn-outline-dark rounded-pill px-4">Filter</button>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <div class="coop-item shadow-sm d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i data-lucide="building-2" class="text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Koperasi Pegawai Republik Indonesia (KPRI) Berkah</h6>
                            <p class="small text-muted mb-0"><i data-lucide="map-pin" size="12"></i> Kec. Tigaraksa | No. Badan Hukum: 123/BH/KOP/2023</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="status-badge bg-success-light">AKTIF & SEHAT</span>
                        <button class="btn btn-light btn-sm rounded-pill px-3 fw-semibold">Detail Profil</button>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="coop-item shadow-sm d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i data-lucide="shopping-cart" class="text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Koperasi Konsumen Citra Maju Jaya</h6>
                            <p class="small text-muted mb-0"><i data-lucide="map-pin" size="12"></i> Kec. Cikupa | No. Badan Hukum: 456/BH/KOP/2022</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="status-badge bg-success-light">AKTIF</span>
                        <button class="btn btn-light btn-sm rounded-pill px-3 fw-semibold">Detail Profil</button>
                    </div>
                </div>
            </div>
            
            </div>

        <div class="text-center mt-5">
            <button class="btn btn-white shadow-sm rounded-pill px-5 py-2 fw-bold">Lihat Lebih Banyak Koperasi</button>
        </div>
    </main>
@endsection