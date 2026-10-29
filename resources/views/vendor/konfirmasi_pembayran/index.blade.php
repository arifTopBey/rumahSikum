@extends('admin.main.main') 
@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                <i data-lucide="check-square" class="text-primary"></i> Konfirmasi Pembayaran
            </h4>
            <p class="text-muted small mb-0">Verifikasi bukti transfer dari pembeli untuk memproses pesanan.</p>
        </div>
    </div>

    <!-- FLASH MESSAGES -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
            <i data-lucide="check-circle" class="me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
            <i data-lucide="alert-circle" class="me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TABLE LIST PESANAN -->
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-body p-0">
            @if($orders->isEmpty())
                <div class="text-center py-5">
                    <i data-lucide="inbox" size="48" class="text-muted opacity-50 mb-3 mx-auto"></i>
                    <h6 class="fw-bold text-dark">Tidak ada pembayaran yang perlu dikonfirmasi</h6>
                    <p class="text-muted small mb-0">Semua bukti transfer telah diverifikasi.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-secondary smaller fw-bold text-uppercase">Invoice & Tanggal</th>
                                <th class="py-3 text-secondary smaller fw-bold text-uppercase">Pembeli</th>
                                <th class="py-3 text-secondary smaller fw-bold text-uppercase">Produk Dipesan</th>
                                <th class="py-3 text-secondary smaller fw-bold text-uppercase">Total Tagihan</th>
                                <th class="py-3 text-secondary smaller fw-bold text-uppercase">Bukti Bayar</th>
                                <th class="pe-4 py-3 text-secondary smaller fw-bold text-uppercase text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <!-- INVOICE & TANGGAL -->
                                    <td class="ps-4">
                                        <span class="fw-bold text-primary d-block">{{ $order->invoice_number }}</span>
                                        <span class="smaller text-muted">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                    </td>

                                    <!-- PEMBELI -->
                                    <td>
                                        <h6 class="fw-bold text-dark mb-0 small">{{ $order->user->name ?? 'Pembeli' }}</h6>
                                        <span class="smaller text-muted">{{ $order->user->no_hp ?? '-' }}</span>
                                    </td>

                                    <!-- PRODUK DIPESAN -->
                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            @foreach($order->details as $detail)
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge bg-light text-dark border smaller">{{ $detail->qty }}x</span>
                                                    <span class="small text-truncate" style="max-width: 200px;">{{ $detail->produk->nama_produk ?? 'Produk' }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>

                                    <!-- TOTAL -->
                                    <td>
                                        <span class="fw-bold text-dark">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</span>
                                        <span class="smaller text-muted d-block text-uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                                    </td>

                                    <!-- BUKTI BAYAR -->
                                    <td>
                                        @if($order->bukti_pembayaran)
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold small d-inline-flex align-items-center gap-1"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#proofModal{{ $order->id }}">
                                                <i data-lucide="eye" size="14"></i> Lihat Bukti
                                            </button>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">Belum Upload</span>
                                        @endif
                                    </td>

                                    <!-- AKSI KONFIRMASI -->
                                    <td class="pe-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- FORM VERIFIKASI LANGSUNG / MODAL -->
                                            <button type="button" class="btn btn-sm btn-success rounded-3 fw-bold px-3 d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#proofModal{{ $order->id }}">
                                                <i data-lucide="check" size="16"></i> Verifikasi
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL LIHAT BUKTI & PROSES VERIFIKASI -->
                                <div class="modal fade" id="proofModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content rounded-4 border-0 shadow">
                                            <div class="modal-header border-bottom px-4 py-3">
                                                <h6 class="modal-title fw-bold text-dark">
                                                    Verifikasi Pembayaran - {{ $order->invoice_number }}
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row g-4">
                                                    <!-- KIRI: GAMBAR BUKTI -->
                                                    <div class="col-md-6 text-center border-end">
                                                        <span class="smaller text-muted fw-bold d-block mb-2 text-uppercase">Bukti Transfer Pembeli</span>
                                                        @if($order->bukti_pembayaran)
                                                            <a href="{{ route('show.thumbnail.produk.private', $order->bukti_pembayaran) }}" target="_blank">
                                                                <img src="{{ route('show.thumbnail.produk.private', $order->bukti_pembayaran) }}" class="img-fluid rounded-3 border p-1 bg-light" style="max-height: 300px; object-fit: contain;">
                                                            </a>
                                                            <span class="smaller text-muted d-block mt-2">Klik gambar untuk membuka ukuran penuh</span>
                                                        @else
                                                            <div class="p-5 bg-light rounded-3 text-muted">
                                                                Bukti transfer belum diunggah.
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- KANAN: DETAIL TAGIHAN & AKSI -->
                                                    <div class="col-md-6 d-flex flex-column justify-content-between">
                                                        <div>
                                                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Detail Pesanan</h6>
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <span class="small text-muted">Nama Pembeli:</span>
                                                                <span class="small fw-bold text-dark">{{ $order->user->name ?? '-' }}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <span class="small text-muted">Metode Bayar:</span>
                                                                <span class="small fw-bold text-dark text-uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <span class="small text-muted">Total Yang Harus Diterima:</span>
                                                                <span class="h6 fw-bold text-primary mb-0">Rp {{ number_format($order->total_payment, 0, ',', '.') }}</span>
                                                            </div>
                                                        </div>

                                                        <!-- FORM AKSI SETUJUI / TOLAK -->
                                                        <div class="pt-3 border-top">
                                                            <span class="smaller text-muted fw-bold d-block mb-2">Pilih Keputusan:</span>
                                                            <div class="d-grid gap-2">
                                                                <!-- Tombol Terima -->
                                                                <form action="{{ route('vendor.payments.verify', $order->id) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="action" value="approve">
                                                                    <button type="submit" class="btn btn-success w-100 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2" onclick="return confirm('Apakah Anda yakin dana pembayaran telah masuk ke rekening/akun Anda?')">
                                                                        <i data-lucide="check-circle" size="18"></i> Konfirmasi & Terima Pembayaran
                                                                    </button>
                                                                </form>

                                                                <!-- Tombol Tolak -->
                                                                <form action="{{ route('vendor.payments.verify', $order->id) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="action" value="reject">
                                                                    <button type="submit" class="btn btn-outline-danger w-100 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2" onclick="return confirm('Apakah Anda yakin ingin menolak pembayaran ini?')">
                                                                        <i data-lucide="x-circle" size="18"></i> Tolak Pembayaran
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="p-3 border-top">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>

</div>

<style>
    .smaller { font-size: 0.75rem; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection