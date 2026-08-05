@extends('admin.main.main')

@section('content')
<div class="container pb-5" style="margin-top: 110px;">

    <!-- HEADER / BREADCRUMB -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-800 text-dark mb-1 d-flex align-items-center gap-2">
                <i data-lucide="clock" class="text-primary" size="28"></i> Menunggu Konfirmasi Penjual
            </h4>
            <p class="text-muted small mb-0">Daftar pesanan Anda yang sedang ditinjau dan diverifikasi oleh penjual/UMKM.</p>
        </div>
        <div>
            <a href="{{ route('user.dashboard') ?? '#' }}" class="btn btn-white border rounded-pill px-3 fw-bold shadow-sm small text-dark d-flex align-items-center gap-1">
                <i data-lucide="layout-dashboard" size="16"></i> Dashboard
            </a>
        </div>
    </div>

    <!-- FLASH MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i data-lucide="check-circle" size="18" class="me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- LIST PESANAN -->
    @if($orders->isEmpty())
        <div class="card border-0 shadow-sm rounded-4 p-5 bg-white text-center">
            <i data-lucide="package-x" size="48" class="text-muted opacity-50 mx-auto mb-3"></i>
            <h6 class="fw-bold text-dark mb-1">Tidak ada pesanan yang menunggu konfirmasi</h6>
            <p class="text-muted small mb-4">Semua pesanan Anda telah dikonfirmasi atau Anda belum melakukan pemesanan baru.</p>
            <div>
                <a href="{{ url('/') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm small">
                    Mulai Belanja Now
                </a>
            </div>
        </div>
    @else
        <div class="d-flex flex-column gap-3">
            @foreach($orders as $order)
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                    
                    <!-- ORDER HEADER -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill small">
                                {{ $order->invoice_number }}
                            </span>
                            <span class="small text-muted">
                                <i data-lucide="calendar" size="14" class="me-1"></i> {{ $order->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                        <div>
                            @if($order->payment_status == 'waiting_verification')
                                <span class="badge bg-warning-subtle text-warning border border-warning fw-bold px-3 py-2 rounded-pill small d-flex align-items-center gap-1">
                                    <i data-lucide="loader" size="14" class="spin"></i> Menunggu Verifikasi Penjual
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary fw-bold px-3 py-2 rounded-pill small">
                                    Menunggu Bukti Transfer
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- ORDER ITEMS -->
                    <div class="checkout-items-list mb-3">
                        @foreach($order->details as $detail)
                            <div class="d-flex align-items-center justify-content-between py-2 border-bottom {{ $loop->last ? 'border-0' : '' }}">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ route('show.thumbnail.produk.private', $detail->produk->produk_thumbnail) }}" 
                                         class="rounded-3 object-fit-cover border" 
                                         width="60" height="60" 
                                         alt="{{ $detail->produk->nama_produk }}">
                                    <div>
                                        <span class="badge bg-light text-muted fw-bold px-2 py-1 rounded-2 smaller mb-1 d-inline-block border">
                                            <i data-lucide="store" size="10" class="me-1"></i> {{ $detail->vendor->nama_toko ?? 'UMKM' }}
                                        </span>
                                        <h6 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 320px;">
                                            {{ $detail->produk->nama_produk }}
                                        </h6>
                                        <span class="small text-muted">
                                            {{ $detail->qty }} x Rp {{ number_format($detail->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold text-dark small">
                                        Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- ORDER FOOTER / ACTION -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between pt-3 border-top gap-3">
                        <div>
                            <span class="smaller text-muted d-block">Total Pembayaran</span>
                            <span class="h6 fw-800 text-primary mb-0">
                                Rp {{ number_format($order->total_payment, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-flex gap-2">
                            <!-- Tombol Bayar jika belum upload -->
                            @if(!$order->bukti_pembayaran)
                                <a href="{{ route('frontend.payment.instruction', $order->invoice_number) }}" class="btn btn-warning rounded-3 fw-bold small shadow-sm text-dark d-flex align-items-center gap-1">
                                    <i data-lucide="upload-cloud" size="16"></i> Upload Bukti Bayar
                                </a>
                            @else
                                <a href="{{ route('frontend.payment.instruction', $order->invoice_number) }}" class="btn btn-light rounded-3 fw-bold small border text-dark d-flex align-items-center gap-1">
                                    <i data-lucide="eye" size="16"></i> Lihat Bukti Bayar
                                </a>
                            @endif

                            <a href="{{ route('orders.show', $order->invoice_number) }}" class="btn btn-outline-primary rounded-3 fw-bold small d-flex align-items-center gap-1">
                                <i data-lucide="file-text" size="16"></i> Detail Pesanan
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    @endif

</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.72rem; }
    .btn-white { background: white; }

    .bg-primary-subtle { background-color: #f3e8ff; }
    .bg-warning-subtle { background-color: #fffbeb; }
    .bg-secondary-subtle { background-color: #f1f5f9; }

    .spin {
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection