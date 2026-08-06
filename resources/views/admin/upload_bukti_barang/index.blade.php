@extends('admin.main.main')

@section('content')

<style>
    body { background-color: #f4f7fe; }
    .order-wrapper { margin-top: 30px; margin-bottom: 100px; }

    .receipt-card {
        background: white;
        border-radius: 25px;
        padding: 30px;
        border: 1px solid #edf2f7;
    }

    .btn-back-order {
        background: white;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 8px 18px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-back-order:hover { background: #f8fafc; color: #1e293b; }

    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 30px;
        text-center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    .upload-box:hover {
        border-color: #4361ee;
        background: #f0f3ff;
    }

    .preview-img {
        max-height: 250px;
        border-radius: 15px;
        object-fit: contain;
        display: none;
    }
</style>

<div class="container order-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <!-- BACK BUTTON -->
            <div class="mb-4">
                <a href="{{ route('user.orders.detail_pesanan', $order->invoice_number) }}" class="btn-back-order shadow-sm">
                    <i data-lucide="arrow-left" size="16"></i> Kembali ke Detail Pesanan
                </a>
            </div>

            <div class="receipt-card shadow-sm">
                <div class="text-center mb-4">
                    <div class="d-inline-flex p-3 rounded-circle bg-primary-subtle text-primary mb-3">
                        <i data-lucide="package-check" size="36"></i>
                    </div>
                    <h5 class="fw-800 text-dark mb-1">Konfirmasi Penerimaan Pesanan</h5>
                    <p class="small text-muted mb-0">No. Invoice: <b>#{{ $order->invoice_number }}</b></p>
                </div>

                <!-- RINGKASAN PRODUK PESANAN -->
                <div class="p-3 bg-light rounded-4 mb-4 border">
                    <span class="smaller text-muted fw-bold d-block mb-2 text-uppercase">Daftar Barang Yang Diterima:</span>
                    @foreach($order->details as $detail)
                        <div class="d-flex align-items-center justify-content-between mb-2 last-0">
                            <span class="small fw-bold text-dark text-truncate" style="max-width: 300px;">
                                • {{ $detail->produk->nama_produk ?? 'Produk' }}
                            </span>
                            <span class="small text-muted fw-bold">{{ $detail->qty }} pcs</span>
                        </div>
                    @endforeach
                </div>

                <!-- FORM UPLOAD BUKTI -->
                <form action="{{ route('user.orders.store_receipt', $order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small">Upload Foto Bukti Terima Barang / Unboxing <span class="text-danger">*</span></label>
                        
                        <div class="upload-box text-center" onclick="document.getElementById('bukti_penerimaan').click();">
                            <div id="upload-placeholder">
                                <i data-lucide="camera" size="40" class="text-primary mb-2"></i>
                                <h6 class="fw-bold text-dark mb-1 small">Klik untuk memilih foto</h6>
                                <p class="smaller text-muted mb-0">Format: JPG, PNG, JPEG (Maksimal 2MB)</p>
                            </div>

                            <img id="image-preview" class="preview-img img-fluid mx-auto mt-2 shadow-sm border" alt="Preview Bukti Penerimaan">
                        </div>

                        <input type="file" 
                               name="bukti_penerimaan" 
                               id="bukti_penerimaan" 
                               class="d-none @error('bukti_penerimaan') is-invalid @enderror" 
                               accept="image/*"
                               onchange="previewImage(event)">

                        @error('bukti_penerimaan')
                            <div class="text-danger small mt-2 fw-bold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="alert alert-warning border-0 rounded-3 small text-dark mb-4">
                        <i data-lucide="alert-triangle" size="16" class="me-1"></i>
                        Pastikan Anda telah memeriksa barang secara menyeluruh sebelum mengonfirmasi pesanan selesai.
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <i data-lucide="check-circle" size="18"></i> Konfirmasi Pesanan Diterima
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection


<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });

    function previewImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');

        reader.onload = function() {
            if (reader.readyState === 2) {
                imageField.src = reader.result;
                imageField.style.display = 'block';
                placeholder.style.display = 'none';
            }
        }

        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
