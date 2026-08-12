@extends('admin.main.main')

@section('content')
<div class="container pb-5" style="margin-top: 30px;">

    <!-- BREADCRUMB & HEADER -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-3">
                <a href="{{ route('orders.pending') }}" class="text-decoration-none small btn btn-secondary bg-opacity-10 text-white fw-bold d-flex align-items-center gap-1">
                    <i data-lucide="arrow-left" size="14"></i> Kembali ke Pesanan Saya
                </a>
            </div>
            <h4 class="fw-800 text-dark mb-0 d-flex align-items-center gap-2">
                <i data-lucide="file-text" class="text-primary" size="28"></i> Detail Pesanan #{{ $order->invoice_number }}
            </h4>
        </div>
        <div class="d-flex align-items-center gap-2">
            @if($order->payment_status == 'waiting_verification')
                <span class="badge bg-warning-subtle text-warning border border-warning fw-bold px-3 py-2 rounded-pill small d-flex align-items-center gap-1">
                    <i data-lucide="clock" size="14"></i> Menunggu Verifikasi Penjual
                </span>
            @elseif($order->payment_status == 'paid')
                <span class="badge bg-success-subtle text-success border border-success fw-bold px-3 py-2 rounded-pill small d-flex align-items-center gap-1">
                    <i data-lucide="check-circle" size="14"></i> Pembayaran Diverifikasi
                </span>
            @elseif($order->payment_status == 'rejected')
                <span class="badge bg-danger-subtle text-danger border border-danger fw-bold px-3 py-2 rounded-pill small d-flex align-items-center gap-1">
                    <i data-lucide="x-circle" size="14"></i> Pembayaran Ditolak
                </span>
            @else
                <span class="badge bg-secondary-subtle text-secondary fw-bold px-3 py-2 rounded-pill small">
                    Belum Dibayar
                </span>
            @endif
        </div>
    </div>

    <div class="row g-4">
        <!-- KOLOM KIRI: PRODUK & BUKTI BAYAR -->
        <div class="col-lg-8">
            
            <!-- 1. DAFTAR ITEM PRODUK -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <h6 class="fw-800 text-dark mb-3 d-flex align-items-center gap-2 border-bottom pb-3">
                    <i data-lucide="package" class="text-primary" size="20"></i> Produk Yang Dipesan ({{ $order->details->count() }})
                </h6>

                <div class="checkout-items-list">
                    @foreach($order->details as $detail)
                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom {{ $loop->last ? 'border-0 pb-0' : '' }}">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ route('show.thumbnail.produk.private', $detail->produk->produk_thumbnail) }}" 
                                 class="rounded-3 object-fit-cover border" 
                                 width="70" height="70" 
                                 alt="{{ $detail->produk->nama_produk }}">
                            <div>
                                <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-1 rounded-2 smaller mb-1 d-inline-block">
                                    <i data-lucide="store" size="10" class="me-1"></i> {{ $detail->vendor->nama_toko ?? 'UMKM Lokal' }}
                                </span>
                                <h6 class="fw-bold text-dark mb-1 text-truncate" style="max-width: 300px;">{{ $detail->produk->nama_produk }}</h6>
                                <span class="small text-muted">{{ $detail->qty }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="fw-800 text-dark">
                                Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- 2. INFORMASI ALAMAT & PENGIRIMAN -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <h6 class="fw-800 text-dark mb-3 d-flex align-items-center gap-2 border-bottom pb-3">
                    <i data-lucide="map-pin" class="text-primary" size="20"></i> Informasi Pengiriman
                </h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <span class="smaller text-muted d-block mb-1">Metode Pengiriman:</span>
                        <span class="badge bg-light text-dark border fw-bold px-3 py-2 rounded-2 small d-inline-flex align-items-center gap-1">
                            <i data-lucide="truck" size="14" class="text-primary"></i> 
                            {{ $order->shipping_method == 'ditoko' ? 'Ambil Sendiri di Toko' : 'Dikirim oleh Penjual' }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <span class="smaller text-muted d-block mb-1">Tanggal Pesanan:</span>
                        <span class="fw-bold text-dark small d-block">{{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                    </div>
                    <div class="col-12 border-top pt-3">
                        <span class="smaller text-muted d-block mb-1">Penerima & Alamat:</span>
                        <div class="p-3 bg-light rounded-3">
                            <h6 class="fw-bold text-dark mb-1 small">{{ $order->user->name ?? 'Pembeli' }} ({{ $order->user->no_hp ?? '-' }})</h6>
                            <p class="text-muted small mb-0">{{ $order->user->alamat ?? 'Alamat tidak tersedia' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. BUKTI PEMBAYARAN -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h6 class="fw-800 text-dark mb-3 d-flex align-items-center justify-content-between border-bottom pb-3">
                    <span class="d-flex align-items-center gap-2">
                        <i data-lucide="image" class="text-primary" size="20"></i> Bukti Pembayaran
                    </span>
                    @if(!$order->bukti_pembayaran)
                        <a href="{{ route('frontend.payment.instruction', $order->invoice_number) }}" class="btn btn-sm btn-warning fw-bold rounded-2">
                            Upload Bukti Sekarang
                        </a>
                    @endif
                </h6>

                @if($order->bukti_pembayaran)
                    <div class="row align-items-center g-3">
                        <div class="col-md-5 text-center">
                            <a href="{{ route('show.thumbnail.produk.private', $order->bukti_pembayaran) }}" target="_blank">
                                <img src="{{ route('show.thumbnail.produk.private', $order->bukti_pembayaran) }}" class="img-fluid rounded-3 border p-1 bg-light hover-zoom" style="max-height: 220px; object-fit: contain;">
                            </a>
                            <span class="smaller text-muted d-block mt-1">Klik gambar untuk memperbesar</span>
                        </div>
                        <div class="col-md-7">
                            <div class="p-3 rounded-3 bg-light">
                                <span class="smaller text-muted d-block">Metode Bayar:</span>
                                <span class="fw-bold text-dark d-block mb-2 text-uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                                
                                <span class="smaller text-muted d-block">Status Verifikasi:</span>
                                <p class="small mb-0 text-muted">
                                    @if($order->payment_status == 'waiting_verification')
                                        Bukti pembayaran telah berhasil dikirim. Penjual sedang memverifikasi keabsahan dana yang ditransfer.
                                    @elseif($order->payment_status == 'paid')
                                        Pembayaran telah diverifikasi oleh penjual. Pesanan Anda sedang diproses.
                                    @else
                                        Bukti pembayaran belum terverifikasi.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i data-lucide="alert-circle" size="36" class="text-warning mb-2"></i>
                        <p class="small mb-0">Anda belum mengunggah foto bukti transfer/pembayaran.</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- KOLOM KANAN: RINCIAN TAGIHAN & KARTU BANTUAN -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 110px;">
                <h6 class="fw-800 text-dark mb-3 border-bottom pb-3">Rincian Pembayaran</h6>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Total Harga Produk</span>
                    <span class="small fw-bold text-dark">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="small text-muted">Biaya Pengiriman</span>
                    <span class="small fw-bold text-dark">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>

                <hr class="opacity-50 my-3">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="small fw-bold text-dark d-block">Total Tagihan</span>
                        <span class="smaller text-muted">Termasuk Biaya Layanan</span>
                    </div>
                    <span class="h5 fw-800 text-primary mb-0">
                        Rp {{ number_format($order->total_payment, 0, ',', '.') }}
                    </span>
                </div>

                <!-- BANTUAN HUBUNGI PENJUAL -->
                <div class="p-3 bg-light rounded-3 mb-3 border">
                    <span class="smaller fw-bold text-dark d-block mb-1">Butuh Bantuan Pesanan?</span>
                    <p class="smaller text-muted mb-2">Jika verifikasi memakan waktu lama, Anda dapat menghubungi penjual secara langsung.</p>
                    @php
                        $vendor = $order->details->first()->vendor ?? null;
                    @endphp
                    @if($vendor && isset($vendor->no_hp))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $vendor->no_hp) }}?text=Halo%20{{ urlencode($vendor->nama_toko) }},%20saya%20ingin%20menanyakan%20konfirmasi%20pesanan%20dengan%20Invoice:%20{{ $order->invoice_number }}" 
                           target="_blank" 
                           class="btn btn-sm btn-success w-100 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i data-lucide="message-circle" size="16"></i> Chat WhatsApp Penjual
                        </a>
                    @endif
                </div>

                <a href="{{ route('orders.pending') }}" class="btn btn-outline-secondary w-100 rounded-3 fw-bold small">
                    Kembali ke List Menunggu Konfirmasi
                </a>
            </div>
        </div>
    </div>

</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.72rem; }
    .bg-primary-subtle { background-color: #f3e8ff; }
    .bg-warning-subtle { background-color: #fffbeb; }
    .bg-success-subtle { background-color: #f0fdf4; }
    .bg-danger-subtle { background-color: #fef2f2; }
    .bg-secondary-subtle { background-color: #f1f5f9; }

    .hover-zoom {
        transition: transform 0.2s ease-in-out;
    }
    .hover-zoom:hover {
        transform: scale(1.03);
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