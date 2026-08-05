@extends('frontend.main.index')

@section('content')
<div class="container pb-5" style="margin-top: 110px;">

    <!-- HEADER -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-800 text-dark mb-1 d-flex align-items-center gap-2">
                <i data-lucide="credit-card" class="text-primary" size="28"></i> Pembayaran Pesanan
            </h4>
            <p class="text-muted small mb-0">Selesaikan pembayaran Anda sesuai dengan metode yang Anda pilih.</p>
        </div>
        <span class="badge bg-warning-subtle text-warning fw-bold px-3 py-2 rounded-pill border border-warning">
            Invoice: {{ $order->invoice_number }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i data-lucide="check-circle" class="me-2" size="20"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- KOLOM KIRI: REKENING VENDOR / QRIS -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <h6 class="fw-800 text-dark mb-3 border-bottom pb-3 d-flex align-items-center gap-2">
                    @if($order->payment_method == 'qris')
                        <i data-lucide="qr-code" class="text-primary" size="20"></i> Scan Kode QRIS Vendor
                    @else
                        <i data-lucide="landmark" class="text-primary" size="20"></i> Rekening Transfer Bank Vendor
                    @endif
                </h6>

                @if($paymentMethods->isEmpty())
                    <div class="alert alert-danger rounded-3 small">
                        Penjual belum mendaftarkan informasi pembayaran untuk opsi ini. Silakan hubungi penjual/admin.
                    </div>
                @else
                    @foreach($paymentMethods as $pm)
                        @if($order->payment_method == 'qris')
                            <!-- METODE QRIS -->
                            <div class="text-center py-3">
                                <span class="fw-bold text-dark d-block mb-2">{{ $pm->nama_qris }}</span>
                                <img src="{{ route('show.thumbnail.produk.private', $pm->gambar_qris) }}" alt="QRIS" class="img-fluid rounded-3 border p-2 bg-white shadow-sm" style="max-height: 250px;">
                                <!-- <img src="{{ asset('storage/' . $pm->gambar_qris) }}" alt="QRIS" class="img-fluid rounded-3 border p-2 bg-white shadow-sm" style="max-height: 250px;"> -->
                                <p class="smaller text-muted mt-3 mb-0">Buka aplikasi e-wallet / m-banking Anda lalu scan kode QRIS di atas.</p>
                            </div>
                        @else
                            <!-- METODE TRANSFER BANK -->
                            <div class="p-3 border rounded-3 bg-light mb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-800 text-dark">{{ $pm->nama_bank }}</span>
                                    @if($pm->logo_bank)
                                        <img src="{{ asset('storage/' . $pm->logo_bank) }}" height="24">
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <span class="smaller text-muted d-block">Nomor Rekening:</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-800 text-primary fs-5 font-monospace" id="rek-{{ $pm->id }}">{{ $pm->nomor_rekening }}</span>
                                        <button class="btn btn-sm btn-outline-secondary py-0 px-2 rounded-2 smaller" onclick="copyToClipboard('rek-{{ $pm->id }}')">
                                            <i data-lucide="copy" size="12"></i> Salin
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <span class="smaller text-muted d-block">Atas Nama:</span>
                                    <span class="fw-bold text-dark small">{{ $pm->nama_pemilik }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <!-- FORM UPLOAD BUKTI PEMBAYARAN -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h6 class="fw-800 text-dark mb-3 border-bottom pb-3 d-flex align-items-center gap-2">
                    <i data-lucide="upload-cloud" class="text-primary" size="20"></i> Upload Bukti Pembayaran
                </h6>

                @if($order->bukti_pembayaran)
                    <div class="text-center py-3">
                        <span class="badge bg-success-subtle text-success fw-bold px-3 py-2 rounded-pill mb-3">Bukti Pembayaran Sudah Diunggah</span>
                        <div>
                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" class="img-fluid rounded-3 border" style="max-height: 200px;">
                        </div>
                        <p class="smaller text-muted mt-2">Penjual sedang memverifikasi pembayaran Anda.</p>
                    </div>
                @else
                    <form action="{{ route('frontend.payment.upload', $order->invoice_number) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Pilih File Bukti Transfer (JPG, PNG, max 2MB)</label>
                            <input type="file" name="bukti_pembayaran" class="form-control form-control-custom" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i data-lucide="send" size="16"></i> Kirim Bukti Pembayaran
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- KOLOM KANAN: RINGKASAN TAGIHAN -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 110px;">
                <h6 class="fw-800 text-dark mb-3 border-bottom pb-3">Rincian Pesanan</h6>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Subtotal Produk</span>
                    <span class="small fw-bold text-dark">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="small text-muted">Ongkos Kirim ({{ ucfirst($order->shipping_method) }})</span>
                    <span class="small fw-bold text-dark">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>

                <hr class="opacity-50 my-3">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="small fw-bold text-dark">Total Nominal Transfer</span>
                    <span class="h5 fw-800 text-primary mb-0">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</span>
                </div>

                <div class="p-3 bg-light rounded-3 text-muted smaller">
                    <i data-lucide="info" size="14" class="me-1 text-primary"></i> Pastikan nominal transfer pas hingga digit terakhir agar proses verifikasi lancar.
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function copyToClipboard(elementId) {
    var text = document.getElementById(elementId).innerText;
    navigator.clipboard.writeText(text);
    alert('Nomor rekening berhasil disalin!');
}
</script>
@endsection