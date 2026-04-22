@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5">
        <div class="col-md-12 mb-4 d-flex justify-content-between align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.elearning.index') }}" class="text-decoration-none">E-Learning</a></li>
                    <li class="breadcrumb-item active">Detail Materi</li>
                </ol>
            </nav>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.elearning.index') }}" class="btn btn-white rounded-pill px-4 fw-bold border shadow-sm">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
                <a href="{{ route('admin.elearning.edit', $elearning->id) }}" class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm text-white">
                    <i data-lucide="edit-3" size="18" class="me-1"></i> Edit Materi
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="position-relative">
                        <img src="{{ route('showFoto.elearning.thumnail.private', $elearning->thumbnail) }}" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $elearning->name }}">
                        <div class="position-absolute top-0 start-0 m-4">
                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm fw-bold">
                                {{ $elearning->kategoriElearning->name }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">
                        <h2 class="fw-800 text-dark mb-4">{{ $elearning->name }}</h2>
                        
                        <h6 class="fw-bold text-dark mb-3">Deskripsi Materi:</h6>
                        <div class="text-muted lh-lg">
                            {!! $elearning->deskripsi !!}
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 bg-white">
                    <h6 class="fw-800 mb-4 d-flex align-items-center gap-2 text-primary">
                        <i data-lucide="play-circle" size="20"></i> Sumber Belajar Utama
                    </h6>
                    
                    @if($elearning->link_youtube)
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">Video Pembelajaran (YouTube)</label>
                        <div class="ratio ratio-16x9 rounded-4 overflow-hidden border">
                            @php
                                $video_id = explode('v=', $elearning->link_youtube)[1] ?? '';
                                if (str_contains($video_id, '&')) {
                                    $video_id = explode('&', $video_id)[0];
                                }
                            @endphp
                            <iframe src="https://www.youtube.com/embed/{{ $video_id }}" title="Video Player" allowfullscreen></iframe>
                        </div>
                        <a href="{{ $elearning->link_youtube }}" target="_blank" class="text-decoration-none small mt-2 d-inline-block text-primary">
                            <i data-lucide="external-link" size="14"></i> Buka di Tab Baru
                        </a>
                    </div>
                    @endif

                    @if($elearning->pdf)
                    <div class="p-3 bg-light rounded-4 d-flex align-items-center justify-content-between border">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-danger bg-opacity-10 p-3 rounded-3 text-danger">
                                <i data-lucide="file-text" size="24"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Modul Pelatihan (PDF)</h6>
                                <p class="smaller text-muted mb-0">Klik tombol untuk mengunduh materi</p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $elearning->pdf) }}" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill px-4 fw-bold">
                            Download PDF
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-center bg-white border-top border-5 border-primary">
                    <img src="{{ route('showFoto.elearning.mentor.private', $elearning->photo_mentor) }}" 
                         class="rounded-circle shadow-sm mx-auto mb-3 border border-3 border-white" 
                         style="width: 100px; height: 100px; object-fit: cover;">
                    <h5 class="fw-800 mb-1">{{ $elearning->nama_mentor }}</h5>
                    <p class="text-primary fw-bold small mb-3">{{ $elearning->bidang_menthor }}</p>
                    <hr class="opacity-50">
                    <div class="row text-start mt-3">
                        <div class="col-6 mb-3">
                            <label class="smaller text-muted d-block">Level Materi</label>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-bold text-capitalize">{{ $elearning->level }}</span>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="smaller text-muted d-block">Durasi Belajar</label>
                            <span class="fw-bold"><i data-lucide="clock" size="14" class="me-1"></i> {{ $elearning->durasi }} Menit</span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 {{ $elearning->is_publish ? 'bg-success bg-opacity-10 border border-success border-opacity-25' : 'bg-secondary bg-opacity-10' }}">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-800 mb-1 {{ $elearning->is_publish ? 'text-success' : 'text-muted' }}">
                                {{ $elearning->is_publish ? 'Materi Publik' : 'Draft / Privat' }}
                            </h6>
                            <p class="smaller mb-0 {{ $elearning->is_publish ? 'text-success' : 'text-muted' }}">
                                {{ $elearning->is_publish ? 'Materi dapat diakses oleh UMKM.' : 'Hanya admin yang dapat melihat.' }}
                            </p>
                        </div>
                        <div class="text-end">
                            <i data-lucide="{{ $elearning->is_publish ? 'globe' : 'lock' }}" class="{{ $elearning->is_publish ? 'text-success' : 'text-muted' }}"></i>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-800 mb-3 small d-flex align-items-center gap-2 text-dark">
                        <i data-lucide="lightbulb" size="16" class="text-warning"></i> Tips Pengelolaan
                    </h6>
                    <p class="smaller text-muted mb-0">Pastikan video YouTube tidak dalam status "Private" agar peserta dapat menonton tanpa kendala.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .btn-white { background: white; }
    .card-body img { max-width: 100%; border-radius: 12px; }
</style>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection