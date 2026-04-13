@extends('frontend.main.index')

@section('content')
<div class="container py-5 mt-4">
    <div class="row g-5">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="" class="text-decoration-none">Pelatihan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Kelas</li>
                </ol>
            </nav>
            <h1 class="fw-800 text-dark mb-4">Latihan Test</h1>

            <div class="rounded-4 overflow-hidden mb-5 shadow-sm">
                <img src="{{asset('image/avatar4.png')}}" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;" >
            </div>


            <div class="training-content text-muted lh-lg mb-5">
                <p>Pelatihan ini dirancang khusus untuk membantu pelaku UMKM memahami dasar-dasar digital marketing dan cara efektif menggunakan Facebook Ads untuk meningkatkan penjualan online. Dalam pelatihan ini, peserta akan mempelajari strategi pemasaran digital yang terbukti berhasil, mulai dari pembuatan konten yang menarik hingga pengelolaan kampanye iklan yang efektif di platform Facebook.</p>
                <p>Peserta akan mendapatkan pemahaman mendalam tentang cara menargetkan audiens yang tepat, mengoptimalkan anggaran iklan, dan menganalisis hasil kampanye untuk terus meningkatkan performa pemasaran digital mereka. Dengan bimbingan dari mentor berpengalaman, pelatihan ini bertujuan untuk memberdayakan UMKM agar dapat bersaing di era digital dengan strategi pemasaran yang inovatif dan efektif.</p>
            </div>

            <div class="card border-0 bg-light rounded-4 p-4 mb-5">
                <div class="d-flex align-items-center gap-4">
                    <img src="{{asset('image/avatar4.png')}}" class="rounded-circle shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                    <div>
                        <h5 class="fw-800 mb-1">Andi Pratama, MBA</h5>
                        <p class="text-primary fw-bold small mb-2">Digital Marketing Specialist</p>
                        <p class="text-muted small mb-0">Berpengalaman lebih dari 10 tahun dalam membantu digitalisasi UMKM di berbagai daerah.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden sticky-top" style="top: 100px; z-index: 10;">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <span class="text-muted smaller d-block mb-1">Investasi Pelatihan</span>
                        <h3 class="fw-800 text-primary mb-0">Gratis <small class="text-muted fw-normal fs-6 text-decoration-line-through">Rp 250.000</small></h3>
                    </div>

                    <div class="divider my-4"></div>

                    <h6 class="fw-800 mb-3">Detail Kelas:</h6>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                            <i data-lucide="bar-chart" size="20"></i>
                        </div>
                        <div>
                            <p class="smaller text-muted mb-0">Tingkat</p>
                            <p class="fw-bold mb-0 small">Pemula</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                            <i data-lucide="calendar" size="20"></i>
                        </div>
                        <div>
                            <p class="smaller text-muted mb-0">Tanggal Mulai</p>
                            <p class="fw-bold mb-0 small">10 April 2023</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                            <i data-lucide="map-pin" size="20"></i>
                        </div>
                        <div>
                            <p class="smaller text-muted mb-0">Lokasi / Platform</p>
                            <p class="fw-bold mb-0 small">Aula</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                            <i data-lucide="award" size="20"></i>
                        </div>
                        <div>
                            <p class="smaller text-muted mb-0">Sertifikat</p>
                            <p class="fw-bold mb-0 small">E-Sertifikat Tersedia</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="smaller fw-bold">Kuota Terisi</span>
                            <span class="smaller fw-bold text-danger">Sisa 8 Slot!</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 8px;">
                            <div class="progress-bar bg-danger" style="width: 85%"></div>
                        </div>
                    </div>

                    <a href="" class="btn btn-primary w-100 rounded-pill py-3 fw-800 shadow-sm mb-3">
                        Daftar Sekarang
                    </a>
                    <p class="smaller text-muted text-center mb-0">
                        <i data-lucide="shield-check" size="14" class="me-1"></i> Pendaftaran Aman & Cepat
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.8rem; }
    .bg-primary-soft { background: #eef2ff; }
    .training-content p { margin-bottom: 1.5rem; }
    .sticky-top { transition: all 0.3s ease; }
    
    /* Styling untuk Rich Text Content */
    .training-content ul { padding-left: 1.2rem; }
    .training-content li { margin-bottom: 0.5rem; }
    
    .divider { height: 1px; background: #eee; width: 100%; }
</style>


<script>
    lucide.createIcons();
</script>

@endsection