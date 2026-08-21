@extends('frontend.main.index')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container" style="max-width: 900px; margin-top: 60px;">

        {{-- Header Navigation & Title --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="" class="btn btn-white bg-white rounded-circle shadow-sm p-2 d-flex align-items-center justify-content-center border" style="width: 40px; height: 40px;">
                    <i data-lucide="arrow-left" size="20" class="text-dark"></i>
                </a>
                <h4 class="fw-bold text-dark mb-0">{{ $modul->urutan ?? '1' }}. {{ $modul->judul ?? 'Mengelola Keuangan Bisnis' }}</h4>
            </div>
            <button class="btn btn-link text-muted p-0 border-0" title="Bookmark Modul">
                <i data-lucide="bookmark" size="22"></i>
            </button>
        </div>

        {{-- Navigation Tabs --}}
        <ul class="nav nav-tabs border-0 gap-4 mb-4 custom-nav-tabs">
            <li class="nav-item">
                <button class="nav-link active px-1 py-2 fw-bold" id="materi-tab" data-bs-toggle="tab" data-bs-target="#materi-content" type="button">Materi</button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-1 py-2 fw-semibold text-muted" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-content" type="button">Video</button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-1 py-2 fw-semibold text-muted" id="quiz-tab" data-bs-toggle="tab" data-bs-target="#quiz-content" type="button">Quiz</button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-1 py-2 fw-semibold text-muted" id="diskusi-tab" data-bs-toggle="tab" data-bs-target="#diskusi-content" type="button">Diskusi</button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-1 py-2 fw-semibold text-muted" id="file-tab" data-bs-toggle="tab" data-bs-target="#file-content" type="button">File</button>
            </li>
        </ul>

        {{-- Tab Contents --}}
        <div class="tab-content mb-4">
            
            {{-- TAB 1: MATERI --}}
            <div class="tab-pane fade show active" id="materi-content">
                {{-- Card Ringkasan Modul --}}
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white mb-4">
                    <h6 class="fw-bold text-dark mb-2">Ringkasan Modul</h6>
                    <p class="text-secondary mb-0 small">
                        {{ $modul->deskripsi ?? 'Materi Sesi I Modul Finance Academy' }}
                    </p>
                </div>

                {{-- Card Materi Pembelajaran --}}
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white mb-4">
                    <h6 class="fw-bold text-dark mb-3">Materi Pembelajaran</h6>

                    <div class="d-flex align-items-center justify-content-between p-2 rounded-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 bg-warning bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i data-lucide="file-text" size="24" class="text-warning"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1 small">{{ $modul->judul ?? 'Mengelola Keuangan Bisnis' }}</h6>
                                <span class="text-muted smaller">{{ $modul->tipe_materi ?? 'PPT' }} • <a href="{{ $modul->tautan ?? '#' }}" target="_blank" class="text-muted text-decoration-none">Buka materi</a></span>
                            </div>
                        </div>
                        <div>
                            <a href="{{ $modul->tautan ?? '#' }}" target="_blank" class="btn btn-link text-muted p-1" title="Buka di tab baru">
                                <i data-lucide="external-link" size="18"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB 2: VIDEO --}}
            <div class="tab-pane fade" id="video-content">
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white text-center py-5">
                    <i data-lucide="video" size="40" class="text-muted mb-2 opacity-50 mx-auto"></i>
                    <p class="text-muted small mb-0">Belum ada video untuk modul ini.</p>
                </div>
            </div>

            {{-- TAB 3: QUIZ --}}
            <div class="tab-pane fade" id="quiz-content">
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white text-center py-5">
                    <i data-lucide="help-circle" size="40" class="text-muted mb-2 opacity-50 mx-auto"></i>
                    <p class="text-muted small mb-0">Quiz belum tersedia.</p>
                </div>
            </div>

            {{-- TAB 4: DISKUSI --}}
            <div class="tab-pane fade" id="diskusi-content">
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white text-center py-5">
                    <i data-lucide="message-square" size="40" class="text-muted mb-2 opacity-50 mx-auto"></i>
                    <p class="text-muted small mb-0">Belum ada diskusi untuk modul ini.</p>
                </div>
            </div>

            {{-- TAB 5: FILE --}}
            <div class="tab-pane fade" id="file-content">
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white text-center py-5">
                    <i data-lucide="folder" size="40" class="text-muted mb-2 opacity-50 mx-auto"></i>
                    <p class="text-muted small mb-0">Tidak ada lampiran file tambahan.</p>
                </div>
            </div>

        </div>

       {{-- Navigation Buttons (Sebelumnya & Berikutnya) --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                @if(isset($prevModul) && $prevModul)
                    <a href="{{ route('frontend.e-learning.detail.modul', [$modul->event_organizer_id, $prevModul->id]) }}" class="btn btn-white bg-white border rounded-3 px-3 py-2 text-secondary fw-semibold small d-flex align-items-center gap-1 shadow-sm">
                        <i data-lucide="chevron-left" size="16"></i> Sebelumnya
                    </a>
                @endif
            </div>

            <div>
                @if(isset($nextModul) && $nextModul)
                    <a href="{{ route('frontend.e-learning.detail.modul', [$modul->event_organizer_id, $nextModul->id]) }}" class="btn btn-white bg-white border rounded-3 px-3 py-2 text-secondary fw-semibold small d-flex align-items-center gap-1 shadow-sm">
                        Berikutnya <i data-lucide="chevron-right" size="16"></i>
                    </a>
                @endif
            </div>
        </div>

        {{-- Bottom Action Button --}}
        <form action="" method="POST">
            @csrf
        
        @if (Auth::check() && $eventRegister)
            <button type="button" class="btn btn-success w-100 rounded-3 py-3 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm" style="border: none;">
                <i data-lucide="check-circle-2" size="20"></i>
                Tandai Modul Selesai
            </button> 
        @elseif (Auth::check() && !$eventRegister)
            <button type="button" class="btn btn-primary w-100 rounded-3 py-3 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm" style="background-color: #2563eb; border: none;">
                <i data-lucide="check-circle-2" size="20"></i>
                Daftar Event Untuk Progress
            </button> 
        @elseif(!Auth::check())
            <a href="{{ route('login') }}" class="btn btn-danger w-100 rounded-3 py-3 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm" style="border: none;">
                <i data-lucide="check-circle-2" size="20"></i>
                Login Untuk Progress
            </a> 
        @endif
        </form>

    </div>
</div>

<style>
    .smaller { font-size: 0.8rem; }

    /* Clean Underline Nav Tabs */
    .custom-nav-tabs {
        border-bottom: 2px solid #e2e8f0 !important;
    }

    .custom-nav-tabs .nav-link {
        border: none;
        color: #64748b;
        background: transparent;
        position: relative;
        padding-bottom: 12px !important;
    }

    .custom-nav-tabs .nav-link.active {
        color: #2563eb !important;
        background: transparent !important;
    }

    .custom-nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #2563eb;
        border-radius: 2px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection