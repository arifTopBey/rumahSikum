@extends('dashboard.main.index')

@section('content-dashboard')

<div class="dashboard-wrapper border">
    <div class="row g-4">
        <div class="col-lg-3" style="min-height: 100vh;">
            <div class="sidebar-menu shadow-sm">
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
                    <a href="#" class="nav-dash-link active"><i data-lucide="layout-dashboard" size="18"></i> Dashboard</a>
                    <a href="#" class="nav-dash-link"><i data-lucide="package" size="18"></i> Produk Saya</a>
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
        <div class="col-lg-9 px-4 py-4">
            <h4 class="fw-800 mb-4 text-dark">Halo, Mitra RumahSikum! 👋</h4>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-blue"><i data-lucide="banknote"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Total Pendapatan</p>
                            <h5 class="fw-800 mb-0">Rp 12.450.000</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-green"><i data-lucide="shopping-bag"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Pesanan Selesai</p>
                            <h5 class="fw-800 mb-0">142 Order</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-orange"><i data-lucide="eye"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Pengunjung Toko</p>
                            <h5 class="fw-800 mb-0">3.240 User</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-container shadow-sm mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-800 m-0">Pesanan Perlu Diproses</h5>
                    <a href="#" class="btn btn-sm btn-link text-decoration-none fw-bold">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">#RS-8821</td>
                                <td>
                                    <span class="d-block fw-bold small">Sepatu Batik Tangerang</span>
                                    <span class="text-muted smaller">Ukuran: 42</span>
                                </td>
                                <td class="fw-bold">Rp 245.000</td>
                                <td><span class="badge-status bg-warning text-dark">Perlu Dikemas</span></td>
                                <td><button class="btn btn-primary btn-sm rounded-pill px-3">Proses</button></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">#RS-8819</td>
                                <td>
                                    <span class="d-block fw-bold small">Kopi Arabika Mix</span>
                                    <span class="text-muted smaller">2 x Rp 45.000</span>
                                </td>
                                <td class="fw-bold">Rp 90.000</td>
                                <td><span class="badge-status bg-warning text-dark">Perlu Dikemas</span></td>
                                <td><button class="btn btn-primary btn-sm rounded-pill px-3">Proses</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-primary text-white p-4 rounded-4 shadow-sm d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-800 mb-1">Daftarkan Toko ke Event Bazar Mei!</h5>
                    <p class="mb-0 small opacity-75">Tingkatkan penjualan Anda dengan mengikuti event tahunan Kabupaten Tangerang.</p>
                </div>
                <button class="btn btn-light rounded-pill px-4 fw-bold shadow">Ikut Serta</button>
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