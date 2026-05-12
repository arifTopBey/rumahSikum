@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.produk.index') }}" class="text-decoration-none">Produk Saya</a></li>
                        <li class="breadcrumb-item active">Detail Produk</li>
                    </ol>
                </nav>
                <h4 class="fw-800 text-primary mb-0">{{ $produk->nama_produk }}</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('vendor.produk.index') }}" class="btn btn-white border rounded-3 px-4 fw-bold">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
                <a href="{{ route('vendor.produk.edit', $produk->id) }}" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                    <i data-lucide="edit-3" size="18" class="me-1"></i> Edit Produk
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="position-relative">
                    <!-- foto utama -->
                    <img src="{{ route('show.thumbnail.produk.private', $produk->produk_thumbnail) }}" class="img-fluid w-100" style="height: 400px; object-fit: cover;" id="mainView">
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-primary px-3 py-2 rounded-pill shadow">Foto Utama</span>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <h6 class="fw-800 mb-3 smaller text-muted text-uppercase">Galeri Produk</h6>
                    <div class="row g-2">
                        <div class="col-3">
                            <img src="{{ route('show.thumbnail.produk.private', $produk->produk_thumbnail) }}" class="img-fluid rounded-2 border cursor-pointer gallery-item active-thumb" onclick="changeView(this.src, this)">
                        </div>
                        @foreach($produk->produkPhoto as $photo)
                        <div class="col-3">
                            <img src="{{ route('show.thumbnail.produk.private', $photo->photos_produks) }}" class="img-fluid rounded-2 border cursor-pointer gallery-item" onclick="changeView(this.src, this)">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6 border-end">
                        <label class="smaller text-muted d-block mb-1">Harga Jual</label>
                        <h3 class="fw-800 text-primary mb-0">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h3>
                    </div>
                    <div class="col-md-6 ps-md-4">
                        <label class="smaller text-muted d-block mb-1">Sisa Stok</label>
                        <h3 class="fw-800 {{ $produk->stok <= 10 ? 'text-danger' : 'text-dark' }} mb-0">
                            {{ $produk->stok }} <small class="fw-normal h6 text-muted">Unit</small>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h6 class="fw-800 mb-4 text-dark d-flex align-items-center gap-2 border-bottom pb-3">
                    <i data-lucide="info" class="text-primary" size="20"></i> Spesifikasi & Status
                </h6>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Kategori</label>
                        <p class="fw-bold text-dark">{{ $produk->kategori->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Status Produk</label>
                        @if($produk->status_produk == 1)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                <i data-lucide="check-circle" size="14" class="me-1"></i> Aktif di Katalog
                            </span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                <i data-lucide="eye-off" size="14" class="me-1"></i> Disembunyikan
                            </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Slug URL</label>
                        <code class="smaller text-primary">{{ $produk->slug }}</code>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Terakhir Diperbarui</label>
                        <p class="small text-dark">{{ $produk->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-800 mb-3 text-dark border-bottom pb-3">Deskripsi Produk</h6>
                <div class="produk-deskripsi text-muted lh-lg">
                    {!! $produk->produk_deskripsi !!}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .btn-white { background: white; }
    .cursor-pointer { cursor: pointer; }
    
    .gallery-item {
        transition: all 0.2s ease;
        height: 80px;
        width: 100%;
        object-fit: cover;
        opacity: 0.6;
    }
    
    .gallery-item:hover, .gallery-item.active-thumb {
        opacity: 1;
        border-color: #a82282 !important;
        border-width: 2px !important;
    }

    .produk-deskripsi img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
</style>

@push('scripts')
<script>
    lucide.createIcons();

    // Fungsi untuk mengganti foto utama saat galeri diklik
    function changeView(src, element) {
        document.getElementById('mainView').src = src;
        
        // Reset semua border galeri
        document.querySelectorAll('.gallery-item').forEach(img => {
            img.classList.remove('active-thumb');
        });
        
        // Tambah border ke yang diklik
        element.classList.add('active-thumb');
    }
</script>
@endpush
@endsection