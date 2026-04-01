@extends('frontend.main.index')

@section('content')
  <section class="hero-gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">🚀 Era Digital UMKM Tangerang</span>
                    <h1 class="hero-title mb-4">Berdayakan <span class="text-gradient">Ekonomi Lokal</span> Dalam Satu Genggaman.</h1>
                    <p class="lead text-muted mb-5">Platform terintegrasi untuk pendataan, pemasaran produk unggulan, dan penguatan koperasi di Kabupaten Tangerang.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('frontend.eCommerce') }}" class="btn btn-primary btn-lg rounded-pill px-5">Jelajahi Produk</a>
                        <button class="btn btn-outline-dark btn-lg rounded-pill px-4"><i data-lucide="play-circle" class="me-2"></i>Video Profil</button>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="col-4 stat-box">
                            <h3 class="fw-bold mb-0 text-dark">245K+</h3>
                            <small class="text-muted">UMKM Terdaftar</small>
                        </div>
                        <!-- <div class="col-4 stat-box border-info">
                            <h3 class="fw-bold mb-0 text-dark">120+</h3>
                            <small class="text-muted">Koperasi Aktif</small>
                        </div> -->
                        <div class="col-4 stat-box border-warning">
                            <h3 class="fw-bold mb-0 text-dark">31</h3>
                            <small class="text-muted">Kecamatan</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-flex justify-content-center align-items-center px-5  d-lg-block ">
                    <img style="height: 600px;" src="{{ asset('image/icon.png') }}" class="ms-5 img-fluid mx-auto" height="100" alt="Hero Illustration">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card bento-card bg-blue p-4">
                        <i data-lucide="shopping-bag" class="mb-3" size="40"></i>
                        <h3>Marketplace <br>Lokal</h3>
                        <p class="opacity-75">Beli produk terbaik langsung dari tangan pengrajin lokal.</p>
                        <a href="#" class="btn btn-light btn-sm rounded-pill mt-3 w-50">Buka Toko</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card bento-card bg-white p-4 border shadow-sm">
                                <i data-lucide="users" class="text-primary mb-3"></i>
                                <h5>Legalitas Koperasi</h5>
                                <p class="text-muted small">Urus perizinan dan manajemen koperasi lebih transparan.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bento-card bg-orange p-4">
                                <i data-lucide="trending-up" class="mb-3"></i>
                                <h5>Pelatihan Gratis</h5>
                                <p class="small">Akses webinar dan tutorial digital marketing untuk UMKM.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card bento-card bg-white p-4 border shadow-sm d-flex flex-row align-items-center">
                                <div class="me-4"><i data-lucide="map-pin" size="40" class="text-danger"></i></div>
                                <div>
                                    <h5 class="mb-0">Sentra UMKM Terdekat</h5>
                                    <p class="text-muted mb-0">Temukan lokasi workshop pelaku usaha di sekitar Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Katalog Produk Unggulan</h2>
                <p class="text-muted">Produk pilihan yang telah melewati kurasi kualitas tinggi.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="product-card p-2 shadow-sm">
                        <div class="img-container">
                            <img src="https://images.unsplash.com/photo-1544203380-602956272321?auto=format&fit=crop&w=600&q=80" class="img-fluid" alt="Product">
                        </div>
                        <div class="p-3 pt-1">
                            <small class="text-primary fw-bold text-uppercase">Craft</small>
                            <h6 class="fw-bold mb-1">Tas Anyaman Bambu</h6>
                            <p class="text-muted small mb-2"><i data-lucide="map-pin" size="12"></i> Tigaraksa, Tangerang</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5">Rp 85.000</span>
                                <button class="btn btn-outline-primary btn-sm rounded-circle"><i data-lucide="plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="bg-primary p-5 rounded-5 text-white text-center shadow-lg position-relative overflow-hidden">
            <div class="position-relative z-1">
                <h2 class="fw-bold mb-3">Siap Go-Digital Bersama Kami?</h2>
                <p class="opacity-75 mb-4">Daftarkan usaha Anda sekarang dan dapatkan akses pasar yang lebih luas.</p>
                <button class="btn btn-light btn-lg rounded-pill px-5 fw-bold">Daftar Sekarang</button>
            </div>
        </div>
    </section>
@endsection