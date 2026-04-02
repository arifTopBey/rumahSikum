@extends('dashboard.main.index')

@section('content-dashboard')
<div class="dashboard-wrapper border">
    <div class="row g-0">
        <div class="col-lg-3 border-end" style="min-height: 100vh; background: white;">
            <div class="sidebar-menu p-4">
                <div class="d-flex align-items-center gap-3 mb-4 px-2">
                    <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i data-lucide="store" size="24"></i>
                    </div>
                    <div>
                        <h6 class="fw-800 mb-0">Toko Batik Jaya</h6>
                        <span class="badge bg-success-subtle text-success smaller">Toko Aktif</span>
                    </div>
                </div>
                
                <nav>
                    <a href="#" class="nav-dash-link"><i data-lucide="layout-dashboard" size="18"></i> Dashboard</a>
                    <a href="#" class="nav-dash-link active"><i data-lucide="package" size="18"></i> Produk Saya</a>
                    <a href="#" class="nav-dash-link d-flex justify-content-between align-items-center">
                        <span class="d-flex align-items-center gap-2"><i data-lucide="shopping-cart" size="18"></i> Pesanan</span>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </a>
                    <a href="#" class="nav-dash-link"><i data-lucide="wallet" size="18"></i> Saldo & Penarikan</a>
                    <a href="#" class="nav-dash-link"><i data-lucide="megaphone" size="18"></i> Promosi Toko</a>
                    <hr class="my-3 opacity-50">
                    <a href="#" class="nav-dash-link"><i data-lucide="settings" size="18"></i> Pengaturan Toko</a>
                    <a href="#" class="nav-dash-link text-danger"><i data-lucide="log-out" size="18"></i> Keluar Seller</a>
                </nav>
            </div>
        </div>

        <div class="col-lg-9 px-4 py-4 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 mb-1 text-dark">Produk Saya</h4>
                    <p class="text-muted small mb-0">Kelola daftar produk dan ketersediaan stok Anda.</p>
                </div>
                <a href="#" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                    <i data-lucide="plus" size="18"></i> Tambah Produk Baru
                </a>
            </div>

            <div class="bg-white p-3 rounded-4 shadow-sm mb-4 border">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0"><i data-lucide="search" size="18" class="text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari nama produk...">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex gap-2 justify-content-md-end overflow-auto pb-1">
                            <button class="btn btn-sm btn-primary rounded-pill px-3">Semua (12)</button>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">Aktif (10)</button>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">Stok Habis (2)</button>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">Diarsipkan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-4 shadow-sm border overflow-hidden">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 border-0 small fw-bold text-muted">INFO PRODUK</th>
                                <th class="py-3 border-0 small fw-bold text-muted text-center">STOK</th>
                                <th class="py-3 border-0 small fw-bold text-muted">HARGA</th>
                                <th class="py-3 border-0 small fw-bold text-muted">STATUS</th>
                                <th class="py-3 border-0 small fw-bold text-muted pe-4 text-end">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://images.unsplash.com/photo-1590736704728-f4730bb30770?w=100" class="rounded-3 border" width="50" height="50" style="object-fit: cover;">
                                        <div>
                                            <h6 class="fw-bold mb-0 small">Kemeja Batik Pria Slimfit</h6>
                                            <span class="smaller text-muted">Kategori: Fashion Pria</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold small">45</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-primary small">Rp 185.000</span>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-2 smaller">Aktif</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle p-2" data-bs-toggle="dropdown">
                                            <i data-lucide="more-vertical" size="16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3">
                                            <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2" href="#"><i data-lucide="edit-3" size="14"></i> Edit Produk</a></li>
                                            <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2" href="#"><i data-lucide="eye" size="14"></i> Lihat Detail</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-danger" href="#"><i data-lucide="trash-2" size="14"></i> Hapus</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://images.unsplash.com/photo-1544233726-9f1d2b27be8b?w=100" class="rounded-3 border" width="50" height="50" style="object-fit: cover;">
                                        <div>
                                            <h6 class="fw-bold mb-0 small">Sepatu Motif Mega Mendung</h6>
                                            <span class="smaller text-muted">Kategori: Sepatu</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold small text-danger">0</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-primary small">Rp 320.000</span>
                                </td>
                                <td>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-2 smaller">Stok Habis</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle p-2" data-bs-toggle="dropdown">
                                            <i data-lucide="more-vertical" size="16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3">
                                            <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2" href="#"><i data-lucide="edit-3" size="14"></i> Edit Produk</a></li>
                                            <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-danger" href="#"><i data-lucide="trash-2" size="14"></i> Hapus</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-light border-top d-flex justify-content-between align-items-center">
                    <span class="smaller text-muted">Menampilkan 1-10 dari 12 produk</span>
                    <div class="d-flex gap-2">
                        <button class="btn btn-white btn-sm border px-3 rounded-pill disabled">Prev</button>
                        <button class="btn btn-white btn-sm border px-3 rounded-pill">Next</button>
                    </div>
                </div>
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