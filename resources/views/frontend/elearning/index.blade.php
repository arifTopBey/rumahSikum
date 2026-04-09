@extends('frontend.main.index')

@section('content')
    <header class="learning-header">
        <div class="container text-center">
            <h1 class="display-4 fw-800 mb-3">Akademi Digital UMKM</h1>
            <p class="lead opacity-90">Tingkatkan skill bisnismu dengan mentor berpengalaman secara gratis.</p>
        </div>
    </header>

    <div class="container search-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group mb-4">
                    <span class="input-group-text bg-white border-0 ps-4 rounded-start-pill"><i
                            data-lucide="search"></i></span>
                    <input type="text" class="form-control search-input rounded-end-pill"
                        placeholder="Cari materi: Digital Marketing, Akuntansi, Sertifikasi Halal...">
                </div>

                <div class="d-flex gap-2 overflow-x-auto pb-3 no-scrollbar justify-content-center">
                    <span class="category-pill active">Semua Materi</span>
                    <span class="category-pill">Pemasaran</span>
                    <span class="category-pill">Legalitas</span>
                    <span class="category-pill">Keuangan</span>
                    <span class="category-pill">Produksi</span>
                    <span class="category-pill">Packaging</span>
                </div>
            </div>
        </div>
    </div>

    <main class="container py-5">

        <div class="mb-5">
            <h4 class="fw-bold mb-4">Lanjutkan Belajar</h4>
            <div style="background-color: #7728a8;" class="card border-0 shadow-sm p-4 rounded-4  text-white position-relative overflow-hidden">
                <div class="row align-items-center position-relative z-1">
                    <div class="col-md-8">
                        <h5 class="fw-bold">Strategi Branding Produk di Instagram</h5>
                        <p class="small opacity-75">Modul 3 dari 10: Membuat Foto Produk Estetik</p>
                        <div class="progress mb-3 bg-white bg-opacity-25">
                            <div class="progress-bar bg-warning" style="width: 30%"></div>
                        </div>
                        <button class="btn btn-light rounded-pill px-4 fw-bold">Lanjutkan Kelas</button>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <i data-lucide="award" size="80" class="opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0">Kelas Terbaru</h4>
                <a href="#" class="text-decoration-none">Lihat Semua <i data-lucide="chevron-right"></i></a>
            </div>

            <!-- <div class="col-md-4">
                <div class="card course-card shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=600&q=80"
                        class="card-img-top course-img" alt="Course">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-success-subtle text-success">Beginner</span>
                            <div class="d-flex align-items-center small text-muted">
                                <i data-lucide="clock" size="14" class="me-1"></i> 2j 30m
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Panduan Lengkap Mengurus NIB & Sertifikat Halal</h5>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <img src="https://i.pravatar.cc/150?u=mentor1" class="instructor-img" alt="Mentor">
                            <div>
                                <p class="small mb-0 fw-bold">Andini Putri</p>
                                <p class="small text-muted mb-0">Konsultan Legalitas</p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-800 text-primary">GRATIS</span>
                            <div class="d-flex align-items-center small text-muted">
                                <i data-lucide="users" size="14" class="me-1"></i> 1.2k Siswa
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-4">
                <div class="card course-card shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80"
                        class="card-img-top course-img" alt="Course">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-warning-subtle text-warning">Intermediate</span>
                            <div class="d-flex align-items-center small text-muted">
                                <i data-lucide="video" size="14" class="me-1"></i> 12 Materi
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Teknik Facebook & Instagram Ads untuk Pemula</h5>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <img src="https://i.pravatar.cc/150?u=mentor2" class="instructor-img" alt="Mentor">
                            <div>
                                <p class="small mb-0 fw-bold">Rico Wijaya</p>
                                <p class="small text-muted mb-0">Digital Strategist</p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-800 text-primary">GRATIS</span>
                            <div class="d-flex align-items-center small text-muted">
                                <i data-lucide="users" size="14" class="me-1"></i> 850 Siswa
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-md-4">
                <div class="card course-card shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=600&q=80"
                        class="card-img-top course-img" alt="Course">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-info-subtle text-info">All Levels</span>
                            <div class="d-flex align-items-center small text-muted">
                                <i data-lucide="book-open" size="14" class="me-1"></i> E-Book
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Manajemen Kas Sederhana bagi Pelaku Usaha Mikro</h5>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <img src="https://i.pravatar.cc/150?u=mentor3" class="instructor-img" alt="Mentor">
                            <div>
                                <p class="small mb-0 fw-bold">Siti Aminah</p>
                                <p class="small text-muted mb-0">Ahli Keuangan</p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-800 text-primary">GRATIS</span>
                            <div class="d-flex align-items-center small text-muted">
                                <i data-lucide="users" size="14" class="me-1"></i> 2.4k Siswa
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="py-5 mt-5">
            <div class="text-center mb-5">
                <h3 class="fw-bold">Belajar Langsung dari Pakarnya</h3>
                <p class="text-muted">Mentor kami adalah praktisi yang sukses di bidangnya.</p>
            </div>
            <div class="row justify-content-center g-4 text-center">
                <div class="col-6 col-md-2">
                    <img src="https://i.pravatar.cc/150?u=a"
                        class="img-fluid rounded-circle mb-3 shadow-sm border border-3 border-white" alt="Mentor">
                    <h6 class="fw-bold mb-0">Budi Santoso</h6>
                    <small class="text-muted">CEO LocalBrand</small>
                </div>
                <div class="col-6 col-md-2">
                    <img src="https://i.pravatar.cc/150?u=b"
                        class="img-fluid rounded-circle mb-3 shadow-sm border border-3 border-white" alt="Mentor">
                    <h6 class="fw-bold mb-0">Riana Sari</h6>
                    <small class="text-muted">Expert Marketer</small>
                </div>
            </div>
        </div> -->

    </main>
@endsection