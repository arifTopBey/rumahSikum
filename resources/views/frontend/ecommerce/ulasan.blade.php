@extends('frontend.main.index')

@section('content')

<div class="container review-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="review-card shadow-sm">
                <div class="text-center mb-5">
                    <h3 class="fw-800 mb-2">Beri Ulasan Produk</h3>
                    <p class="text-muted">Bagikan pengalamanmu untuk membantu pembeli lain</p>
                </div>

                <div class="product-info-mini mb-5">
                    <img src="https://images.unsplash.com/photo-1590540179852-2110a54f813a?w=200" alt="Produk">
                    <div>
                        <h6 class="fw-bold mb-1">Sepatu Batik Tangerang Premium</h6>
                        <span class="badge bg-light text-primary rounded-pill small">Selesai: 28 Maret 2024</span>
                    </div>
                </div>

                <form action="#"  enctype="multipart/form-data">
                    @csrf
                    
                    <div class="text-center mb-4">
                        <label class="fw-800 d-block mb-2">Kualitas Produk</label>
                        <div class="rating-wrapper">
                            <input type="radio" name="rating" id="star5" value="5"><label for="star5"><i data-lucide="star" fill="currentColor" size="40"></i></label>
                            <input type="radio" name="rating" id="star4" value="4"><label for="star4"><i data-lucide="star" fill="currentColor" size="40"></i></label>
                            <input type="radio" name="rating" id="star3" value="3"><label for="star3"><i data-lucide="star" fill="currentColor" size="40"></i></label>
                            <input type="radio" name="rating" id="star2" value="2"><label for="star2"><i data-lucide="star" fill="currentColor" size="40"></i></label>
                            <input type="radio" name="rating" id="star1" value="1"><label for="star1"><i data-lucide="star" fill="currentColor" size="40"></i></label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold small mb-2 d-block text-center">Tulis ulasan lengkapmu di sini:</label>
                        <textarea class="form-control form-control-custom" rows="4" placeholder="Produknya sangat nyaman dipakai, motif batiknya juga sangat rapi..."></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="fw-bold small mb-2 d-block text-center">Tambahkan Foto atau Video Produk (Opsional)</label>
                        <div class="upload-box" onclick="document.getElementById('fileInput').click()">
                            <i data-lucide="camera" size="32" class="text-primary mb-2"></i>
                            <p class="small text-muted mb-0">Klik untuk upload foto/video</p>
                            <input type="file" id="fileInput" class="d-none" multiple>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-3 rounded-pill fw-bold shadow">
                            Kirim Ulasan Sekarang
                        </button>
                        <a href="" class="btn btn-link text-decoration-none mt-3 text-muted small">Kembali ke Pesanan Saya</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
    
    // Simple preview logic (optional)
    document.getElementById('fileInput').addEventListener('change', function() {
        if(this.files.length > 0) {
            alert(this.files.length + " file dipilih");
        }
    });
</script>
@endpush
@endsection