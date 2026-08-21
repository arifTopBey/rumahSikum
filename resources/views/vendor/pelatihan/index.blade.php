@extends('admin.main.main')

@section('content')
    <div class="bg-light min-vh-100 py-4">
        <div class="container px-3 px-md-4">

            {{-- Header Section --}}
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold text-dark mb-1">E-Learning Saya</h3>
                    <p class="text-muted small mb-0">Pantau progres pembelajaran dan akses materi pelatihan yang pernah Kamu
                        ikuti.</p>
                </div>
                <a href="{{ route('frontend.e-learning') }}"
                    class="btn btn-danger d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-semibold border-0 shadow-sm"
                    style="background-color: #e11d48;">
                    <i data-lucide="compass" size="18"></i> Jelajahi Kursus Lain
                </a>
            </div>

            {{-- Top Summary Stats Row --}}
            {{-- Top Summary Stats Row --}}

            @php
                // Total kursus/event yang diikuti
                $totalKursus = $elearning->count();

                // Kursus yang sedang dipelajari
                $sedangDipValidasi = $elearning->where('progress_status', 'berjalan')->count();

                // Kursus yang sudah selesai
                $kursusSelesai = $elearning->where('progress_status', 'selesai')->count();
            @endphp

            <div class="row g-3 mb-4">

                {{-- Total Kursus --}}
                <div class="col-12 col-sm-6 col-lg-4">

                    <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">

                        <div class="rounded-3 p-3 d-flex align-items-center justify-content-center text-primary"
                            style="background-color: #eff6ff;">

                            <i data-lucide="book-open" size="24"></i>

                        </div>

                        <div>

                            <h4 class="fw-bold text-dark mb-0">
                                {{ $totalKursus }}
                            </h4>

                            <span class="text-muted smaller">
                                Total Kursus Diikuti
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Sedang Dipelajari --}}
                <div class="col-12 col-sm-6 col-lg-4">

                    <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">

                        <div class="rounded-3 p-3 d-flex align-items-center justify-content-center"
                            style="background-color: #fef3c7; color: #d97706;">

                            <i data-lucide="play-circle" size="24"></i>

                        </div>

                        <div>

                            <h4 class="fw-bold text-dark mb-0">
                                {{ $sedangDipValidasi }}
                            </h4>

                            <span class="text-muted smaller">
                                Sedang Dipelajari
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Kursus Selesai --}}
                <div class="col-12 col-sm-6 col-lg-4">

                    <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">

                        <div class="rounded-3 p-3 d-flex align-items-center justify-content-center text-success"
                            style="background-color: #d1fae5;">

                            <i data-lucide="award" size="24"></i>

                        </div>

                        <div>

                            <h4 class="fw-bold text-dark mb-0">
                                {{ $kursusSelesai }}
                            </h4>

                            <span class="text-muted smaller">
                                Kursus Selesai
                            </span>

                        </div>

                    </div>

                </div>

            </div>
            <!-- <div class="row g-3 mb-4">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                            <div class="rounded-3 p-3 d-flex align-items-center justify-content-center text-primary"
                                style="background-color: #eff6ff;">
                                <i data-lucide="book-open" size="24"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold text-dark mb-0">2</h4>
                                <span class="text-muted smaller">Total Kursus Diikuti</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                            <div class="rounded-3 p-3 d-flex align-items-center justify-content-center"
                                style="background-color: #fef3c7; color: #d97706;">
                                <i data-lucide="play-circle" size="24"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold text-dark mb-0">1</h4>
                                <span class="text-muted smaller">Sedang Dipelajari</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                            <div class="rounded-3 p-3 d-flex align-items-center justify-content-center text-success"
                                style="background-color: #d1fae5;">
                                <i data-lucide="award" size="24"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold text-dark mb-0">1</h4>
                                <span class="text-muted smaller">Kursus Selesai</span>
                            </div>
                        </div>
                    </div>
                </div> -->

            {{-- Filter Tabs & Search --}}
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-3 mb-4">
                {{-- Nav Pills --}}
                <ul class="nav nav-pills custom-pills gap-2 bg-white p-1.5 rounded-3 shadow-sm border">
                    <li class="nav-item">
                        <button class="nav-link active px-3 py-1.5 rounded-2 fw-semibold smaller" data-bs-toggle="pill"
                            data-bs-target="#semua">Semua (2)</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link px-3 py-1.5 rounded-2 fw-semibold smaller" data-bs-toggle="pill"
                            data-bs-target="#berjalan">Sedang Berjalan (1)</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link px-3 py-1.5 rounded-2 fw-semibold smaller" data-bs-toggle="pill"
                            data-bs-target="#selesai">Selesai (1)</button>
                    </li>
                </ul>

                {{-- Search Bar --}}
                <div class="input-group style-search" style="max-width: 300px;">
                    <span class="input-group-text bg-white border-end-0 rounded-start-3 text-muted ps-3">
                        <i data-lucide="search" size="16"></i>
                    </span>
                    <input type="text" class="form-control bg-white border-start-0 rounded-end-3 py-2 smaller"
                        placeholder="Cari e-learning...">
                </div>
            </div>

            {{-- Tab Content / Course Cards Grid --}}
            <div class="tab-content">
                <div class="tab-pane fade show active" id="semua">
                    <div class="row g-4">

                        @forelse ($elearning as $e)
                            {{-- Course Card 1 (Berjalan) --}}
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 rounded-4 shadow-sm bg-white h-100 overflow-hidden hover-card">
                                    {{-- Card Image Banner --}}
                                    <div class="position-relative">
                                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&auto=format&fit=crop&q=80"
                                            class="card-img-top style-banner" alt="Course Thumbnail">
                                        <span
                                            class="badge position-absolute top-0 end-0 m-3 rounded-pill px-2.5 py-1.5 smaller fw-semibold bg-white text-primary shadow-sm">
                                            <i data-lucide="monitor" size="12" class="me-1"></i> {{ $e->jenis_pelatihan }}
                                        </span>
                                    </div>

                                    {{-- Card Body --}}
                                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <!-- <span class="badge rounded-pill px-2.5 py-1 smaller fw-semibold" style="background-color: #fef3c7; color: #d97706;">Dalam Proses</span> -->
                                                @if ($e->progress_status === 'selesai')

                                                    <span class="badge rounded-pill px-2.5 py-1 smaller fw-semibold"
                                                        style="background-color: #d1fae5; color: #059669;">
                                                        Selesai
                                                    </span>

                                                @elseif ($e->progress_status === 'berjalan')

                                                    <span class="badge rounded-pill px-2.5 py-1 smaller fw-semibold"
                                                        style="background-color: #fef3c7; color: #d97706;">
                                                        Dalam Proses
                                                    </span>

                                                @else

                                                    <span class="badge rounded-pill px-2.5 py-1 smaller fw-semibold"
                                                        style="background-color: #eff6ff; color: #2563eb;">
                                                        Belum Mulai
                                                    </span>

                                                @endif
                                                <!-- <span class="text-muted smaller">• Terdaftar 17 Jun 2026</span> -->

                                            </div>
                                            <h5 class="fw-bold text-dark mb-2">{{ $e->judul_event }}</h5>
                                            <p class="text-muted smaller mb-3 line-clamp-2">{!! $e->deskripsi_event !!}</p>
                                        </div>

                                        <div>
                                            {{-- Progress Bar --}}
                                            <div class="mb-3">

                                                <div class="d-flex justify-content-between align-items-center mb-1">

                                                    <span class="text-muted smaller fw-medium">
                                                        Progres Belajar
                                                    </span>

                                                    <span
                                                        class="fw-bold{{ $e->progress_status === 'selesai' ? 'text-success' : 'text-primary' }} smaller">

                                                        {{ $e->progress_percentage }}%

                                                    </span>

                                                </div>

                                                <div class="progress rounded-pill" style="height: 6px;">

                                                    <div class="progress-bar rounded-pill {{ $e->progress_status === 'selesai' ? 'bg-success' : 'bg-primary' }}"
                                                        role="progressbar" style="width: {{ $e->progress_percentage }}%;"
                                                        aria-valuenow="{{ $e->progress_percentage }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>

                                                </div>

                                            </div>

                                            {{-- Info Meta --}}
                                            <div
                                                class="d-flex align-items-center justify-content-between pt-2 border-top text-muted smaller mb-3">
                                                <div class="d-flex align-items-center gap-1">

                                                    <i data-lucide="file-text" size="14"></i>

                                                    {{ $e->materi_selesai }}/{{ $e->total_materi }} Materi

                                                </div>
                                                <div class="d-flex align-items-center gap-1">
                                                    <i data-lucide="user" size="14"></i> Admin Event
                                                </div>
                                            </div>

                                            {{-- Action Button --}}
                                            <!-- <a href="#"
                                                                class="btn btn-primary w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm border-0"
                                                                style="background-color: #2563eb;">
                                                                Lanjutkan Belajar <i data-lucide="arrow-right" size="16"></i>
                                                            </a> -->
                                            <a href="{{ route('frontend.e-learning.detail', $e->id) }}"
                                                class="btn btn-primary w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm border-0"
                                                style="background-color: #2563eb;">

                                                @if ($e->progress_status === 'selesai')
                                                    Selesai
                                                @elseif ($e->progress_percentage > 0)
                                                    Lanjutkan Belajar
                                                @else
                                                    Mulai Belajar
                                                @endif

                                                <i data-lucide="arrow-right" size="16"></i>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-center text-muted">Belum Memiliki Event Kursus</h5>
                        @endforelse


                        {{-- Course Card 2 (Selesai) --}}
                        <!-- <div class="col-12 col-md-6 col-lg-4">
                                            <div class="card border-0 rounded-4 shadow-sm bg-white h-100 overflow-hidden hover-card">
                                                {{-- Card Image Banner --}}
                                                <div class="position-relative">
                                                    <img src="https://images.unsplash.com/photo-1542744094-3a3172720177?w=600&auto=format&fit=crop&q=80" class="card-img-top style-banner" alt="Course Thumbnail">
                                                    <span class="badge position-absolute top-0 end-0 m-3 rounded-pill px-2.5 py-1.5 smaller fw-semibold bg-white text-dark shadow-sm">
                                                        <i data-lucide="map-pin" size="12" class="me-1"></i> Offline
                                                    </span>
                                                </div>

                                                {{-- Card Body --}}
                                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                                    <div>
                                                        <div class="d-flex align-items-center gap-2 mb-2">
                                                            <span class="badge rounded-pill px-2.5 py-1 smaller fw-semibold" style="background-color: #d1fae5; color: #059669;">Selesai</span>
                                                            <span class="text-muted smaller">• Terdaftar 10 May 2026</span>
                                                        </div>
                                                        <h5 class="fw-bold text-dark mb-2">Pelatihan Kewirausahaan Akhir Tahun</h5>
                                                        <p class="text-muted smaller mb-3 line-clamp-2">Manajemen keuangan usaha dan pembukuan sederhana untuk pebisnis pemula.</p>
                                                    </div>

                                                    <div>
                                                        {{-- Progress Bar --}}
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                                <span class="text-muted smaller fw-medium">Progres Belajar</span>
                                                                <span class="fw-bold text-success smaller">100%</span>
                                                            </div>
                                                            <div class="progress rounded-pill" style="height: 6px;">
                                                                <div class="progress-bar rounded-pill bg-success" role="progressbar" style="width: 100%;"></div>
                                                            </div>
                                                        </div>

                                                        {{-- Info Meta --}}
                                                        <div class="d-flex align-items-center justify-content-between pt-2 border-top text-muted smaller mb-3">
                                                            <div class="d-flex align-items-center gap-1">
                                                                <i data-lucide="check-circle-2" size="14" class="text-success"></i> Lulus
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1">
                                                                <i data-lucide="award" size="14" class="text-warning"></i> Ada Sertifikat
                                                            </div>
                                                        </div>

                                                        {{-- Action Buttons Group --}}
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="btn btn-outline-success flex-grow-1 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-1 smaller">
                                                                <i data-lucide="download" size="15"></i> Sertifikat
                                                            </a>
                                                            <a href="#" class="btn btn-light rounded-3 px-3 py-2 text-secondary fw-semibold smaller border" title="Lihat Ulang">
                                                                <i data-lucide="eye" size="15"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .smaller {
            font-size: 0.8rem;
        }

        .style-banner {
            height: 160px;
            object-fit: cover;
        }

        .hover-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .custom-pills .nav-link {
            color: #6b7280;
            background-color: transparent;
        }

        .custom-pills .nav-link.active {
            background-color: #2563eb !important;
            color: #ffffff !important;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>
@endsection