@extends('admin.main.main') 

@section('content')

<style>
    :root {
        --primary-color: #4361ee;
        --primary-soft: #e0e7ff;
        --success-color: #10b981;
        --success-soft: #d1fae5;
        --warning-color: #f59e0b;
        --warning-soft: #fef3c7;
        --info-color: #06b6d4;
        --info-soft: #cff4fc;
        --card-bg: #ffffff;
        --body-bg: #f4f7fe;
    }

    body {
        background-color: var(--body-bg);
    }

    /* Stat Cards */
    .stat-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 22px 24px;
        border: 1px solid #edf2f7;
        transition: all 0.3s ease;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05) !important;
    }
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    /* Icon Color Themes */
    .bg-soft-blue { background: var(--primary-soft); color: var(--primary-color); }
    .bg-soft-green { background: var(--success-soft); color: var(--success-color); }
    .bg-soft-orange { background: var(--warning-soft); color: var(--warning-color); }
    .bg-soft-info { background: var(--info-soft); color: var(--info-color); }

    /* Table Container */
    .table-container {
        background: var(--card-bg);
        border-radius: 24px;
        padding: 28px;
        border: 1px solid #edf2f7;
    }

    .custom-table {
        margin-bottom: 0;
    }
    .custom-table thead th {
        background: #f8fafc;
        border: none;
        padding: 14px 18px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
    }
    .custom-table tbody td {
        padding: 16px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.875rem;
    }
    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .badge-status {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .badge-pending { background: #fee2e2; color: #dc2626; }
    .badge-process { background: var(--warning-soft); color: #d97706; }
    .badge-shipping { background: var(--primary-soft); color: var(--primary-color); }
    .badge-done { background: var(--success-soft); color: #15803d; }
    .badge-cancel { background: #f3f4f6; color: #4b5563; }

    /* Quick Action Card / Banner */
    .banner-card {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        border-radius: 24px;
        padding: 30px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .banner-card::before {
        content: '';
        position: absolute;
        top: -20%;
        right: -10%;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
    }

    /* Product Avatar */
    .product-img-thumb {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        object-fit: cover;
    }
</style>

<div class="py-4 px-2 px-md-4">
    <div class="row g-4">
        <div class="col-12">
            
            <!-- WELCOME HEADER -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h4 class="fw-800 text-dark mb-1">Halo, {{ auth()->user()->name ?? 'Mitra UMKM' }} 👋</h4>
                    <p class="text-muted small mb-0">Berikut adalah ringkasan penjualan & performa toko Anda hari ini.</p>
                </div>
                <div>
                    <a href="{{ route('vendor.orders.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                        <i data-lucide="package" size="18"></i> Kelola Pesanan
                    </a>
                </div>
            </div>

            <!-- STATISTIC CARDS -->
            <div class="row g-3 mb-4">
                <!-- TOTAL PENDAPATAN -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card shadow-sm d-flex align-items-center gap-3">
                        <div class="stat-icon bg-soft-blue">
                            <i data-lucide="wallet" size="24"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Total Pendapatan</p>
                            <h5 class="fw-800 mb-0 text-dark">
                                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- PESANAN PERLU DIKEMAS -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card shadow-sm d-flex align-items-center gap-3">
                        <div class="stat-icon bg-soft-orange">
                            <i data-lucide="clock" size="24"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Perlu Dikemas</p>
                            <h5 class="fw-800 mb-0 text-dark">
                                {{ $pesananPending ?? 0 }} <span class="fs-6 text-muted fw-normal">Pesanan</span>
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- PESANAN SELESAI -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card shadow-sm d-flex align-items-center gap-3">
                        <div class="stat-icon bg-soft-green">
                            <i data-lucide="check-circle-2" size="24"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Pesanan Selesai</p>
                            <h5 class="fw-800 mb-0 text-dark">
                                {{ $pesananSelesai ?? 0 }} <span class="fs-6 text-muted fw-normal">Pesanan</span>
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- TOTAL PRODUK -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card shadow-sm d-flex align-items-center gap-3">
                        <div class="stat-icon bg-soft-info">
                            <i data-lucide="box" size="24"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Total Produk</p>
                            <h5 class="fw-800 mb-0 text-dark">
                                {{ $totalProduk ?? 0 }} <span class="fs-6 text-muted fw-normal">Item</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RECENT ORDERS TABLE & PROMO BANNER -->
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="table-container shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-800 text-dark m-0">Pesanan Terbaru Masuk</h5>
                                <p class="text-muted smaller mb-0">Transaksi terkini dari para pembeli toko Anda.</p>
                            </div>
                            <a href="{{ route('vendor.orders.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-bold text-primary">
                                Lihat Semua <i data-lucide="arrow-right" size="14" class="ms-1"></i>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th>No. Invoice</th>
                                        <th>Pembeli</th>
                                        <th>Produk Utama</th>
                                        <th>Total Pembayaran</th>
                                        <th>Status Pesanan</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders ?? [] as $order)
                                        @php
                                            $firstDetail = $order->details->first();
                                        @endphp
                                        <tr>
                                            <td class="fw-bold text-dark">
                                                #{{ $order->invoice_number }}
                                                <span class="d-block text-muted smaller fw-normal">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark d-block">{{ $order->user->name ?? 'Pembeli' }}</span>
                                                <span class="text-muted smaller">{{ $order->user->no_hp ?? '-' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @if($firstDetail && $firstDetail->produk)
                                                        <img src="{{ route('show.thumbnail.produk.private', $firstDetail->produk->produk_thumbnail) }}" 
                                                             class="product-img-thumb border" 
                                                             alt="{{ $firstDetail->produk->nama_produk }}">
                                                        <div>
                                                            <span class="fw-bold text-dark d-block text-truncate" style="max-width: 200px;">
                                                                {{ $firstDetail->produk->nama_produk }}
                                                            </span>
                                                            @if($order->details->count() > 1)
                                                                <span class="badge bg-light text-muted border smaller">+{{ $order->details->count() - 1 }} produk lainnya</span>
                                                            @else
                                                                <span class="text-muted smaller">{{ $firstDetail->qty }} pcs</span>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <span class="text-muted small">Detail produk tidak ditemukan</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="fw-800 text-dark">
                                                Rp {{ number_format($order->total_payment, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                @if($order->payment_status == 'pending')
                                                    <span class="badge-status badge-pending">Belum Bayar</span>
                                                @elseif($order->payment_status == 'waiting_verification')
                                                    <span class="badge-status badge-process">Verifikasi Bayar</span>
                                                @elseif($order->order_status == 'diproses')
                                                    <span class="badge-status badge-process">Perlu Dikemas</span>
                                                @elseif($order->order_status == 'dikirim')
                                                    <span class="badge-status badge-shipping">Sedang Dikirim</span>
                                                @elseif($order->order_status == 'selesai')
                                                    <span class="badge-status badge-done">Selesai</span>
                                                @elseif($order->order_status == 'batal')
                                                    <span class="badge-status badge-cancel">Dibatalkan</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('vendors.orders.show', $order->invoice_number) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <i data-lucide="package-open" size="40" class="text-muted opacity-50 mb-2"></i>
                                                <h6 class="fw-bold text-muted mb-0">Belum ada pesanan terbaru</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- BANNER BAZAR / PROMO EVENT (OPTIONAL) -->
                <div class="col-12">
                    <div class="banner-card shadow-sm d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <span class="badge bg-white text-primary fw-bold px-3 py-1 rounded-pill mb-2">Program Mitra UMKM</span>
                            <h5 class="fw-800 mb-1">Tingkatkan Penjualan Produk UMKM Anda!</h5>
                            <p class="mb-0 small opacity-75">Pastikan stok produk selalu diperbarui dan respon pesanan tepat waktu untuk meningkatkan rating toko Anda.</p>
                        </div>
                        <a href="#" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-primary shadow-sm flex-shrink-0">
                            Kelola Stok Produk
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection
