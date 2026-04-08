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
                    <a href="#" class="nav-dash-link d-flex justify-content-between align-items-center">
                        <span class="d-flex align-items-center gap-2"><i data-lucide="shopping-cart" size="18"></i> Pesanan</span>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </a>
                    <a href="#" class="nav-dash-link"><i data-lucide="wallet" size="18"></i> Saldo & Penarikan</a>
                    <a href="#" class="nav-dash-link active"><i data-lucide="megaphone" size="18"></i> Promosi Toko</a>
                    <hr class="my-3 opacity-50">
                    <a href="#" class="nav-dash-link"><i data-lucide="settings" size="18"></i> Pengaturan Toko</a>
                    <a href="#" class="nav-dash-link text-danger"><i data-lucide="log-out" size="18"></i> Keluar Seller</a>
                </nav>
            </div>
        </div>

        <div class="col-lg-9 px-4 py-4 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 mb-1 text-dark">Promosi Toko</h4>
                    <p class="text-muted small mb-0">Tingkatkan penjualan dengan fitur promosi khusus UMKM.</p>
                </div>
                <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                    <i data-lucide="plus-circle" size="18"></i> Buat Promo Baru
                </button>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 bg-white">
                        <div class="bg-soft-blue p-3 rounded-circle d-inline-flex mb-3 mx-auto">
                            <i data-lucide="ticket" class="text-primary" size="32"></i>
                        </div>
                        <h6 class="fw-800">Voucher Toko</h6>
                        <p class="smaller text-muted">Berikan kupon diskon menarik kepada pelanggan setia Anda.</p>
                        <button class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-auto">Pilih</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 bg-white">
                        <div class="bg-soft-orange p-3 rounded-circle d-inline-flex mb-3 mx-auto">
                            <i data-lucide="zap" class="text-warning" size="32"></i>
                        </div>
                        <h6 class="fw-800">Flash Sale UMKM</h6>
                        <p class="smaller text-muted">Ikuti program diskon kilat di halaman utama RumahSikum.</p>
                        <button class="btn btn-outline-warning btn-sm rounded-pill px-4 mt-auto">Daftar</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 bg-white border border-primary border-dashed">
                        <div class="bg-soft-green p-3 rounded-circle d-inline-flex mb-3 mx-auto">
                            <i data-lucide="award" class="text-success" size="32"></i>
                        </div>
                        <h6 class="fw-800">Produk Unggulan</h6>
                        <p class="smaller text-muted">Naikkan posisi produk Anda di hasil pencarian teratas.</p>
                        <button class="btn btn-outline-success btn-sm rounded-pill px-4 mt-auto">Promosikan</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-4 shadow-sm border overflow-hidden">
                <div class="p-4 border-bottom">
                    <h5 class="fw-800 m-0">Promosi Berjalan</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 border-0 small fw-bold text-muted">NAMA PROMO</th>
                                <th class="py-3 border-0 small fw-bold text-muted text-center">PERIODE</th>
                                <th class="py-3 border-0 small fw-bold text-muted text-center">PENGGUNAAN</th>
                                <th class="py-3 border-0 small fw-bold text-muted">STATUS</th>
                                <th class="py-3 border-0 small fw-bold text-muted text-end pe-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom">
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary text-white p-2 rounded-3">
                                            <i data-lucide="percent" size="20"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0 small">Diskon Lebaran Batik</h6>
                                            <span class="smaller text-muted">Tipe: Voucher Belanja</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="smaller fw-bold">10 - 20 Apr 2026</span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold small">24 / 50</span>
                                    <div class="progress mt-1 mx-auto" style="height: 4px; width: 60px;">
                                        <div class="progress-bar" style="width: 48%"></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-2 smaller fw-bold">Berjalan</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-light btn-sm rounded-pill px-3"><i data-lucide="edit-2" size="14"></i></button>
                                    <button class="btn btn-light btn-sm text-danger rounded-pill px-3"><i data-lucide="pause-circle" size="14"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-warning text-white p-2 rounded-3">
                                            <i data-lucide="zap" size="20"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0 small">Flash Sale Ramadhan</h6>
                                            <span class="smaller text-muted">Tipe: Produk Kilat</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="smaller fw-bold">15 Apr 2026</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-muted smaller">—</span>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-2 smaller fw-bold">Terjadwal</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-light btn-sm rounded-pill px-3">Batalkan</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 border border-primary border-opacity-25 bg-primary bg-opacity-10">
                <div class="d-flex gap-3">
                    <i data-lucide="lightbulb" class="text-primary"></i>
                    <div>
                        <h6 class="fw-800 text-primary mb-1">Tips Marketing UMKM</h6>
                        <p class="smaller text-dark mb-0 opacity-75">Toko yang memberikan voucher belanja rata-rata mengalami kenaikan transaksi hingga 35%. Coba buat voucher dengan minimal belanja Rp 100.000!</p>
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