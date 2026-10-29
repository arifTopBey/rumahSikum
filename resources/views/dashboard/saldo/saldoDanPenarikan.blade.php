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
                    <a href="#" class="nav-dash-link active"><i data-lucide="wallet" size="18"></i> Saldo & Penarikan</a>
                    <a href="#" class="nav-dash-link"><i data-lucide="megaphone" size="18"></i> Promosi Toko</a>
                    <hr class="my-3 opacity-50">
                    <a href="#" class="nav-dash-link"><i data-lucide="settings" size="18"></i> Pengaturan Toko</a>
                    <a href="#" class="nav-dash-link text-danger"><i data-lucide="log-out" size="18"></i> Keluar Seller</a>
                </nav>
            </div>
        </div>

        <div class="col-lg-9 px-4 py-4 bg-light">
            <div class="mb-4">
                <h4 class="fw-800 mb-1 text-dark">Saldo & Penarikan</h4>
                <p class="text-muted small mb-0">Kelola penghasilan Anda dan cairkan dana ke rekening bank.</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-7">
                    <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <p class="small opacity-75 mb-1">Saldo Tersedia</p>
                                <h2 class="fw-800 mb-0">Rp 8.450.000</h2>
                            </div>
                            <div class="bg-white bg-opacity-20 p-2 rounded-3">
                                <i data-lucide="wallet-2" size="28"></i>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTarikDana">
                                Tarik Dana Sekarang
                            </button>
                            <button class="btn btn-primary border-white border-opacity-25 rounded-pill px-4 fw-bold">
                                Riwayat Penarikan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <h6 class="fw-800 mb-3 text-dark">Rekening Bank Utama</h6>
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                            <div class="bg-white p-2 rounded-2 border">
                                <i data-lucide="building-2" class="text-primary"></i>
                            </div>
                            <div>
                                <p class="fw-bold mb-0 small">Bank Central Asia (BCA)</p>
                                <p class="text-muted smaller mb-0">8820 **** 4412 a/n Batik Jaya</p>
                            </div>
                        </div>
                        <button class="btn btn-link text-decoration-none smaller fw-bold mt-2 ps-0">Ubah Rekening</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-4 shadow-sm border overflow-hidden">
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="fw-800 m-0">Mutasi Saldo</h5>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm rounded-pill px-3">
                            <option>Semua Transaksi</option>
                            <option>Penghasilan</option>
                            <option>Penarikan</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <tbody>
                            <tr class="border-bottom">
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-success-subtle text-success p-2 rounded-circle">
                                            <i data-lucide="arrow-down-left" size="18"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0 small">Penjualan Selesai #RS-8821</h6>
                                            <span class="smaller text-muted">12 Apr 2026, 14:20</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <span class="fw-800 text-success">+ Rp 245.000</span>
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary-subtle text-primary p-2 rounded-circle">
                                            <i data-lucide="external-link" size="18"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0 small">Penarikan Dana ke BCA</h6>
                                            <span class="smaller text-muted">10 Apr 2026, 09:00</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <span class="fw-800 text-danger">- Rp 5.000.000</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-3 text-center bg-light">
                    <a href="#" class="smaller fw-bold text-decoration-none">Lihat Semua Mutasi</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTarikDana" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body p-4 text-center">
                <h5 class="fw-800 mb-3">Tarik Dana Ke Rekening</h5>
                <p class="text-muted smaller mb-4">Dana akan dikirim ke rekening BCA Anda dalam 1x24 jam kerja.</p>
                <div class="mb-4">
                    <label class="small fw-bold text-muted d-block text-start mb-2">Jumlah Penarikan (Rp)</label>
                    <input type="number" class="form-control form-control-lg rounded-3 fw-bold" placeholder="Min. Rp 50.000">
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-light w-100 rounded-pill fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary w-100 rounded-pill fw-bold">Konfirmasi</button>
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