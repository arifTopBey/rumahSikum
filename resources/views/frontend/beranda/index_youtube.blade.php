@extends('frontend.main.index')

@section('content')
    @php
        // Ambil data video pertama yang tersedia dari database
        $currentVideo = $videoProfil ?? null;
        $embedUrl = "https://www.youtube.com/embed/dQw4w9WgXcQ?enablejsapi=1"; 

        if ($currentVideo) {
            $url = $currentVideo->video_youtube;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match)) {
                $embedUrl = "https://www.youtube.com/embed/" . $match[1] . "?enablejsapi=1";
            }
        }
    @endphp

    <section class="hero-gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">🚀 Era Digital UMKM Tangerang</span>
                    <h1 class="hero-title mb-4">Berdayakan <span style="color: #a82282;">Ekonomi Lokal</span> Dalam Satu Genggaman.</h1>
                    <p class="lead text-muted mb-5">Platform terintegrasi untuk pendataan, pemasaran dynamic produk unggulan, dan penguatan koperasi di Kabupaten Tangerang.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('frontend.eCommerce') }}" style="background-color: #a82282;" class="btn text-white btn-lg rounded-pill px-5">Jelajahi Produk</a>
                        
                        <!-- Tombol Video Profil hanya muncul jika ada data video di database -->
                        @if($currentVideo)
                        <button class="btn btn-outline-dark btn-lg rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#videoProfilModal">
                            <i data-lucide="play-circle" class="me-2"></i>Video Profil
                        </button>
                        @endif
                    </div>

                    <div class="row mt-5">
                        <div class="col-4 stat-box">
                            <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalUMKM, 0, ',', '.') }}</h3>
                            <small class="text-muted">UMKM Terdaftar</small>
                        </div>
                        <div class="col-4 stat-box border-warning">
                            <h3 class="fw-bold mb-0 text-dark">{{ number_format($jumlahKecamatan, 0, ',', '.') }}</h3>
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

    <section class="container py-5">
        <div style="background-color: #a82282;" class="p-5 rounded-5 text-white text-center shadow-lg position-relative overflow-hidden">
            <div class="position-relative z-1">
                <h2 class="fw-bold mb-3">Siap Go-Digital Bersama Kami?</h2>
                <p class="opacity-75 mb-4">Daftarkan usaha Anda sekarang dan dapatkan akses pasar yang lebih luas.</p>
                <button class="btn btn-light btn-lg rounded-pill px-5 fw-bold">Daftar Sekarang</button>
            </div>
        </div>
    </section>

    <!-- MODAL VIDEO PROFIL -->
    @if($currentVideo)
        <div class="modal fade" id="videoProfilModal" tabindex="-1" aria-labelledby="videoProfilModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark border-0 text-white">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title" id="videoProfilModalLabel">Video Profil UMKM</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-shadow="none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="ratio ratio-16x9">
                            <!-- Src menggunakan $embedUrl hasil konversi otomatis -->
                            <iframe id="videoIframe" src="{{ $embedUrl }}" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var videoModal = document.getElementById('videoProfilModal');
            var videoIframe = document.getElementById('videoIframe');
            
            if (videoModal && videoIframe) {
                // Simpan URL asli yang dinamis dari PHP
                var videoSrc = videoIframe.getAttribute('src');

                // Saat modal ditutup, kosongkan src agar video YouTube berhenti berputar di latar belakang
                videoModal.addEventListener('hide.bs.modal', function () {
                    videoIframe.setAttribute('src', '');
                });

                // Saat modal dibuka kembali, pasang lagi src video aslinya agar dapat diputar ulang
                videoModal.addEventListener('show.bs.modal', function () {
                    videoIframe.setAttribute('src', videoSrc);
                });
            }
        });
    </script>
@endsection