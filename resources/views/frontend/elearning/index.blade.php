@extends('frontend.main.index')

@section('content')


<style>
    :root {
        --primary-blue: #3b82f6;
        --dark-blue: #1d4ed8;
        --bg-light: #f4f7fe;
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.78rem; }

    /* Hero Banner Slider Style */
    .elearning-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
        border-radius: 28px;
        color: white;
        padding: 40px 50px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
    }

    /* Kustom Tombol Indicator Carousel */
    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        margin: 0 4px;
        transition: all 0.3s ease;
    }

    .carousel-indicators .active {
        width: 28px;
        border-radius: 10px;
        background-color: #ffffff;
    }

    /* Kustom Navigasi Panah Carousel */
    .hero-carousel-btn {
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.2);
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.8;
        transition: all 0.3s;
    }

    .hero-carousel-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        opacity: 1;
    }

    .hero-pill-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        padding: 6px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #fff;
    }

    .hero-stat-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 16px 20px;
        color: white;
        transition: all 0.3s ease;
    }

    .hero-stat-card:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    .btn-cta-hero {
        background-color: #3b82f6;
        color: white;
        font-weight: 700;
        border-radius: 50px;
        padding: 12px 28px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s;
    }

    .btn-cta-hero:hover {
        background-color: #2563eb;
        color: white;
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* Category Filter Pills */
    .nav-category-pills {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 8px;
        scrollbar-width: none;
    }
    .nav-category-pills::-webkit-scrollbar {
        display: none;
    }

    .cat-pill {
        background-color: #ffffff;
        color: #64748b;
        border-radius: 50px;
        padding: 10px 22px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        white-space: nowrap;
        transition: all 0.25s ease;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .cat-pill:hover {
        color: #2563eb;
        background-color: #eff6ff;
        border-color: #bfdbfe;
    }

    .cat-pill.active {
        background-color: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
    }

    /* Academy / E-Learning Cards */
    .academy-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        padding: 24px;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }

    .academy-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        border-color: #e2e8f0;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        font-size: 20px;
    }

    .icon-blue { background-color: #eff6ff; color: #2563eb; }
    .icon-indigo { background-color: #e0e7ff; color: #4f46e5; }
    .icon-orange { background-color: #fff7ed; color: #ea580c; }
    .icon-purple { background-color: #f3e8ff; color: #9333ea; }

    .academy-title {
        font-weight: 800;
        color: #0f172a;
        font-size: 1.05rem;
        margin-bottom: 16px;
        line-height: 1.4;
    }

    .academy-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        color: #94a3b8;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .academy-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }
</style>


<div class="container pb-5" style="margin-top: 90px;">

    <!-- HERO CAROUSEL / SLIDER BANNER -->
    <div id="elearningHeroCarousel" class="carousel slide elearning-hero mb-5" data-bs-ride="carousel" data-bs-interval="5000">
        
        <!-- CAROUSEL INDICATORS (DOTS) -->
        <div class="carousel-indicators mb-1">
            <button type="button" data-bs-target="#elearningHeroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#elearningHeroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <!-- <button type="button" data-bs-target="#elearningHeroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
        </div>

        <div class="carousel-inner">
            
            <!-- SLIDE 1: OPENCLASS UMKM AI -->
            <div class="carousel-item active">
                <div class="row align-items-center g-4 pb-4">
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="hero-pill-badge">
                                <i data-lucide="graduation-cap" size="18"></i> OpenClass UMKM
                            </span>
                            <span class="hero-pill-badge bg-warning text-dark border-0 fw-bold">
                                AI Enabled
                            </span>
                        </div>
                        <h1 class="display-6 fw-800 text-white mb-3" style="letter-spacing: -0.5px;">
                            Platform Pelatihan Online Berbasis AI untuk UMKM Indonesia
                        </h1>
                        <p class="text-white opacity-90 mb-4 fs-6" style="max-width: 580px;">
                            Tingkatkan skill, kembangkan bisnis, dan raih peluang baru bersama materi praktis terstruktur langsung dari para profesional teruji.
                        </p>

                        <div class="row g-3 mb-4 d-none d-md-flex">
                            <div class="col-4">
                                <div class="hero-stat-card d-flex align-items-center gap-3">
                                    <i data-lucide="play-circle" size="28" class="text-warning"></i>
                                    <div>
                                        <h6 class="fw-800 m-0 fs-6">1000+</h6>
                                        <span class="smaller text-white-50">Kelas Online</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="hero-stat-card d-flex align-items-center gap-3">
                                    <i data-lucide="users" size="28" class="text-info"></i>
                                    <div>
                                        <h6 class="fw-800 m-0 fs-6">50K+</h6>
                                        <span class="smaller text-white-50">Pelaku UMKM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="hero-stat-card d-flex align-items-center gap-3">
                                    <i data-lucide="award" size="28" class="text-success"></i>
                                    <div>
                                        <h6 class="fw-800 m-0 fs-6">Sertifikat</h6>
                                        <span class="smaller text-white-50">Terakreditasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#katalog-materi" class="btn btn-cta-hero d-inline-flex align-items-center gap-2">
                            Mulai Belajar Gratis Sekarang! <i data-lucide="arrow-right" size="18"></i>
                        </a>
                    </div>

                    <div class="col-lg-5 text-center d-none d-lg-block">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800&auto=format&fit=crop" 
                             class="img-fluid rounded-4 shadow-lg border border-white border-opacity-25" 
                             alt="E-learning UMKM" 
                             style="max-height: 320px; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- SLIDE 2: PROGRAM EXPORT ACADEMY -->
            <div class="carousel-item">
                <div class="row align-items-center g-4 pb-4">
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="hero-pill-badge">
                                <i data-lucide="globe" size="18"></i> Program Unggulan
                            </span>
                            <span class="hero-pill-badge bg-info text-white border-0 fw-bold">
                                Go Global
                            </span>
                        </div>
                        <h1 class="display-6 fw-800 text-white mb-3" style="letter-spacing: -0.5px;">
                            Bawa Produk Lokal Tembus Pasar Internasional
                        </h1>
                        <p class="text-white opacity-90 mb-4 fs-6" style="max-width: 580px;">
                            Pelajari regulasi ekspor, standar kualitas produk internasional, hingga strategi negosiasi dengan pembeli luar negeri secara praktis.
                        </p>

                        <div class="row g-3 mb-4 d-none d-md-flex">
                            <div class="col-4">
                                <div class="hero-stat-card d-flex align-items-center gap-3">
                                    <i data-lucide="ship" size="28" class="text-warning"></i>
                                    <div>
                                        <h6 class="fw-800 m-0 fs-6">12+</h6>
                                        <span class="smaller text-white-50">Modul Ekspor</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="hero-stat-card d-flex align-items-center gap-3">
                                    <i data-lucide="building" size="28" class="text-info"></i>
                                    <div>
                                        <h6 class="fw-800 m-0 fs-6">Mentoring</h6>
                                        <span class="smaller text-white-50">Praktisi Langsung</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#katalog-materi" class="btn btn-cta-hero d-inline-flex align-items-center gap-2">
                            Lihat Kelas Ekspor <i data-lucide="arrow-right" size="18"></i>
                        </a>
                    </div>

                    <div class="col-lg-5 text-center d-none d-lg-block">
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=800&auto=format&fit=crop" 
                             class="img-fluid rounded-4 shadow-lg border border-white border-opacity-25" 
                             alt="Export Academy" 
                             style="max-height: 320px; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- SLIDE 3: AI ASSISTANT UNTUK UMKM -->
            <!-- <div class="carousel-item">
                <div class="row align-items-center g-4 pb-4">
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="hero-pill-badge">
                                <i data-lucide="cpu" size="18"></i> Fitur Terbaru
                            </span>
                            <span class="hero-pill-badge bg-success text-white border-0 fw-bold">
                                AI Assistant 24/7
                            </span>
                        </div>
                        <h1 class="display-6 fw-800 text-white mb-3" style="letter-spacing: -0.5px;">
                            Teman Belajar Smart AI Siap Membantu Bisnismu
                        </h1>
                        <p class="text-white opacity-90 mb-4 fs-6" style="max-width: 580px;">
                            Dapatkan rekomendasi materi belajar instan, buat ide promosi, hingga konsultasi keuangan bisnis kapan saja dari mana saja.
                        </p>

                        <a href="#katalog-materi" class="btn btn-cta-hero d-inline-flex align-items-center gap-2">
                            Coba Asisten AI <i data-lucide="sparkles" size="18"></i>
                        </a>
                    </div>

                    <div class="col-lg-5 text-center d-none d-lg-block">
                        <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=800&auto=format&fit=crop" 
                             class="img-fluid rounded-4 shadow-lg border border-white border-opacity-25" 
                             alt="AI Assistant UMKM" 
                             style="max-height: 320px; object-fit: cover;">
                    </div>
                </div>
            </div> -->

        </div>

        <!-- NAVIGASI PANAH (KIRI & KANAN) -->
        <button class="carousel-control-prev hero-carousel-btn ms-3" type="button" data-bs-target="#elearningHeroCarousel" data-bs-slide="prev">
            <i data-lucide="chevron-left" size="24" class="text-white"></i>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next hero-carousel-btn me-3" type="button" data-bs-target="#elearningHeroCarousel" data-bs-slide="next">
            <i data-lucide="chevron-right" size="24" class="text-white"></i>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- FILTER KATEGORI PILLS -->
    <div class="mb-4">
        <div class="nav-category-pills">
            <a href="{{ route('frontend.e-learning') }}" class="cat-pill {{ !request('kategori') ? 'active' : '' }}">
                <i data-lucide="layout-grid" size="18"></i> Semua
            </a>
            <a href="{{ route('frontend.e-learning', ['kategori' => 'Entrepreneur']) }}" class="cat-pill {{ request('kategori') == 'Entrepreneur' ? 'active' : '' }}">
                <i data-lucide="rocket" size="18"></i> Entrepreneur
            </a>
            <a href="{{ route('frontend.e-learning', ['kategori' => 'Finance']) }}" class="cat-pill {{ request('kategori') == 'Finance' ? 'active' : '' }}">
                <i data-lucide="trending-up" size="18"></i> Finance
            </a>
            <a href="{{ route('frontend.e-learning', ['kategori' => 'Marketing']) }}" class="cat-pill {{ request('kategori') == 'Marketing' ? 'active' : '' }}">
                <i data-lucide="megaphone" size="18"></i> Marketing
            </a>
            <a href="{{ route('frontend.e-learning', ['kategori' => 'AI']) }}" class="cat-pill {{ request('kategori') == 'AI' ? 'active' : '' }}">
                <i data-lucide="cpu" size="18"></i> AI & Teknologi
            </a>
            <a href="{{ route('frontend.e-learning', ['kategori' => 'Lainnya']) }}" class="cat-pill {{ request('kategori') == 'Lainnya' ? 'active' : '' }}">
                <i data-lucide="graduation-cap" size="18"></i> Lainnya
            </a>
        </div>
    </div>

    <!-- HEADER SECTION KATALOG -->
    <div id="katalog-materi" class="d-flex justify-content-between align-items-center mb-4 pt-2">
        <h4 class="fw-800 text-dark mb-0">Jelajahi Academy</h4>
        <span class="text-muted small fw-bold">Menampilkan {{ count($elearnings) }} Materi</span>
    </div>

    <!-- GRID KATALOG KELAS/MATERI -->
    <div class="row g-4">
        @forelse ($elearnings as $index => $elearning)
            @php
                $colors = ['icon-blue', 'icon-indigo', 'icon-orange', 'icon-purple'];
                $colorClass = $colors[$index % 4];
                $icons = ['graduation-cap', 'rocket', 'trending-up', 'users', 'cpu', 'megaphone', 'shopping-bag'];
                $iconName = $icons[$index % count($icons)];
            @endphp
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('frontend.e-learning.detail', $elearning->id) }}" class="text-decoration-none">
                    <div class="academy-card">
                        <div>
                            <div class="icon-box {{ $colorClass }}">
                                <i data-lucide="{{ $iconName }}" size="24"></i>
                            </div>
                            <h6 class="academy-title">
                                {{ $elearning->name ?? $elearning->nama_materi }}
                            </h6>
                        </div>

                        <div class="academy-meta">
                            <div class="academy-meta-item">
                                <i data-lucide="book-open" size="15"></i>
                                <span>10 Modul</span>
                            </div>
                            <div class="academy-meta-item">
                                <i data-lucide="users" size="15"></i>
                                <span>{{ $elearning->views ?? 0 }} Peserta</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded-4 border">
                    <i data-lucide="book-x" size="48" class="text-muted mb-3 opacity-50"></i>
                    <h5 class="fw-bold text-dark mb-1">Materi Tidak Ditemukan</h5>
                    <p class="text-muted small mb-0">Belum ada kelas atau materi e-learning yang tersedia untuk kategori ini.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endpush
@endsection