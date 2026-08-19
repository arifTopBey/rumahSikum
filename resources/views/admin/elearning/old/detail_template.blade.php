
@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5">
        <div class="col-md-12 mb-4 d-flex justify-content-between align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">E-Learning</a></li>
                    <li class="breadcrumb-item active">Detail Materi</li>
                </ol>
            </nav>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
                <a href="#" class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm">
                    <i data-lucide="edit-3" size="18" class="me-1"></i> Edit Kelas
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=600" class="img-fluid h-100 object-fit-cover" alt="Course Thumbnail">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <span class="badge bg-primary bg-opacity-10 text-primary mb-2">Digital Marketing</span>
                                <h4 class="fw-800 text-dark mb-2">Strategi Branding Produk di Instagram</h4>
                                <p class="text-muted small mb-3">Oleh: <span class="fw-bold text-dark">Rico Wijaya</span></p>
                                <div class="d-flex gap-4">
                                    <div class="small"><i data-lucide="book-open" size="14" class="text-primary me-1"></i> 12 Modul</div>
                                    <div class="small"><i data-lucide="clock" size="14" class="text-primary me-1"></i> 120 Menit</div>
                                    <div class="small"><i data-lucide="users" size="14" class="text-primary me-1"></i> 1,240 Siswa</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-800 mb-0">Struktur Kurikulum / Modul</h6>
                        <button class="btn btn-sm btn-primary rounded-pill px-3">
                            <i data-lucide="plus" size="14" class="me-1"></i> Tambah Modul
                        </button>
                    </div>

                    <div class="list-group list-group-flush border rounded-3 overflow-hidden">
                        {{-- Modul Item 1 --}}
                        <div class="list-group-item p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light p-2 rounded text-muted fw-bold small">01</div>
                                <div>
                                    <h6 class="mb-0 small fw-bold">Pengenalan Algoritma Instagram 2026</h6>
                                    <span class="smaller text-muted"><i data-lucide="play-circle" size="12"></i> Video - 08:12</span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-light border p-1"><i data-lucide="edit-2" size="14"></i></button>
                                <button class="btn btn-sm btn-light border p-1 text-danger"><i data-lucide="trash" size="14"></i></button>
                            </div>
                        </div>

                        {{-- Modul Item 2 --}}
                        <div class="list-group-item p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light p-2 rounded text-muted fw-bold small">02</div>
                                <div>
                                    <h6 class="mb-0 small fw-bold">Teknik Foto Produk Estetik</h6>
                                    <span class="smaller text-muted"><i data-lucide="play-circle" size="12"></i> Video - 15:45</span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-light border p-1"><i data-lucide="edit-2" size="14"></i></button>
                                <button class="btn btn-sm btn-light border p-1 text-danger"><i data-lucide="trash" size="14"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <h6 class="fw-800 mb-3">Status Konten</h6>
                    <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-success bg-opacity-10 border border-success border-opacity-25 rounded-3">
                        <span class="small fw-bold text-success">Aktif (Live)</span>
                        <div class="form-check form-switch p-0 m-0">
                            <input class="form-check-input" type="checkbox" checked>
                        </div>
                    </div>
                    <button class="btn btn-light w-100 rounded-pill border small fw-bold"><i data-lucide="eye" size="14" class="me-2"></i> Lihat Pratinjau Frontend</button>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h6 class="fw-800 mb-3">Performa Kelas</h6>
                    <div class="mb-3">
                        <label class="smaller text-muted d-block">Tingkat Penyelesaian (Completion Rate)</label>
                        <div class="d-flex align-items-center gap-2">
                            <h4 class="fw-800 mb-0">68%</h4>
                            <span class="smaller text-success fw-bold"><i data-lucide="trending-up" size="12"></i> +5%</span>
                        </div>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: 68%"></div>
                        </div>
                    </div>
                    <div class="row text-center mt-4">
                        <div class="col-6 border-end">
                            <h5 class="fw-bold mb-0">842</h5>
                            <small class="smaller text-muted">Lulus</small>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-bold mb-0">156</h5>
                            <small class="smaller text-muted">Review</small>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-800 mb-3">Siswa Terbaru</h6>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://i.pravatar.cc/150?u=1" class="rounded-circle" width="35">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 small fw-bold">Siti Rahma</h6>
                                <span class="smaller text-muted">Baru saja mendaftar</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://i.pravatar.cc/150?u=2" class="rounded-circle" width="35">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 small fw-bold">Budi Cahyadi</h6>
                                <span class="smaller text-muted">Selesai Modul 2</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a href="#" class="btn btn-sm btn-link text-decoration-none w-100 fw-bold small">Lihat Semua Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .list-group-item:hover { background-color: #f8f9fa; }
</style>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection