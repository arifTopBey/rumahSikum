@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <!-- Header & Navigasi -->
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Daftar Mitra</a></li>
                        <li class="breadcrumb-item active">Detail Toko</li>
                    </ol>
                </nav>
                <h4 class="fw-800 text-primary mb-0">Profil Lengkap Mitra UMKM</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.list.toko.index') }}" class="btn btn-white border rounded-3 px-4 fw-bold">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
                <button class="btn btn-danger rounded-3 px-4 fw-bold shadow-sm" onclick="confirmDelete()">
                    <i data-lucide="trash-2" size="18" class="me-1"></i> Blokir Mitra
                </button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Kolom Kiri: Branding & Status -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-4">
                <div class="mb-3">
                    <img src="{{ route('show.thumbnail.produk.private', $vendor->store_photo)  }}" 
                         class="rounded-4 border shadow-sm mx-auto" 
                         style="width: 140px; height: 140px; object-fit: cover;">
                </div>
                <h5 class="fw-800 text-dark mb-1">{{ $vendor->shop_name }}</h5>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">
                    {{ $vendor->kategori->name ?? 'Kategori UMKM' }}
                </span>
                
                <hr class="opacity-50">
                
                <div class="text-start mb-4">
                    <label class="smaller text-muted fw-bold text-uppercase d-block mb-2">Informasi Pemilik</label>
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-light p-2 rounded-3 me-3"><i data-lucide="user" size="18" class="text-primary"></i></div>
                        <div>
                            <p class="small fw-bold mb-0">{{ $vendor->name }}</p>
                            <p class="smaller text-muted mb-0">Nama Lengkap Sesuai KTP</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-2 rounded-3 me-3"><i data-lucide="phone" size="18" class="text-success"></i></div>
                        <div>
                            <p class="small fw-bold mb-0">{{ $vendor->phone }}</p>
                            <p class="smaller text-muted mb-0">Kontak WhatsApp</p>
                        </div>
                    </div>
                </div>

                <div class="bg-light rounded-4 p-3 border border-dashed text-start">
                    <h6 class="fw-800 mb-2 smaller">Statistik Mitra</h6>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="smaller text-muted">Total Produk:</span>
                        <span class="smaller fw-bold">{{ $vendor->produk->count() }} Item</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="smaller text-muted">Bergabung:</span>
                        <span class="smaller fw-bold">{{ $vendor->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Detail & Produk -->
        <div class="col-lg-8">
            <!-- Informasi Alamat & Deskripsi -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h6 class="fw-800 mb-4 text-dark d-flex align-items-center gap-2 border-bottom pb-3">
                    <i data-lucide="file-text" class="text-primary" size="20"></i> Detail Bisnis & Lokasi
                </h6>
                
                <div class="mb-4">
                    <label class="smaller text-muted fw-bold text-uppercase">Deskripsi Toko</label>
                    <p class="text-muted small lh-lg mb-0">
                        {{ $vendor->shop_description ?? 'Vendor belum menambahkan deskripsi toko.' }}
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="smaller text-muted fw-bold text-uppercase">Alamat Lengkap</label>
                        <p class="small text-dark mb-0">
                            {{ $vendor->shop_address }}<br>
                            {{ $vendor->kelurahan }}, {{ $vendor->kecamatan }}<br>
                            {{ $vendor->kab_kota }}, {{ $vendor->provinsi }} - {{ $vendor->kode_pos }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted fw-bold text-uppercase">Titik Koordinat / Peta</label>
                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height: 80px;">
                            <a href="https://www.google.com/maps/search/{{ $vendor->shop_address }}" target="_blank" class="btn btn-sm btn-white border rounded-pill">
                                <i data-lucide="external-link" size="14" class="me-1"></i> Buka di Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Produk Terpopuler / Terbaru -->
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h6 class="fw-800 mb-0 text-dark d-flex align-items-center gap-2">
                        <i data-lucide="package" class="text-primary" size="20"></i> Katalog Produk Mitra
                    </h6>
                    <a href="#" class="btn btn-link btn-sm text-decoration-none">Lihat Semua</a>
                </div>
                
                <div class="row g-3">
                    @forelse($vendor->produk->take(4) as $produk)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-2 border rounded-3">
                            <img src="{{  route('show.thumbnail.produk.private', $produk->produk_thumbnail) }}" class="rounded-2 me-3" width="50" height="50" style="object-fit: cover;">
                            <div class="overflow-hidden">
                                <h6 class="smaller fw-bold mb-0 text-truncate">{{ $produk->nama_produk }}</h6>
                                <p class="mb-0 smaller text-primary">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-3">
                        <p class="smaller text-muted mb-0">Mitra ini belum mengunggah produk.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .btn-white { background: white; }
    .breadcrumb-item + .breadcrumb-item::before { content: "•"; }
</style>

@push('scripts')
<script>
    lucide.createIcons();
    function confirmDelete() {
        if(confirm('Apakah Anda yakin ingin menonaktifkan mitra ini?')) {
            // Logika blokir
        }
    }
</script>
@endpush
@endsection