@extends('admin.main.main')

@section('content')
<style>
    body { background-color: #f0f2f5; }
    /* .dashboard-wrapper { margin-top: 100px; margin-bottom: 100px; } */

    /* Sidebar Dashboard */
    /* .sidebar-menu {
        background: white;
        border-radius: 20px;
        padding: 20px;
        height: 100%;
        border: 1px solid #e2e8f0;
    } */
    .nav-dash-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        border-radius: 12px;
        color: #64748b;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 5px;
        transition: 0.3s;
    }
    .nav-dash-link:hover, .nav-dash-link.active {
        background: #4361ee;
        color: white;
    }
    .nav-dash-link.active i { color: white; }

    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .stat-icon {
        width: 55px; height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bg-soft-blue { background: #e0e7ff; color: #4361ee; }
    .bg-soft-green { background: #dcfce7; color: #15803d; }
    .bg-soft-orange { background: #ffedd5; color: #ea580c; }

    /* Recent Orders Table */
    .table-container {
        background: white;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #e2e8f0;
    }
    .table thead th {
        background: #f8fafc;
        border: none;
        padding: 15px;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #64748b;
    }
    .table tbody td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }

    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
    }


</style>


<div class="">
    <div class="row g-4">
        <div class="col-lg-12 mx-auto px-4 py-4">
            <h4 class="fw-800 mb-4 text-dark">Halo, {{ auth()->user()->name }} 👋</h4>
            <!-- <h4 class="fw-800 mb-4 text-dark">Halo, Mitra RumahSikum! 👋</h4> -->

            <!-- seller card -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-blue"><i data-lucide="shopping-bag"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Total Pesanan</p>
                            <h5 class="fw-800 mb-0">Rp 12</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-green"><i data-lucide="shopping-bag"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Pesanan Pending</p>
                            <h5 class="fw-800 mb-0">142 Pesanan</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-orange"><i data-lucide="bookmark-check"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Pesanan Selesai</p>
                            <h5 class="fw-800 mb-0">1 Pesanan</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-orange"><i data-lucide="star"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Review Produk</p>
                            <h5 class="fw-800 mb-0">0</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-green"><i data-lucide="bookmark-plus"></i></div>
                        <div>
                            <p class="text-muted small mb-0">Wishlist Produk</p>
                            <h5 class="fw-800 mb-0">0</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- seller card -->
            <!-- <div class="row g-3 mb-4">
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
            </div> -->

            <div class="table-container shadow-sm mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-800 m-0">Riwayat Pesanan</h5>
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

            <!-- <div class="bg-primary text-white p-4 rounded-4 shadow-sm d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-800 mb-1">Daftarkan Toko ke Event Bazar Mei!</h5>
                    <p class="mb-0 small opacity-75">Tingkatkan penjualan Anda dengan mengikuti event tahunan Kabupaten Tangerang.</p>
                </div>
                <button class="btn btn-light rounded-pill px-4 fw-bold shadow">Ikut Serta</button>
            </div> -->
        </div>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection