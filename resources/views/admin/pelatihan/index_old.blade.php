@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white">
    <div class="row py-5">
        <div class="col-md-12 border-primary bg-primary bg-opacity-10 rounded-3 py-3 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-800 text-primary mb-0">Manajemen Pelatihan & Sertifikasi</h5>
                <p class="text-muted small mb-0">Kelola kurikulum pelatihan, mentor, dan progres edukasi pelaku UMKM.</p>
            </div>
            <a href="{{ route('admin.pelatihan.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                <i data-lucide="graduation-cap" size="18"></i> Tambah Pelatihan Baru
            </a>
        </div>

        <div class="col-md-12 mb-4">
            <div class="row g-3">
                <div class="col-md-8 d-flex gap-2">
                    <select class="form-select w-auto rounded-pill border-2 px-3">
                        <option>Semua Tingkat</option>
                        <option>Pemula (Basic)</option>
                        <option>Menengah (Intermediate)</option>
                        <option>Mahir (Advanced)</option>
                    </select>
                    <select class="form-select w-auto rounded-pill border-2 px-3">
                        <option>Status Pendaftaran</option>
                        <option>Dibuka</option>
                        <option>Penuh</option>
                        <option>Ditutup</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-start-pill border-2 ps-4" placeholder="Cari materi pelatihan...">
                        <button class="btn btn-primary rounded-end-pill px-4">
                            <i data-lucide="search" size="18"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-lg-12" style="min-height: 100vh;">
            <div class="table-responsive">
                <table class="table table-hover align-middle border" style="min-height: 30vh;">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 fw-semibold text-dark text-center" width="50">No</th>
                            <th class="py-3 fw-semibold text-dark" width="100">Materi Pelatihan</th>
                            <th class="py-3 fw-semibold text-dark">Tingkat</th>
                            <th class="py-3 fw-semibold text-dark">Mentor</th>
                            <th class="py-3 fw-semibold text-dark text-center">Peserta</th>
                            <th class="py-3 fw-semibold text-dark text-center">Status</th>
                            <th class="py-3 fw-semibold text-dark text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    

                        <!-- <tr>
                            <td class="text-center">1</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                        <i data-lucide="book-open" size="24"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">Test Pelatihan</h6>
                                        <small class="text-muted"><i data-lucide="layers" size="12"></i> Test</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center small">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill smaller fw-normal">
                                    Semua Level
                                </span>
                            </td>
                            <td>
                                <div class="smaller fw-bold text-dark">John Doe</div>
                                <div class="smaller text-muted">Ahli Strategi Bisnis</div>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold mb-0">10 / 20</div>
                                <div class="progress mt-1 mx-auto shadow-sm" style="height: 5px; width: 60px;">
                                    
                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                </div>
                            </td>
                            <td class="text-center small">
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-2 fw-bold smaller">Pendaftaran Buka</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-horizontal" size="18"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                        <li><a class="dropdown-item py-2" href=""><i data-lucide="edit-3" size="14" class="me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item py-2" href=""><i data-lucide="eye" size="14" class="me-2"></i> Pratinjau</a></li>
                                        <li><a class="dropdown-item py-2 text-danger" href="#"><i data-lucide="trash-2" size="14" class="me-2"></i> Hapus</a></li>
                                        <form id="delete-form-" action="" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button  type="button" class="btn btn-sm btn-light text-danger px-3">
                                            <i data-lucide="trash-2" size="14" class="me-3"></i>Hapus
                                        </button>

                                    </form>
                                        <li><hr class="dropdown-divider"></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>       -->
                      
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
    .smaller { font-size: 0.75rem; }
    .table thead th { border-top: none; letter-spacing: 0.5px; }
    .table td { border-bottom: 1px solid #f8fafc; padding-top: 15px; padding-bottom: 15px; }
    .progress-bar { transition: width 0.6s ease; }
</style>


<script>
    lucide.createIcons();
</script>

@endsection