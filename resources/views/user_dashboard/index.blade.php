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

    .user-wrapper {
        margin-top: 50px;
        margin-bottom: 80px;
    }

    /* Stat & Status Cards */
    .stat-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 22px;
        border: 1px solid #edf2f7;
        transition: all 0.3s ease;
        height: 100%;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05) !important;
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .bg-soft-orange { background: var(--warning-soft); color: var(--warning-color); }
    .bg-soft-blue { background: var(--primary-soft); color: var(--primary-color); }
    .bg-soft-cyan { background: var(--info-soft); color: var(--info-color); }
    .bg-soft-green { background: var(--success-soft); color: var(--success-color); }

    /* Main Container Card */
    .dashboard-card {
        background: var(--card-bg);
        border-radius: 24px;
        padding: 28px;
        border: 1px solid #edf2f7;
    }

    /* Custom Table */
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

    /* Status Badges */
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

    /* Product Thumbnail */
    .product-img-thumb {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        object-fit: cover;
    }

    /* Profile Summary Card */
    .profile-card {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        border-radius: 24px;
        padding: 28px;
        color: white;
    }
    .profile-avatar {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 800;
        border: 2px solid rgba(255, 255, 255, 0.4);
    }
</style>

<div class="container user-wrapper">
    <div class="row g-4">
        
        <!-- WELCOME HEADER -->
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h4 class="fw-800 text-dark mb-1">Selamat Datang, {{ auth()->user()->name }} 👋</h4>
                    <p class="text-muted small mb-0">Pantau status belanja dan kelola pesanan produk UMKM Anda di sini.</p>
                </div>
                <div>
                    <a href="{{ url('/') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                        <i data-lucide="shopping-bag" size="18"></i> Mulai Belanja
                    </a>
                </div>
            </div>
        </div>

        <!-- TRACKING STATUS BELANJA (QUICK STATS) -->
        <div class="col-12">
            <div class="row g-3">
                
                <!-- MENUNGGU PEMBAYARAN -->
                <div class="col-6 col-lg-3">
                    <a href="{{ route('user.orders.index', ['status' => 'pending']) }}" class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-orange">
                            <i data-lucide="credit-card" size="22"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0 fw-semibold">Belum Bayar</p>
                            <h5 class="fw-800 text-dark mb-0">{{ $countPending ?? 0 }}</h5>
                        </div>
                    </a>
                </div>

                <!-- PERLU DIKIMAS / DIPROSES -->
                <div class="col-6 col-lg-3">
                    <a href="{{ route('user.orders.index', ['status' => 'diproses']) }}" class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-blue">
                            <i data-lucide="package" size="22"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0 fw-semibold">Sedang Dikemas</p>
                            <h5 class="fw-800 text-dark mb-0">{{ $countDiproses ?? 0 }}</h5>
                        </div>
                    </a>
                </div>

                <!-- DALAM PENGIRIMAN -->
                <div class="col-6 col-lg-3">
                    <a href="{{ route('user.orders.index', ['status' => 'dikirim']) }}" class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-cyan">
                            <i data-lucide="truck" size="22"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0 fw-semibold">Dalam Pengiriman</p>
                            <h5 class="fw-800 text-dark mb-0">{{ $countDikirim ?? 0 }}</h5>
                        </div>
                    </a>
                </div>

                <!-- PESANAN SELESAI -->
                <div class="col-6 col-lg-3">
                    <a href="{{ route('user.orders.index', ['status' => 'selesai']) }}" class="stat-card shadow-sm">
                        <div class="stat-icon bg-soft-green">
                            <i data-lucide="check-circle-2" size="22"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0 fw-semibold">Selesai</p>
                            <h5 class="fw-800 text-dark mb-0">{{ $countSelesai ?? 0 }}</h5>
                        </div>
                    </a>
                </div>

            </div>
        </div>

        <!-- LEFT COLUMN: RECENT ORDERS -->
        <div class="col-lg-8">
            <div class="dashboard-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-800 text-dark m-0">Pesanan Terakhir Anda</h5>
                        <p class="text-muted smaller mb-0">Riwayat transaksi belanja terbaru milik Anda.</p>
                    </div>
                    <a href="{{ route('user.orders.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-bold text-primary">
                        Lihat Semua <i data-lucide="arrow-right" size="14" class="ms-1"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Produk</th>
                                <th>Total Total</th>
                                <th>Status</th>
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
                                        <span class="d-block text-muted smaller fw-normal">{{ $order->created_at->format('d M Y') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($firstDetail && $firstDetail->produk)
                                                <img src="{{ route('show.thumbnail.produk.private', $firstDetail->produk->produk_thumbnail) }}" 
                                                     class="product-img-thumb border" 
                                                     alt="{{ $firstDetail->produk->nama_produk }}">
                                                <div>
                                                    <span class="fw-bold text-dark d-block text-truncate" style="max-width: 180px;">
                                                        {{ $firstDetail->produk->nama_produk }}
                                                    </span>
                                                    @if($order->details->count() > 1)
                                                        <span class="badge bg-light text-muted border smaller">+{{ $order->details->count() - 1 }} produk</span>
                                                    @else
                                                        <span class="text-muted smaller">{{ $firstDetail->qty }} pcs</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted small">Item produk</span>
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
                                            <span class="badge-status badge-process">Verifikasi</span>
                                        @elseif($order->order_status == 'diproses')
                                            <span class="badge-status badge-process">Dikemas</span>
                                        @elseif($order->order_status == 'dikirim')
                                            <span class="badge-status badge-shipping">Dikirim</span>
                                        @elseif($order->order_status == 'selesai')
                                            <span class="badge-status badge-done">Selesai</span>
                                        @elseif($order->order_status == 'batal')
                                            <span class="badge-status badge-cancel">Batal</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($order->order_status == 'dikirim')
                                            <a href="{{ route('user.orders.confirm_receipt', $order->invoice_number) }}" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                                Konfirmasi
                                            </a>
                                        @else
                                            <a href="{{ route('user.orders.detail_pesanan', $order->invoice_number) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                                Detail
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i data-lucide="shopping-cart" size="40" class="text-muted opacity-50 mb-2 mx-auto"></i>
                                        <h6 class="fw-bold text-muted mb-1">Belum ada transaksi belanja</h6>
                                        <p class="small text-muted mb-3">Jelajahi produk lokal menarik dan buat pesanan pertama Anda!</p>
                                        <a href="{{ url('/') }}" class="btn btn-sm btn-primary rounded-pill px-4 fw-bold">Mulai Belanja</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: USER PROFILE SUMMARY & QUICK INFO -->
        <div class="col-lg-4">
            
            <!-- PROFILE CARD -->
            <div class="profile-card shadow-sm mb-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="profile-avatar text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="fw-800 mb-0 text-white">{{ auth()->user()->name }}</h6>
                        <span class="small opacity-75">{{ auth()->user()->email }}</span>
                    </div>
                </div>
                <hr class="opacity-25 my-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="smaller opacity-75 d-block">Nomor Telepon:</span>
                        <span class="small fw-bold">{{ auth()->user()->no_hp ?? '-' }}</span>
                    </div>
                    {{-- Ganti rute profil sesuai yang Anda miliki --}}
                    
                </div>
            </div>

            <!-- SHIPPING ADDRESS SUMMARY CARD -->
            <div class="dashboard-card shadow-sm">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-800 text-dark mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="map-pin" class="text-primary" size="18"></i> Alamat Pengiriman
                    </h6>
                </div>
                <div class="p-3 bg-light rounded-4 border mb-0">
                    <p class="small text-muted mb-0">
                        {{ auth()->user()->alamat ?? 'Anda belum mengatur alamat pengiriman utama.' }}
                    </p>
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
