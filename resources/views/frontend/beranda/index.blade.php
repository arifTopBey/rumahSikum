@extends('frontend.main.index')

@if ($popup && $popup->status === 1)
    <div id="welcomePopup" class="popup-overlay">
        <div class="popup-content">
            <button class="popup-close" onclick="closePopup()">✕</button>
            <img src="{{ route('show.thumbnail.produk.private', $popup->banner_image) }}" alt="Promo" class="img-fluid">
        </div>
    </div>
@endif

@section('content')


    @php
        // Ambil data video pertama yang tersedia dari database
        $currentVideo = $videoProfil ?? null;
        $embedUrl = null;
        $localUrl = null;
        $activeType = $currentVideo ? $currentVideo->status : null;

        if ($currentVideo) {
            if ($activeType == '1' && $currentVideo->video_youtube) {
                // Konversi URL YouTube biasa ke format EMBED
                $url = $currentVideo->video_youtube;
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match)) {
                    $embedUrl = "https://www.youtube.com/embed/" . $match[1] . "?enablejsapi=1";
                }
            } elseif ($activeType == '0' && $currentVideo->video_local) {
                // Arahkan ke path storage lokal
                $localUrl = asset('storage/' . $currentVideo->video_local);
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
                        
                        @if(($activeType == '1' && $embedUrl) || ($activeType == '0' && $localUrl))
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

    @if(($activeType == 1 && $embedUrl) || ($activeType == 0 && $localUrl))
        <div class="modal fade" id="videoProfilModal" tabindex="-1" aria-labelledby="videoProfilModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark border-0 text-white">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title" id="videoProfilModalLabel">Video Profil UMKM</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-shadow="none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="ratio ratio-16x9">
                            @if($activeType == 1)
                                <iframe id="videoIframe" src="{{ $embedUrl }}" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            @else
                                <video id="videoLocal" controls class="w-100 h-100 rounded-2">
                                    <source src="{{ $localUrl }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutaran video.
                                </video>
                            @endif
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
            var videoLocal = document.getElementById('videoLocal');
            
            if (videoModal) {
                var videoSrc = videoIframe ? videoIframe.getAttribute('src') : '';

                // Logika saat modal di-close / ditutup
                videoModal.addEventListener('hide.bs.modal', function () {
                    if (videoIframe) {
                        videoIframe.setAttribute('src', ''); // Hentikan Youtube
                    }
                    if (videoLocal) {
                        videoLocal.pause(); // Jeda video lokal agar suaranya mati
                        videoLocal.currentTime = 0; // Kembalikan ke detik awal
                    }
                });

                // Logika saat modal di-buka kembali
                videoModal.addEventListener('show.bs.modal', function () {
                    if (videoIframe) {
                        videoIframe.setAttribute('src', videoSrc);
                    }
                });
            }
        });
    </script>
@endsection

 <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            position: relative;
            max-width: 600px;
            background: white;
            padding: 10px;
            border-radius: 10px;
        }

        .popup-content img {
            width: 100%;
            border-radius: 10px;
        }

        .popup-close {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>