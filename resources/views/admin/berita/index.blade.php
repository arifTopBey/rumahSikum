@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white">
    <div class="row py-5">
        <div class="col-md-12 mx-auto border-primary bg-primary bg-opacity-10 rounded-2 py-3 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <p class="fw-bold fs-5 text-primary mb-0">Manajemen Berita & Artikel</p>
                <p class="text-muted mb-0">Kelola konten edukasi, kebijakan, dan informasi terkini untuk UMKM.</p>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                <i data-lucide="plus-circle" size="18" class="me-1"></i> Buat Berita Baru
            </a>
        </div>

        <div class="col-md-12 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex gap-2">
                        <select class="form-select w-auto rounded-3">
                            <option value="">Semua Kategori</option>
                            <option value="Kebijakan">Kebijakan</option>
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Tips">Tips Bisnis</option>
                        </select>
                        <select class="form-select w-auto rounded-3">
                            <option value="">Status</option>
                            <option value="Published">Published</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Cari judul berita..." name="search" value="{{ request('search') }}">
                            <button class="btn btn-outline-primary border-start-0" type="submit">
                                <i data-lucide="search" size="18"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 fw-semibold text-dark text-center" width="50">No</th>
                            <th class="py-3 fw-semibold text-dark" width="100">Thumbnail</th>
                            <th class="py-3 fw-semibold text-dark">Judul Berita</th>
                            <th class="py-3 fw-semibold text-dark text-center">Kategori</th>
                            <th class="py-3 fw-semibold text-dark text-center">Penulis</th>
                            <th class="py-3 fw-semibold text-dark text-center">Status</th>
                            <th class="py-3 fw-semibold text-dark text-center">Tanggal</th>
                            <th class="py-3 fw-semibold text-dark text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <img src="https://images.unsplash.com/photo-1459802071246-377c0346da93?q=80&w=818&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-2 border" width="80" height="50" style="object-fit: cover;">
                            </td>
                            <td>
                                <div class="fw-bold text-dark"></div>
                                <span class="smaller text-muted"><i data-lucide="eye" size="12"></i> 108 Klik</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">Hiburan</span>
                            </td>
                            <td class="text-center small">Admin</td>
                            <td class="text-center">
                                <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-2">Published</span>
                            </td>
                            <td class="text-center small">2002-20-02</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-horizontal" size="18"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                        <li><a class="dropdown-item py-2" href="#"><i data-lucide="edit-3" size="14" class="me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item py-2" href="#"><i data-lucide="eye" size="14" class="me-2"></i> Pratinjau</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item py-2 text-danger" href="#"><i data-lucide="trash-2" size="14" class="me-2"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                      
                        <!-- <tr>
                            <td colspan="8" class="text-center py-5 text-muted">Belum ada berita yang diterbitkan.</td>
                        </tr> -->
                      
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection