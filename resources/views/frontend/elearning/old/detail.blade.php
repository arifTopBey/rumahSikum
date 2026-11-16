@extends('frontend.main.index')

@section('content')
<div class=" py-3" style="margin-top: 70px; background-color: #a82282;">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('frontend.e-learning') }}" class="text-white text-decoration-none small">
            <i data-lucide="arrow-left" size="16" class="me-2"></i> Kembali ke Katalog
        </a>
        <div class="text-white-50 small d-none d-md-block">
            Materi: <span class="text-white">{{ $elearning->name }}</span>
        </div>
    </div>
</div>

<main class="container-fluid px-0">
    <div class="row g-0">
        <div class="col-lg-8 bg-white">

        @php
            // $url = $elearning->link_youtube;
            // preg_match('/v=([^&]+)/', $url, $match);
            // $youtubeId = $match[1] ?? null;

            $url = $elearning->link_youtube;
            $youtubeId = null;

            if (str_contains($url, 'youtube.com/watch')) {
                parse_str(parse_url($url, PHP_URL_QUERY), $query);
                $youtubeId = $query['v'] ?? null;

            } elseif (str_contains($url, 'youtu.be/')) {
                $youtubeId = basename(parse_url($url, PHP_URL_PATH));

            } elseif (str_contains($url, 'youtube.com/embed/')) {
                $youtubeId = basename(parse_url($url, PHP_URL_PATH));
            }
        @endphp
            <div class="ratio ratio-16x9 bg-black shadow-sm">
                <!-- <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video" allowfullscreen></iframe> -->
                <!-- <iframe src="{{ $elearning->link_youtube }}" title="YouTube video" allowfullscreen></iframe> -->
                 @if($youtubeId)
                    <!-- <iframe 
                        src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                        title="YouTube video" 
                        allowfullscreen>
                    </iframe> -->
                    <iframe 
                        src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                        title="YouTube video" 
                        allowfullscreen>
                    </iframe>
                @endif
            </div>

            <div class="p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
                    <div>
                        <h2 class="fw-800 text-dark mb-2">{{ $elearning->name }}</h2>
                        <div class="d-flex align-items-center gap-3 text-muted small">
                            <span><i data-lucide="play-circle" size="14" class="me-1"></i> {{ $elearning->durasi }} Menit</span>
                            <span><i data-lucide="eye" size="14" class="me-1"></i> {{ $elearning->views }} telah Ditonton</span>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                        <i data-lucide="download" size="18" class="me-2"></i> Unduh Modul PDF
                    </button>
                </div>

                <hr class="my-4 opacity-50">

                <h5 class="fw-bold mb-3">Tentang Materi Ini</h5>
                <div class="text-muted lh-lg">
                    <p>{!! $elearning->deskripsi !!}</p>
                </div>

                <div style="background-color: #a82282;" class="card border-0 rounded-4 p-4 mt-5">
                    <div class="d-flex align-items-center gap-3">
                        <!-- <img src="https://i.pravatar.cc/100?u=mentor2" class="rounded-circle" width="60" height="60"> -->
                        <img src="{{ route('showFoto.elearning.mentor.private', $elearning->photo_mentor) }}" class="rounded-circle" width="60" height="60">
                        <div>
                            <h6 class="fw-bold mb-0 text-white">{{ $elearning->nama_mentor }}</h6>
                            <p class="small text-white mb-0">{{ $elearning->bidang_menthor }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 bg-light border-start min-vh-100">
           
            <div class="p-4 sticky-top" style="top: 20px;">
                <h5 class="fw-bold mb-4">Video Lainnya</h5>

                <div class="d-flex flex-column gap-3">

                
                    @forelse ($elearningsElse as $else )
                     
                    <a href="{{ route('frontend.e-learning.detail', $else->id) }}" class="text-decoration-none text-dark">
                        <div class="d-flex gap-3">
                            <div class="position-relative">
                                <img src="{{ route('showFoto.elearning.thumnail.private', $else->thumbnail) }}"
                                    class="rounded border" width="120" height="70" style="object-fit: cover;">
                                <span class="position-absolute bottom-0 end-0 bg-dark text-white px-1 small rounded">
                                    {{ $else->durasi }} Menit
                                </span>
                            </div>

                            <div>
                                <h6 class="fw-semibold mb-1 small">{{ $else->name }}</h6>
                                <small class="text-muted d-block">{{ $else->nama_mentor }}</small>
                                @if($else->level === 'semua level')
                                        <span class="badge bg-info-subtle text-info">All Levels</span>
                                    @elseif($else->level === 'pemula')
                                        <span class="badge bg-success-subtle text-success">Pemula</span>
                                    @elseif($else->level === 'mahir')
                                        <span class="badge bg-danger-subtle text-danger">Mahir</span>
                                    @endif
                                <!-- <span class="badge bg-success-subtle text-success">Selesai</span> -->
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="d-flex gap-3">
                        <div class="position-relative">
                            <img src="{{ asset('image/icon.png') }}"
                                class="rounded" width="120" height="70" style="object-fit: cover;">
                            <span class="position-absolute bottom-0 end-0 bg-dark text-white px-1 small rounded">
                                00:00
                            </span>
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1 small">Video Lainnya Belum Tersedia</h6>
                            <small class="text-muted d-block">-</small>
                            <span class="badge bg-success-subtle text-success">-</span>
                        </div>
                    </div>
                        
                    @endforelse

                    <!-- ACTIVE -->
                    <!-- <div class="d-flex gap-3 p-2 rounded bg-primary text-white">
                        <div class="position-relative">
                            <img src="https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg"
                                class="rounded" width="120" height="70" style="object-fit: cover;">
                            <span class="position-absolute bottom-0 end-0 bg-dark text-white px-1 small rounded">
                                09:30
                            </span>
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1 small">Teknik Foto Produk Estetik dengan HP</h6>
                            <small class="d-block opacity-75">Materi 3 • Sedang dipelajari</small>
                        </div>
                    </div> -->

                    <!-- block -->
                    <!-- <div class="d-flex gap-3 opacity-50">
                        <div class="position-relative">
                            <img src="https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg"
                                class="rounded" width="120" height="70" style="object-fit: cover;">
                            <span class="position-absolute bottom-0 end-0 bg-dark text-white px-1 small rounded">
                                10:20
                            </span>
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1 small text-muted">Copywriting yang Menjual di Caption</h6>
                            <small class="text-muted d-block">Materi 4</small>
                            <span class="badge bg-light text-muted border">Terkunci</span>
                        </div>
                    </div>

                    <div class="d-flex gap-3 opacity-50">
                        <div class="position-relative">
                            <img src="https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg"
                                class="rounded" width="120" height="70" style="object-fit: cover;">
                            <span class="position-absolute bottom-0 end-0 bg-dark text-white px-1 small rounded">
                                15:00
                            </span>
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1 small text-muted">Optimasi Hashtag & Geotag</h6>
                            <small class="text-muted d-block">Materi 5</small>
                            <span class="badge bg-light text-muted border">Terkunci</span>
                        </div>
                    </div> -->

                </div>
            </div>
            <!-- <div class="p-4 sticky-top" style="top: 20px;">
                <h5 class="fw-bold mb-4">Kurikulum Kelas</h5>
                
                <div class="playlist-wrapper d-flex flex-column gap-2">
                    <div class="playlist-item completed p-3 rounded-3 d-flex align-items-center gap-3">
                        <div class="icon-status">
                            <i data-lucide="check-circle" size="20" class="text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="small mb-0 text-muted">Materi 1</p>
                            <h6 class="fw-bold mb-0 small text-dark">Pengenalan Algoritma Instagram 2026</h6>
                        </div>
                        <span class="smaller text-muted">08:12</span>
                    </div>

                    <div class="playlist-item completed p-3 rounded-3 d-flex align-items-center gap-3">
                        <div class="icon-status">
                            <i data-lucide="check-circle" size="20" class="text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="small mb-0 text-muted">Materi 2</p>
                            <h6 class="fw-bold mb-0 small text-dark">Menentukan Niche & Target Audience</h6>
                        </div>
                        <span class="smaller text-muted">12:45</span>
                    </div>

                    <div class="playlist-item active p-3 rounded-4 shadow-sm d-flex align-items-center gap-3 bg-primary text-white">
                        <div class="icon-status">
                            <i data-lucide="play" size="20"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="smaller mb-0 opacity-75">Materi 3 - Sedang Dipelajari</p>
                            <h6 class="fw-bold mb-0 small">Teknik Foto Produk Estetik dengan HP</h6>
                        </div>
                    </div>

                    <div class="playlist-item p-3 rounded-3 d-flex align-items-center gap-3 border bg-white opacity-75">
                        <div class="icon-status text-muted">
                            <i data-lucide="lock" size="18"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="small mb-0 text-muted">Materi 4</p>
                            <h6 class="fw-bold mb-0 small text-muted">Copywriting yang Menjual di Caption</h6>
                        </div>
                        <span class="smaller text-muted">10:20</span>
                    </div>

                    <div class="playlist-item p-3 rounded-3 d-flex align-items-center gap-3 border bg-white opacity-75">
                        <div class="icon-status text-muted">
                            <i data-lucide="lock" size="18"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="small mb-0 text-muted">Materi 5</p>
                            <h6 class="fw-bold mb-0 small text-muted">Optimasi Hashtag & Geotag</h6>
                        </div>
                        <span class="smaller text-muted">15:00</span>
                    </div>
                </div>

                <div class="mt-5 p-4 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-4">
                    <h6 class="fw-bold text-warning-dark mb-2"><i data-lucide="award" class="me-2"></i>Sertifikat Kelas</h6>
                    <p class="smaller text-muted mb-0">Selesaikan seluruh materi (10/10) untuk mengklaim e-sertifikat resmi.</p>
                </div>
            </div> -->
        </div>
    </div>
</main>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    
    .playlist-item {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .playlist-item:not(.active):hover {
        background-color: #fff;
        transform: translateX(5px);
    }

    .playlist-item.completed {
        background-color: #e9ecef;
    }

    .text-warning-dark {
        color: #856404;
    }

    /* Custom Scrollbar for side playlist */
    @media (min-width: 992px) {
        .col-lg-4 {
            max-height: 100vh;
            overflow-y: auto;
        }
    }
</style>


<script>
    lucide.createIcons();
</script>

@endsection