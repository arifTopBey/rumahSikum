@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white">
    <div class="row py-5">
        <div class="col-md-12 border-primary bg-primary bg-opacity-10 rounded-3 py-3 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-800 text-primary mb-0">Manajemen Akademi Digital</h5>
                <p class="text-muted small mb-0">Kelola konten video pembelajaran, e-book, dan kurikulum mandiri untuk UMKM.</p>
            </div>
            <a href="{{ route('admin.elearning.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                <i data-lucide="plus-circle" size="18"></i> Upload Materi Baru
            </a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 bg-light p-3 rounded-4">
                    <p class="text-muted small mb-1 fw-bold">Total Materi</p>
                    <h4 class="fw-800 mb-0">{{ $totalMateri ?? 0 }} Materi</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-3 rounded-4">
                    <p class="text-muted small mb-1 fw-bold">Total Penonton</p>
                    <h4 class="fw-800 mb-0">{{ $totalViews ? $totalViews : 0  }} Penonton</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-3 rounded-4">
                    <p class="text-muted small mb-1 fw-bold">Total PDF</p>
                    <h4 class="fw-800 mb-0">{{ $totalPdf ? $totalPdf : 0 }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-3 rounded-4">
                    <p class="text-muted small mb-1 fw-bold">Materi Populer</p>
                    <h4 class="fw-800 mb-0 text-primary small">{{ $topElearning->name ?? 'Tidak Tersedia'  }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="row g-3">
                <div class="col-md-8 d-flex gap-2">
                    <select class="form-select w-auto rounded-pill border-2 px-5">
                        <option>Semua Kategori</option>
                        <option>Digital Marketing</option>
                        <option>Keuangan</option>
                        <option>Legalitas</option>
                    </select>
                    <!-- <select class="form-select w-auto rounded-pill border-2 px-3">
                        <option>Format: Semua</option>
                        <option>Video</option>
                        <option>E-Book</option>
                    </select> -->
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-start-pill border-2 ps-4" placeholder="Cari judul materi...">
                        <button class="btn btn-primary rounded-end-pill px-4"><i data-lucide="search" size="18"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <!-- <div class="table-responsive border rounded-4">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small fw-bold text-uppercase">
                        <tr>
                            <th class="ps-4 py-3 text-center" width="5%">No</th>
                            <th class="py-3" width="35%">Judul Kelas & Mentor</th>
                            <th class="py-3 text-center">Format</th>
                            <th class="py-3 text-center">Total Siswa</th>
                            <th class="py-3 text-center">Modul</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="py-3 text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Row 1 --}}
                        <tr>
                            <td class="ps-4 text-center fw-bold text-muted">1</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=100" class="rounded-3 shadow-sm" width="60" height="40" style="object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mb-0">Strategi Branding Instagram</h6>
                                        <small class="text-muted">Mentor: Rico Wijaya</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2"><i data-lucide="play-circle" size="14" class="me-1"></i> Video</span>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold mb-0">1.2k</div>
                                <small class="text-muted smaller">Pendaftar</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2 py-1 small fw-normal">12 Materi</span>
                            </td>
                            <td class="text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </td>
                            <td class="text-center pe-4">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border rounded-circle p-2" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-vertical" size="18"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                        <li><a class="dropdown-item py-2" href="#"><i data-lucide="layout" size="14" class="me-2 text-primary"></i> Kelola Modul</a></li>
                                        <li><a class="dropdown-item py-2" href="#"><i data-lucide="edit-3" size="14" class="me-2 text-warning"></i> Edit Detail</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item py-2 text-danger" href="#"><i data-lucide="trash-2" size="14" class="me-2"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        {{-- Contoh Row 2 --}}
                        <tr>
                            <td class="ps-4 text-center fw-bold text-muted">2</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=100" class="rounded-3 shadow-sm" width="60" height="40" style="object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mb-0">Manajemen Kas Sederhana</h6>
                                        <small class="text-muted">Mentor: Siti Aminah</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2"><i data-lucide="book-open" size="14" class="me-1"></i> E-Book</span>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold mb-0">850</div>
                                <small class="text-muted smaller">Unduhan</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2 py-1 small fw-normal">1 File PDF</span>
                            </td>
                            <td class="text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </td>
                            <td class="text-center pe-4">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border rounded-circle p-2" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-vertical" size="18"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                        <li><a class="dropdown-item py-2" href="#"><i data-lucide="edit-3" size="14" class="me-2 text-warning"></i> Edit</a></li>
                                        <li><a class="dropdown-item py-2 text-danger" href="#"><i data-lucide="trash-2" size="14" class="me-2"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> -->

             <div class="table-responsive border rounded-4" style="min-height: 300px;">
                <table class="table table-hover align-middle border" style="min-height: 20vh;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-center" width="5%">No</th>
                            <th class="py-3" width="35%">Judul Kelas & Mentor</th>
                            <th class="py-3 text-center">Level</th>
                            <th class="py-3 text-center">Total Penonton</th>
                            <th class="py-3 text-center">Modul PDF</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="py-3 text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach ($elearnings as $elearning )
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                            <div class="d-flex align-items-center gap-3">
                                    <!-- <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=100" class="rounded-3 shadow-sm" width="60" height="40" style="object-fit: cover;"> -->
                                    <img src="{{ route('showFoto.elearning.thumnail.private', $elearning->thumbnail) }}" class="rounded-3 shadow-sm" width="60" height="40" style="object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $elearning->name }}</h6>
                                        <small class="text-muted">Mentor: {{ $elearning->nama_mentor }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center small">
                                <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2"> {{ $elearning->level }}</span>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold mb-0">{{ $elearning->views }}</div>
                                <small class="text-muted smaller">Penonton</small>
                            </td>
                            <td class="text-center">
                                 @if ($elearning->pdf)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-2">Ada</span>
                                    @else   
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-2">Tidak Ada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($elearning->is_publish === 1)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-2">Published</span>
                                    @else   
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-2">Non Published</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border rounded-circle p-2" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-vertical" size="18"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.elearning.edit', $elearning->id) }}"><i data-lucide="layout" size="14" class="me-2 text-primary"></i> Kelola Modul</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.elearning.show', $elearning->id) }}"><i data-lucide="eye" size="14" class="me-2 text-warning"></i> Detail</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="dropdown-item py-2 text-danger">
                                             <form id="delete-form-{{ $elearning->id }}" action="{{ route('admin.elearning.delete', $elearning->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirmDelete('{{ $elearning->id }}', '{{ $elearning->name }}')" type="button" class="btn btn-sm btn-light text-danger px-3">
                                                <i data-lucide="trash-2" size="14" class="me-3"></i>Hapus
                                            </button>

                                        </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>      
                    @endforeach
                   
                      
                        <!-- <tr>
                            <td colspan="8" class="text-center py-5 text-muted">Belum ada berita yang diterbitkan.</td>
                        </tr> -->
                      
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.7rem; }
    .table thead th { border-top: none; letter-spacing: 0.5px; }
    .form-check-input:checked { background-color: #4361ee; border-color: #4361ee; }
</style>


<script>
    lucide.createIcons();
</script>

@endsection