@extends('frontend.main.index') {{-- sesuaikan dengan master layout public Anda --}}

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container" style="max-width: 900px;">

        {{-- Tombol Kembali --}}
        <div class="mb-3 d-flex justify-content-between" style="margin-top: 60px;">
            <a href="{{ route('frontend.e-learning') }}" class="btn btn-link text-decoration-none text-secondary p-0 fw-semibold d-inline-flex align-items-center gap-1">
                <i data-lucide="arrow-left" size="18"></i> Kembali
            </a>

            @if($eventRegister)
                <a href="" class="btn btn-success text-decoration-none text-white p-2 fw-semibold d-inline-flex align-items-center gap-1">
                    Anda Sudah Terdaftar
                </a>
            @elseif(!$eventRegister)
             <a href="{{ route('frontend.modul.register', $elearning->id ) }}" class="btn btn-primary text-decoration-none text-white p-2 fw-semibold d-inline-flex align-items-center gap-1">
                    Daftar Ikuti Acara
                </a>
            @endif
        </div>

        {{-- Banner Header Event --}}
        <div class="card border-0 rounded-4 text-white p-4 mb-3 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="bg-white bg-opacity-20 rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; backdrop-filter: blur(4px);">
                    <i data-lucide="globe" size="28" class="text-white"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0 text-white">{{ $elearning->judul_event ?? 'Export Academy' }}</h4>
                    <span class="text-white-50 small">{{ $elearning->organizer ?? 'OpenClass Official' }}</span>
                </div>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-3 pt-2">
                <div class="d-flex align-items-center gap-1 small fw-medium">
                    <i data-lucide="play-circle" size="16"></i> {{ count($modules ?? []) }} Modul
                </div>
                <!-- <div class="d-flex align-items-center gap-1 small fw-medium">
                    <i data-lucide="clock" size="16"></i> Total ± {{ $elearning->durasi ?? '5' }} Jam
                </div> -->
                <div class="d-flex align-items-center gap-1 small fw-medium">
                    <i data-lucide="users" size="16"></i> {{ $elearning->peserta_count ?? 1 }} Peserta
                </div>
            </div>
        </div>

        {{-- Card Progress Belajar --}}
        <div class="card border-0 rounded-4 p-4 mb-4 shadow-sm bg-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-bold text-dark">Progress Belajar</span>
                <span class="fw-bold text-primary"> {{ $progressPercentage ?? 0 }}%</span>
            </div>
            <div class="progress rounded-pill mb-3" style="height: 8px; background-color: #f1f5f9;">
                <div class="progress-bar rounded-pill bg-success" role="progressbar" style="width: {{ $progressPercentage ?? 0 }}%;" aria-valuenow="{{ $progressPercentage ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between align-items-center smaller">
                <span class="text-muted">{{ $completedModulesCount ?? 0 }} dari {{ count($modules ?? []) }} modul selesai</span>
                @guest
                    <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">Login untuk simpan progress</a>
                @endguest
            </div>
        </div>

        {{-- Navigation Tabs --}}
        <ul class="nav nav-tabs border-0 gap-3 mb-4 custom-tabs">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2 fw-semibold" id="modul-tab" data-bs-toggle="tab" data-bs-target="#modul-content" type="button">Modul</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2 fw-semibold text-muted" id="tentang-tab" data-bs-toggle="tab" data-bs-target="#tentang-content" type="button">Tentang</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2 fw-semibold text-muted" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-content" type="button">Reviews</button>
            </li>
        </ul>

        {{-- Tab Contents --}}
        <div class="tab-content">
            
            {{-- TAB 1: DAFTAR MODUL --}}
            <div class="tab-pane fade show active" id="modul-content">
                <h5 class="fw-bold text-dark mb-3">Daftar Modul</h5>

                <div class="d-flex flex-column gap-3">
                    @forelse ($modules as $index => $modul)
                    
                    <a href="{{ route('frontend.e-learning.detail.modul', [$modul->event_organizer_id, $modul->id]) }}" class="text-decoration-none">
                        <div class="card border-0 rounded-4 p-3 shadow-sm bg-white hover-card transition">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="number-box rounded-3 bg-primary bg-opacity-10 text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">{{ $modul->judul }}</h6>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-warning bg-opacity-10 text-warning fw-bold px-2 py-0 smaller">{{ $modul->tipe_materi }}</span>
                                            <span class="text-muted smaller">• {{ $modul->deskripsi_singkat ?? 'Materi Sesi ' . ($index + 1) . ' Modul ' . $elearning->judul_event }}</span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </a>
                    @empty
                            <div class="card border-0 rounded-4 p-3 shadow-sm bg-white hover-card transition">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="number-box rounded-3 bg-primary bg-opacity-10 text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                            1
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1">Materi Belum Tersedia</h6>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-warning bg-opacity-10 text-warning fw-bold px-2 py-0 smaller" style="color: #ea580c !important;">X</span>
                                                <span class="text-muted smaller">Materi Belum Tersedia</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- <a href="#" class="btn btn-light rounded-circle p-2 text-muted d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <i data-lucide="play-circle" class="text-primary" size="20"></i>   
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        
                    @endforelse
                </div>
            </div>

            {{-- TAB 2: TENTANG --}}
            <div class="tab-pane fade" id="tentang-content">
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white">
                    <h5 class="fw-bold text-dark mb-3">Tentang Pelatihan</h5>
                    <div class="text-secondary lh-lg">
                        {!! $elearning->deskripsi_event ?? 'Pelatihan ini dirancang untuk memberikan pemahaman menyeluruh mengenai proses ekspor dari tahap dasar hingga siap merambah pasar internasional.' !!}
                    </div>
                </div>
            </div>

            {{-- TAB 3: REVIEWS --}}
            <div class="tab-pane fade" id="reviews-content">
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white text-center py-5">
                    <i data-lucide="star" size="40" class="text-muted mb-2 opacity-50 mx-auto"></i>
                    <p class="text-muted small mb-0">Belum ada ulasan untuk kelas ini.</p>
                </div>
            </div>

        </div>

    </div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
    .transition { transition: all 0.2s ease-in-out; }
    
    .hover-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06) !important;
    }

    /* Tab Custom Styling */
    .custom-tabs .nav-link {
        border: none;
        color: #64748b;
        background: transparent;
    }

    .custom-tabs .nav-link.active {
        color: #2563eb !important;
        background-color: #eff6ff !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection