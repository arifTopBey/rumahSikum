@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="" class="text-decoration-none">Daftar Produk</a></li>
                        <li class="breadcrumb-item active">Detail Produk</li>
                    </ol>
                </nav>
                <h4 class="fw-800 text-primary mb-0">{{ $produk->nama_produk }}</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{  route('admin.list.produk.index')  }}" class="btn btn-white border rounded-3 px-4 fw-bold">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- ALERT SAKSES / ERROR -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
            <i data-lucide="check-circle" size="18" class="me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
            </div>

            <!-- AKSI MODERASI ADMIN -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h6 class="fw-800 mb-3 text-dark d-flex align-items-center gap-2 border-bottom pb-3">
                    <i data-lucide="shield-check" class="text-primary" size="20"></i> Aksi Moderasi Produk
                </h6>
                <p class="text-muted smaller mb-3">Ubah status verifikasi produk ini untuk mengatur visibilitasnya di aplikasi/toko online.</p>
                
                <form action="{{ route('admin.produk.update-status', $produk->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label smaller fw-bold text-dark">Pilih Status Moderasi</label>
                        <select name="status" class="form-select rounded-3 fw-bold" style="font-size: 0.9rem;">
                            <option value="pending" {{ $produk->status == 'pending' ? 'selected' : '' }}>⏳ Pending (Menunggu Persetujuan)</option>
                            <option value="approved" {{ $produk->status == 'approved' ? 'selected' : '' }}>✅ Disetujui (Approved)</option>
                            <option value="rejected" {{ $produk->status == 'rejected' ? 'selected' : '' }}>❌ Ditolak (Rejected)</option>
                            <option value="block" {{ $produk->status == 'block' ? 'selected' : '' }}>🚫 Diblock (Blocked)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label smaller fw-bold text-dark">Catatan / Alasan (Opsional)</label>
                        <textarea name="catatan_admin" class="form-control rounded-3" rows="2" placeholder="Masukkan alasan jika menolak/memplokir produk..." style="font-size: 0.85rem;">{{ $produk->catatan_admin ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-2 shadow-sm">
                        <i data-lucide="save" size="16" class="me-1"></i> Simpan Perubahan Status
                    </button>
                </form>
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
                        <p class="fw-bold text-dark mb-0">{{ $produk->kategori->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block mb-1">Status Moderasi Admin</label>
                        @if ($produk->status == "pending")
                            <span class="badge bg-warning text-white border border-warning px-3 py-2 rounded-pill fw-bold">Pending</span>
                        @elseif($produk->status == 'approved')
                            <span class="badge bg-success text-white border border-success px-3 py-2 rounded-pill fw-bold">Disetujui</span>
                        @elseif($produk->status == 'rejected')
                            <span class="badge bg-danger text-white border border-danger px-3 py-2 rounded-pill fw-bold">Ditolak</span>
                        @elseif($produk->status == 'block')
                            <span class="badge bg-secondary text-white border border-secondary px-3 py-2 rounded-pill fw-bold">Diblock</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Status Toko/Vendor</label>
                        @if($produk->status_produk == 1)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                <i data-lucide="check-circle" size="14" class="me-1"></i> Aktif di Katalog Toko
                            </span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                <i data-lucide="eye-off" size="14" class="me-1"></i> Disembunyikan Toko
                            </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Slug URL</label>
                        <code class="smaller text-primary">{{ $produk->slug }}</code>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted d-block">Terakhir Diperbarui</label>
                        <p class="small text-dark mb-0">{{ $produk->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h6 class="fw-800 mb-3 text-dark border-bottom pb-3">Nama Toko / Vendor</h6>
                <div class="d-flex align-items-center gap-3">
                    <div class="fw-bold text-dark fs-5">
                        {{ $produk->vendor->nama_vendor ?? $produk->vendor->shop_name ?? 'Toko' }}
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

    .produk-deskripsi img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
</style>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endpush
@endsection