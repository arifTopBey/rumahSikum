@extends('admin.main.main')

@section('content')

<style>
    body { background-color: #f4f7fe; }
    .review-wrapper { margin-top: 20px; margin-bottom: 100px; }

    .review-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    /* Star Rating Styling */
    .rating-wrapper {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        gap: 10px;
        margin: 15px 0;
    }
    .rating-wrapper input { display: none; }
    .rating-wrapper label {
        cursor: pointer;
        color: #e2e8f0;
        transition: 0.2s;
    }
    .rating-wrapper label:hover,
    .rating-wrapper label:hover ~ label,
    .rating-wrapper input:checked ~ label {
        color: #ffc107;
    }

    /* Photo Upload Area */
    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: 0.3s;
        background: #f8fafc;
    }
    .upload-box:hover {
        border-color: #4361ee;
        background: rgba(67, 97, 238, 0.02);
    }

    .preview-img-review {
        max-height: 200px;
        border-radius: 15px;
        object-fit: contain;
        display: none;
    }

    .product-info-mini {
        background: #f8fafc;
        border-radius: 20px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .product-info-mini img {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        object-fit: cover;
    }

    .form-control-custom {
        border-radius: 20px;
        padding: 15px 20px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        resize: none;
    }
    .form-control-custom:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        background: white;
    }
</style>

<div class="container review-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="review-card shadow-sm">
                <div class="text-center mb-4">
                    <h3 class="fw-800 mb-2">Beri Ulasan Produk</h3>
                    <p class="text-muted small">Bagikan pengalamanmu untuk membantu pembeli lain</p>
                </div>

                <!-- INFO PRODUK DARI DATABASE -->
                <div class="product-info-mini mb-4">
                    @if(isset($orderDetail->produk->produk_thumbnail))
                        <img src="{{ route('show.thumbnail.produk.private', $orderDetail->produk->produk_thumbnail) }}" 
                             alt="{{ $orderDetail->produk->nama_produk }}">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Produk">
                    @endif
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">{{ $orderDetail->produk->nama_produk ?? 'Nama Produk' }}</h6>
                        <span class="badge bg-light text-primary border rounded-pill small">
                            Selesai: {{ $order->received_at ? \Carbon\Carbon::parse($order->received_at)->translatedFormat('d F Y') : $order->updated_at->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>

                <!-- FORM REVIEW -->
                <form action="{{ route('user.reviews.store', ['orderId' => $order->id, 'produkId' => $orderDetail->produk_id]) }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    
                    <!-- RATING BINTANG -->
                    <div class="text-center mb-4">
                        <label class="fw-800 d-block mb-1 text-dark">Kualitas Produk <span class="text-danger">*</span></label>
                        <div class="rating-wrapper">
                            <input type="radio" name="rating" id="star5" value="5" {{ old('rating') == 5 ? 'checked' : '' }}>
                            <label for="star5" title="5 Bintang"><i data-lucide="star" fill="currentColor" size="38"></i></label>
                            
                            <input type="radio" name="rating" id="star4" value="4" {{ old('rating') == 4 ? 'checked' : '' }}>
                            <label for="star4" title="4 Bintang"><i data-lucide="star" fill="currentColor" size="38"></i></label>
                            
                            <input type="radio" name="rating" id="star3" value="3" {{ old('rating') == 3 ? 'checked' : '' }}>
                            <label for="star3" title="3 Bintang"><i data-lucide="star" fill="currentColor" size="38"></i></label>
                            
                            <input type="radio" name="rating" id="star2" value="2" {{ old('rating') == 2 ? 'checked' : '' }}>
                            <label for="star2" title="2 Bintang"><i data-lucide="star" fill="currentColor" size="38"></i></label>
                            
                            <input type="radio" name="rating" id="star1" value="1" {{ old('rating') == 1 ? 'checked' : '' }}>
                            <label for="star1" title="1 Bintang"><i data-lucide="star" fill="currentColor" size="38"></i></label>
                        </div>

                        @error('rating')
                            <span class="text-danger small fw-bold d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- INPUT KOMENTAR -->
                    <div class="mb-4">
                        <label class="fw-bold small mb-2 d-block text-dark">Tulis ulasan lengkapmu di sini:</label>
                        <textarea name="comment" 
                                  class="form-control form-control-custom @error('comment') is-invalid @enderror" 
                                  rows="4" 
                                  placeholder="Produknya sangat nyaman dipakai, kualitas bahan sangat rapi...">{{ old('comment') }}</textarea>
                        
                        @error('comment')
                            <span class="text-danger small fw-bold d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- UPLOAD FOTO PROMO / UNBOXING -->
                    <div class="mb-5">
                        <label class="fw-bold small mb-2 d-block text-dark text-center">Tambahkan Foto Produk (Opsional)</label>
                        <div class="upload-box" onclick="document.getElementById('foto_ulasan').click()">
                            <div id="upload-placeholder">
                                <i data-lucide="camera" size="32" class="text-primary mb-2"></i>
                                <p class="small text-muted mb-0">Klik untuk memilih foto</p>
                                <span class="smaller text-muted">JPG, PNG, WEBP (Maksimal 3MB)</span>
                            </div>

                            <img id="image-preview" class="preview-img-review img-fluid mx-auto mt-2 border shadow-sm" alt="Preview Foto Ulasan">
                            
                            <input type="file" 
                                   name="foto_ulasan" 
                                   id="foto_ulasan" 
                                   class="d-none @error('foto_ulasan') is-invalid @enderror" 
                                   accept="image/*"
                                   onchange="previewReviewImage(event)">
                        </div>

                        @error('foto_ulasan')
                            <span class="text-danger small fw-bold d-block text-center mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-3 rounded-pill fw-bold shadow">
                            Kirim Ulasan Sekarang
                        </button>
                        <a href="{{ route('user.orders.detail_pesanan', $order->invoice_number) }}" class="btn btn-link text-decoration-none mt-3 text-muted small text-center">
                            Kembali ke Detail Pesanan
                        </a>
                    </div>
                </form>
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

    // Preview foto yang diunggah
    function previewReviewImage(event) {
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

@endsection


