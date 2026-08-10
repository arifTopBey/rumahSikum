@extends('admin.main.main')

@section('content')

<style>
    body {
        background-color: #f4f7fe;
    }

    .order-wrapper {
        margin-top: 60px;
        margin-bottom: 100px;
    }

    /* .order-wrapper { margin-top: 120px; margin-bottom: 100px; } */

    /* Tab Status Styling */
    .nav-order {
        background: white;
        border-radius: 20px;
        padding: 10px;
        border: 1px solid #edf2f7;
    }

    .nav-order .nav-link {
        border: none;
        color: #64748b;
        font-weight: 700;
        border-radius: 15px;
        padding: 12px 25px;
        transition: 0.3s;
        text-decoration: none;
        display: block;
    }

    .nav-order .nav-link.active {
        background: #4361ee;
        color: white !important;
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
    }

    /* Order Card */
    .order-card {
        background: white;
        border-radius: 25px;
        padding: 25px;
        border: 1px solid #edf2f7;
        margin-top: 20px;
        transition: 0.3s;
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 1px dashed #e2e8f0;
        margin-bottom: 15px;
    }

    .status-badge {
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
    }

    .status-pending {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-process {
        background: #fef3c7;
        color: #d97706;
    }

    .status-shipping {
        background: #e0e7ff;
        color: #4361ee;
    }

    .status-done {
        background: #dcfce7;
        color: #15803d;
    }

    .status-cancel {
        background: #f3f4f6;
        color: #4b5563;
    }

    .product-img-order {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 15px;
    }

    .btn-detail-order {
        background: #f8fafc;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
    }

    .btn-detail-order:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
</style>

<div class="container order-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h3 class="fw-800 mb-4">Pesanan Saya</h3>

            <!-- TAB FILTER STATUS -->
            <ul class="nav nav-pills nav-order shadow-sm mb-4 d-flex justify-content-between">
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('user.orders.index', ['status' => 'semua']) }}"
                        class="nav-link {{ $status == 'semua' ? 'active' : '' }}">Semua</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('user.orders.index', ['status' => 'belum_bayar']) }}"
                        class="nav-link {{ $status == 'belum_bayar' ? 'active' : '' }}">Belum Bayar</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('user.orders.index', ['status' => 'dikemas']) }}"
                        class="nav-link {{ $status == 'dikemas' ? 'active' : '' }}">Dikemas</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('user.orders.index', ['status' => 'dikirim']) }}"
                        class="nav-link {{ $status == 'dikirim' ? 'active' : '' }}">Dikirim</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a href="{{ route('user.orders.index', ['status' => 'selesai']) }}"
                        class="nav-link {{ $status == 'selesai' ? 'active' : '' }}">Selesai</a>
                </li>
            </ul>

            <!-- LIST DAFTAR PESANAN -->
            <div class="tab-content">
                @forelse($orders as $order)
                @php
                $firstDetail = $order->details->first();
                $totalItemLain = $order->details->count() - 1;
                @endphp

                <div class="order-card shadow-sm">
                    <!-- HEADER CARD -->
                    <div class="order-header">
                        <div class="d-flex align-items-center gap-3">
                            <i data-lucide="shopping-bag" class="text-primary"></i>
                            <div>
                                <span class="small text-muted">No. Pesanan: <b>{{ $order->invoice_number }}</b></span>
                                <p class="small m-0 text-muted">{{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <!-- BADGE STATUS -->
                        @if($order->payment_status == 'pending')
                        <span class="status-badge status-pending">Belum Bayar</span>
                        @elseif($order->payment_status == 'waiting_verification')
                        <span class="status-badge status-process">Menunggu Konfirmasi Penjual</span>
                        @elseif($order->order_status == 'diproses')
                        <span class="status-badge status-process">Sedang Dikemas</span>
                        @elseif($order->order_status == 'dikirim')
                        <span class="status-badge status-shipping">Sedang Dikirim</span>
                        @elseif($order->order_status == 'selesai')
                        <span class="status-badge status-done">Selesai</span>
                        @elseif($order->order_status == 'batal')
                        <span class="status-badge status-cancel">Batal / Ditolak</span>
                        @endif
                    </div>

                    <!-- BODY CARD (ITEM PRODUK PERTAMA) -->
                    <div class="d-flex gap-4 align-items-center">
                        @if($firstDetail && $firstDetail->produk)
                        <img src="{{ route('show.thumbnail.produk.private', $firstDetail->produk->produk_thumbnail) }}"
                            class="product-img-order"
                            alt="{{ $firstDetail->produk->nama_produk }}">

                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">{{ $firstDetail->produk->nama_produk }}</h6>
                            <p class="small text-muted mb-0">{{ $firstDetail->qty }} Barang x Rp {{ number_format($firstDetail->price, 0, ',', '.') }}</p>
                            @if($totalItemLain > 0)
                            <p class="small text-muted mb-0">+ {{ $totalItemLain }} produk lainnya</p>
                            @endif
                        </div>
                        @else
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Rincian produk tidak tersedia</h6>
                        </div>
                        @endif

                        <div class="text-end border-start ps-4">
                            <p class="small text-muted mb-1">Total Belanja</p>
                            <h5 class="fw-800 text-dark mb-0">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</h5>
                        </div>
                    </div>

                    <!-- FOOTER CARD (TOMBOL AKSI) -->
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('user.orders.detail_pesanan', $order->invoice_number) }}" class="btn-detail-order">Detail Transaksi</a>

                        @if($order->payment_status == 'pending')
                        <a href="{{ route('frontend.payment.instruction', $order->invoice_number) }}" class="btn btn-warning rounded-pill px-4 fw-bold">Bayar Sekarang</a>
                        @elseif($order->order_status == 'dikirim')

                             <a href="{{ route('user.orders.confirm_receipt', $order->invoice_number) }}" class="btn btn-success rounded-pill px-4 fw-bold">
                                    <i data-lucide="check-circle" size="16" class="me-1 mt-1"></i>Selesai Diterima & Upload Bukti
                                </a>
                          
                            <button class="btn btn-primary rounded-pill px-4 fw-bold">Lacak Paket</button>
                        @elseif($order->order_status == 'selesai')
                             <a href="{{ route('frontend.ulasan', [$order->id, $order->details->first()->produk_id]) ?? '#' }}" class="btn btn-outline-warning rounded-pill px-4 fw-bold">Beri Ulasan</a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="order-card shadow-sm text-center py-5">
                    <i data-lucide="package-open" size="48" class="text-muted opacity-50 mb-3 mx-auto"></i>
                    <h6 class="fw-bold text-dark mb-1">Tidak ada pesanan</h6>
                    <p class="text-muted small mb-0">Belum ada transaksi pada status ini.</p>
                </div>
                @endforelse

                <!-- PAGINATION -->
                <div class="mt-4">
                    {{ $orders->appends(['status' => $status])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endpush