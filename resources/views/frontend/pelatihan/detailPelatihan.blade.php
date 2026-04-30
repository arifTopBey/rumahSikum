@extends('frontend.main.index')

@section('content')
<div class="container py-5 mt-4">
    <div class="row g-5">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="" class="text-decoration-none">Pelatihan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pelatihan</li>
                </ol>
            </nav>
            <h1 class="fw-800 text-dark mb-4">{{ $pelatihan->judul }}</h1>

            <div class="rounded-4 overflow-hidden mb-5 shadow-sm">
                <img src="{{route('showFoto.pelatihan.private', $pelatihan->gambar)}}" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;" >
                <!-- <img src="{{asset('image/avatar4.png')}}" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;" > -->
            </div>


            <div class="training-content text-muted lh-lg mb-5">
                {!! $pelatihan->deskripsi !!}
            </div>

            <div class="card border-0  rounded-4 p-4 mb-5" style="background-color: #a82282; color: white;">
                <div class="d-flex align-items-center gap-4" >
                    <!-- <img src="{{asset('image/avatar4.png')}}" class="rounded-circle shadow-sm" style="width: 100px; height: 100px; object-fit: cover;"> -->
                    <div>
                        <h5 class="fw-800 mb-1">Kategori Pelatihan</h5>
                        <p class="text-white fw-bold small mb-2">{{ $pelatihan->kategoriPelatihan->name }}</p>
                        <!-- <p class="text-muted small mb-0">Berpengalaman lebih dari 10 tahun dalam membantu digitalisasi UMKM di berbagai daerah.</p> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden sticky-top" style="top: 100px; z-index: 10;">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <span class="text-muted smaller d-block mb-1">Investasi Pelatihan</span>
                        <h3 style="color:#a82282;" class="fw-800 mb-0">Gratis</h3>
                    </div>

                    <div class="divider my-4"></div>

                    <h6 class="fw-800 mb-3">Detail Pelatihan:</h6>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                            <i data-lucide="map-pin" size="20"></i>
                        </div>
                        <div>
                            <p class="smaller text-muted mb-0">Lokasi</p>
                            <p class="fw-bold mb-0 small">{{ $pelatihan->lokasi }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                            <i data-lucide="calendar" size="20"></i>
                        </div>
                        <div>
                            <p class="smaller text-muted mb-0">Tanggal Mulai</p>
                            <p class="fw-bold mb-0 small">{{ \Carbon\Carbon::parse($pelatihan->tanggal_acara)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                            <i data-lucide="map-pin" size="20"></i>
                        </div>
                        <div>
                            <p class="smaller text-muted mb-0">Waktu Pelatihan Acara</p>
                            <p class="fw-bold mb-0 small">
                                {{ \Carbon\Carbon::parse($pelatihan->waktu_acara_mulai)->format('H:i') }} 
                                    - 
                                {{ \Carbon\Carbon::parse($pelatihan->waktu_acara_selesai)->format('H:i') }}
                            </p>
                        </div>
                    </div>


                    <!-- <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="smaller fw-bold">Kuota Terisi</span>
                            <span class="smaller fw-bold text-danger">Sisa 8 Slot!</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 8px;">
                            <div class="progress-bar bg-danger" style="width: 85%"></div>
                        </div>
                    </div> -->

                    <a href="{{ route('frontend.pelatihan') }}" class="btn btn-light w-100 rounded-pill py-3 fw-800 shadow-sm mb-3">
                        Kembali
                    </a>
                    <p class="smaller text-muted text-center mb-0">
                        <!-- <i data-lucide="shield-check" size="14" class="me-1"></i> Pendaftaran Aman & Cepat -->
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