@extends('admin.main.main')

@section('content')

<style>
    body { background-color: #f4f7fe; }
    .admin-wrapper { padding-top: 30px; padding-bottom: 80px; }

    /* Custom Stat Cards */
    .stat-card {
        background: white;
        border-radius: 24px;
        padding: 24px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }
    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Card Panels */
    .panel-card {
        background: white;
        border-radius: 24px;
        padding: 28px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        margin-bottom: 24px;
    }

    /* Custom Table Styling */
    .custom-table {
        margin-bottom: 0;
    }
    .custom-table th {
        background: #f8fafc;
        color: #64748b;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 18px;
        border-bottom: 1px solid #e2e8f0;
    }
    .custom-table td {
        padding: 16px 18px;
        vertical-align: middle;
        color: #1e293b;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9;
    }

    /* User / Store Avatar Mini */
    .avatar-mini {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        object-fit: cover;
    }

    /* Badge Soft */
    .badge-soft-success { background: #dcfce7; color: #15803d; }
    .badge-soft-warning { background: #fef9c3; color: #a16207; }
    .badge-soft-danger  { background: #fee2e2; color: #b91c1c; }
    .badge-soft-primary { background: #e0e7ff; color: #4338ca; }
    .badge-soft-info    { background: #e0f2fe; color: #0369a1; }
</style>

<div class="container-fluid admin-wrapper px-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-800 text-dark mb-1">Dashboard Ringkasan</h3>
            <p class="text-muted small mb-0">Pantau performa platform, aktivitas UMKM, dan transaksi real-time.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-white border rounded-pill px-3 py-2 btn-sm fw-bold bg-white text-secondary shadow-sm">
                <i data-lucide="download" size="16" class="me-1"></i> Ekspor Laporan
            </button>
            <button class="btn btn-primary rounded-pill px-3 py-2 btn-sm fw-bold shadow">
                <i data-lucide="refresh-cw" size="16" class="me-1"></i> Refresh Data
            </button>
        </div>
    </div>

    <!-- 1. STATS OVERVIEW CARDS -->
    <div class="row g-3 mb-4">
        <!-- Total Pendapatan Platform -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-bold d-block mb-1">Total Pendapatan</span>
                        <h4 class="fw-800 text-dark mb-0">Rp {{ number_format($totalRevenue ?? 128500000, 0, ',', '.') }}</h4>
                        <span class="text-success small fw-bold d-inline-flex align-items-center mt-2">
                            <i data-lucide="trending-up" size="14" class="me-1"></i> +12.5% <span class="text-muted font-normal ms-1">bln ini</span>
                        </span>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i data-lucide="wallet" size="26"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Mitra UMKM -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-bold d-block mb-1">Mitra UMKM / Toko</span>
                        <h4 class="fw-800 text-dark mb-0">{{ number_format($totalUmkm ?? 48) }} <span class="fs-6 text-muted font-normal">Toko</span></h4>
                        <span class="badge badge-soft-warning rounded-pill mt-2">
                            {{ $pendingUmkmCount ?? 5 }} Menunggu Verifikasi
                        </span>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i data-lucide="store" size="26"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Produk Aktif -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-bold d-block mb-1">Produk Terdaftar</span>
                        <h4 class="fw-800 text-dark mb-0">{{ number_format($totalProducts ?? 342) }} <span class="fs-6 text-muted font-normal">Item</span></h4>
                        <span class="text-muted small fw-bold d-block mt-2">
                            <i data-lucide="check-circle-2" size="14" class="text-success me-1"></i> Active Catalogue
                        </span>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i data-lucide="package" size="26"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi Selesai -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-bold d-block mb-1">Total Pesanan</span>
                        <h4 class="fw-800 text-dark mb-0">{{ number_format($totalOrders ?? 1204) }}</h4>
                        <span class="text-info small fw-bold d-inline-flex align-items-center mt-2">
                            <i data-lucide="shopping-bag" size="14" class="me-1"></i> {{ $pendingOrdersCount ?? 18 }} Perlu Diproses
                        </span>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i data-lucide="shopping-cart" size="26"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. GRAFIK PENJUALAN & PERSETUJUAN UMKM -->
    <div class="row g-4 mb-4">
        <!-- Chart Grafik Omset -->
        <div class="col-xl-8">
            <div class="panel-card h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Grafik Penjualan Platform</h5>
                        <p class="text-muted small mb-0">Tren pendapatan kotor bulanan seluruh UMKM</p>
                    </div>
                    <select class="form-select form-select-sm rounded-pill w-auto border-light bg-light">
                        <option value="2026">Tahun 2026</option>
                        <option value="2025">Tahun 2025</option>
                    </select>
                </div>
                <div style="height: 300px;">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Persetujuan Toko UMKM Baru (Pending Approvals) -->
        <div class="col-xl-4">
            <div class="panel-card h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold text-dark mb-0">Pendaftaran UMKM</h5>
                    <a href="#" class="text-primary small fw-bold text-decoration-none">Lihat Semua</a>
                </div>
                <p class="text-muted small mb-3">Verifikasi toko baru yang mengajukan pendaftaran.</p>

                <div class="d-flex flex-column gap-3">
                    <!-- Item Pengajuan 1 -->
                    <div class="p-3 bg-light rounded-20 d-flex align-items-center justify-content-between border">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon bg-white text-primary border shadow-sm">
                                <i data-lucide="store" size="20"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">Batik Craft Tangerang</h6>
                                <span class="text-muted smaller">Pemilik: Ahmad Fauzi</span>
                            </div>
                        </div>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-success rounded-circle p-2" title="Setujui">
                                <i data-lucide="check" size="14"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger rounded-circle p-2" title="Tolak">
                                <i data-lucide="x" size="14"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Item Pengajuan 2 -->
                    <div class="p-3 bg-light rounded-20 d-flex align-items-center justify-content-between border">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon bg-white text-primary border shadow-sm">
                                <i data-lucide="store" size="20"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">Sepatu Kulit Asli Cisadane</h6>
                                <span class="text-muted smaller">Pemilik: Siti Rahma</span>
                            </div>
                        </div>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-success rounded-circle p-2" title="Setujui">
                                <i data-lucide="check" size="14"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger rounded-circle p-2" title="Tolak">
                                <i data-lucide="x" size="14"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Item Pengajuan 3 -->
                    <div class="p-3 bg-light rounded-20 d-flex align-items-center justify-content-between border">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon bg-white text-primary border shadow-sm">
                                <i data-lucide="store" size="20"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">Kerajinan Bambu Benteng</h6>
                                <span class="text-muted smaller">Pemilik: Budi Santoso</span>
                            </div>
                        </div>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-success rounded-circle p-2" title="Setujui">
                                <i data-lucide="check" size="14"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger rounded-circle p-2" title="Tolak">
                                <i data-lucide="x" size="14"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. TABEL TRANSAKSI TERBARU -->
    <div class="panel-card">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h5 class="fw-bold text-dark mb-0">Transaksi Terbaru</h5>
                <p class="text-muted small mb-0">Daftar pesanan yang baru masuk di seluruh toko</p>
            </div>
            <a href="#" class="btn btn-light rounded-pill btn-sm px-3 fw-bold border text-secondary">
                Kelola Semua Pesanan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th>Invoice / Order ID</th>
                        <th>Pelanggan</th>
                        <th>Toko / UMKM</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pesanan</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td class="fw-bold text-primary">#INV-20260328-01</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=Budi+Pratama&background=4361ee&color=fff" class="avatar-mini" alt="User">
                                <div>
                                    <span class="fw-bold d-block mb-0">Budi Pratama</span>
                                    <span class="text-muted smaller">budi@gmail.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="fw-semibold">Sepatu Batik Tangerang</td>
                        <td class="fw-bold">Rp 350.000</td>
                        <td><span class="badge badge-soft-success px-3 py-2 rounded-pill">Selesai</span></td>
                        <td class="text-muted small">28 Mar 2026</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light border rounded-circle p-2 text-secondary" title="Detail">
                                <i data-lucide="eye" size="16"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr>
                        <td class="fw-bold text-primary">#INV-20260328-02</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=Dina+Larasati&background=e11d48&color=fff" class="avatar-mini" alt="User">
                                <div>
                                    <span class="fw-bold d-block mb-0">Dina Larasati</span>
                                    <span class="text-muted smaller">dina@gmail.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="fw-semibold">Tenun Ikat Benteng</td>
                        <td class="fw-bold">Rp 520.000</td>
                        <td><span class="badge badge-soft-primary px-3 py-2 rounded-pill">Dikirim</span></td>
                        <td class="text-muted small">28 Mar 2026</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light border rounded-circle p-2 text-secondary" title="Detail">
                                <i data-lucide="eye" size="16"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td class="fw-bold text-primary">#INV-20260328-03</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=Rian+Hidayat&background=059669&color=fff" class="avatar-mini" alt="User">
                                <div>
                                    <span class="fw-bold d-block mb-0">Rian Hidayat</span>
                                    <span class="text-muted smaller">rian@gmail.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="fw-semibold">Kulit Artisanal Tangerang</td>
                        <td class="fw-bold">Rp 1.200.000</td>
                        <td><span class="badge badge-soft-warning px-3 py-2 rounded-pill">Menunggu Pembayaran</span></td>
                        <td class="text-muted small">28 Mar 2026</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light border rounded-circle p-2 text-secondary" title="Detail">
                                <i data-lucide="eye" size="16"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<!-- Library Chart.js untuk Grafik -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Configuration Grafik Penjualan (Chart.js)
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(67, 97, 238, 0.25)');
        gradient.addColorStop(1, 'rgba(67, 97, 238, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [12000000, 19000000, 15000000, 25000000, 22000000, 30000000, 28000000, 35000000, 40000000, 38000000, 45000000, 50000000],
                    borderColor: '#4361ee',
                    borderWidth: 3,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#4361ee'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        grid: { color: '#f1f5f9' },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + ' Jt';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush