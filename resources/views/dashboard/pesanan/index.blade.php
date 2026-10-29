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
                    <a href="#" class="nav-dash-link"><i data-lucide="package" size="18"></i> Produk Saya</a>
                    <a href="#" class="nav-dash-link active d-flex justify-content-between align-items-center">
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
                    <h4 class="fw-800 mb-1 text-dark">Daftar Pesanan</h4>
                    <p class="text-muted small mb-0">Pantau dan proses semua pesanan pelanggan Anda di sini.</p>
                </div>
                <button class="btn btn-outline-primary rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                    <i data-lucide="download" size="18"></i> Ekspor Laporan
                </button>
            </div>

            <div class="bg-white rounded-4 shadow-sm mb-4 border overflow-hidden">
                <ul class="nav nav-pills nav-fill p-2 bg-light">
                    <li class="nav-item">
                        <a class="nav-link active rounded-pill fw-bold small" href="#">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill fw-bold small text-muted" href="#">Belum Bayar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill fw-bold small text-muted" href="#">Perlu Dikemas <span class="badge bg-danger ms-1">3</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill fw-bold small text-muted" href="#">Dikirim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill fw-bold small text-muted" href="#">Selesai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill fw-bold small text-muted" href="#">Dibatalkan</a>
                    </li>
                </ul>
                
                <div class="p-3 border-top">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0"><i data-lucide="search" size="18" class="text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari No. Pesanan atau Nama Pembeli...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control" placeholder="Pilih Tanggal">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-dark w-100 rounded-3 fw-bold">Cari Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-4 shadow-sm border overflow-hidden">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 border-0 small fw-bold text-muted">PEMBELI & NO. ORDER</th>
                                <th class="py-3 border-0 small fw-bold text-muted">PRODUK</th>
                                <th class="py-3 border-0 small fw-bold text-muted">TOTAL BAYAR</th>
                                <th class="py-3 border-0 small fw-bold text-muted">STATUS</th>
                                <th class="py-3 border-0 small fw-bold text-muted pe-4 text-end">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 py-3">
                                    <h6 class="fw-bold mb-0 small">Budi Santoso</h6>
                                    <span class="text-primary smaller fw-bold">#RS-8821</span>
                                    <div class="smaller text-muted mt-1">10 Apr 2026, 09:15</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://images.unsplash.com/photo-1590736704728-f4730bb30770?w=100" class="rounded-2" width="35" height="35" style="object-fit: cover;">
                                        <div class="smaller">
                                            <div class="fw-bold text-truncate" style="max-width: 150px;">Kemeja Batik Pria</div>
                                            <div class="text-muted">1 Barang</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold small">Rp 195.000</span>
                                    <div class="smaller text-muted">Transfer Bank</div>
                                </td>
                                <td>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-2 smaller fw-bold">Perlu Dikemas</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-primary btn-sm rounded-pill px-3 fw-bold">Atur Pengiriman</button>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 py-3">
                                    <h6 class="fw-bold mb-0 small">Siti Aminah</h6>
                                    <span class="text-primary smaller fw-bold">#RS-8819</span>
                                    <div class="smaller text-muted mt-1">10 Apr 2026, 08:30</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://images.unsplash.com/photo-1544233726-9f1d2b27be8b?w=100" class="rounded-2" width="35" height="35" style="object-fit: cover;">
                                        <div class="smaller">
                                            <div class="fw-bold text-truncate" style="max-width: 150px;">Sepatu Batik Mega</div>
                                            <div class="text-muted">2 Barang</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold small">Rp 650.000</span>
                                    <div class="smaller text-muted">Saldo RumahSikum</div>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-2 smaller fw-bold">Dikirim</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold">Lacak Resi</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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