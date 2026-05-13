@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-end">
            <div>
                <h4 class="fw-800 text-primary mb-1">Katalog Produk Semua Toko</h4>
                <p class="text-muted small mb-0">Meliaht dan pantau performa penjualan produk Toko di sini.</p>
            </div>
            <!-- <a href="{{ route('vendor.produk.create') }}" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                <i data-lucide="plus-circle" size="18" class="me-2"></i> Tambah Produk Baru
            </a> -->
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 p-3 border-start border-4 border-primary">
                <p class="smaller text-muted fw-bold mb-1">TOTAL PRODUK</p>
                <h4 class="fw-800 mb-0">{{ $produks->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 p-3 border-start border-4 border-success">
                <p class="smaller text-muted fw-bold mb-1">PRODUK AKTIF</p>
                <h4 class="fw-800 mb-0 text-success">{{ $produks->where('status_produk', 1)->count() }}</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 p-3 h-100 d-flex justify-content-center">
                <form action="#" method="GET" class="row g-2">
                    <div class="col-8">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0"><i data-lucide="search" size="16"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Cari nama produk Anda...">
                        </div>
                    </div>
                    <div class="col-4">
                        <select class="form-select form-select-sm">
                            <option selected>Semua Kategori</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-primary bg-opacity-10">
                    <tr>
                        <th class="px-4 py-3 text-primary smaller text-uppercase fw-800">Detail Produk</th>
                        <th class="py-3 text-primary smaller text-uppercase fw-800">Kategori</th>
                        <th class="py-3 text-primary smaller text-uppercase fw-800">Nama Toko</th>
                        <th class="py-3 text-primary smaller text-uppercase fw-800">Harga Satuan</th>
                        <th class="py-3 text-primary smaller text-uppercase fw-800 text-center">Stok</th>
                        <th class="py-3 text-primary smaller text-uppercase fw-800 text-center">Status</th>
                        <th class="px-4 py-3 text-primary smaller text-uppercase fw-800 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($produks as $produk)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="position-relative">
                                    <img src="{{ route('show.thumbnail.produk.private', $produk->produk_thumbnail) }}" 
                                         class="rounded-3 shadow-sm border" 
                                         width="64" height="64" style="object-fit: cover;">
                                    <!-- <img src="{{ asset('storage/' . $produk->produk_thumbnail) }}" 
                                         class="rounded-3 shadow-sm border" 
                                         width="64" height="64" style="object-fit: cover;"> -->
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">{{ $produk->nama_produk }}</h6>
                                    <div class="d-flex gap-2">
                                        <span class="smaller text-muted"><i data-lucide="calendar" size="12"></i> {{ $produk->created_at->format('d/m/y') }}</span>
                                        <span class="smaller text-muted"><i data-lucide="image" size="12"></i> {{ $produk->produkPhoto->count() ?? 0 }} Foto</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-white text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill fw-bold">
                                {{ $produk->kategori->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-800 text-dark">{{ $produk->vendor->shop_name }}</span>
                        </td>
                        <td>
                            <span class="fw-800 text-dark">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-center">
                            @if($produk->stok <= 10)
                                <div class="badge bg-danger bg-opacity-10 text-danger rounded-3 p-2 w-75">
                                    <i data-lucide="alert-triangle" size="14" class="me-1"></i> {{ $produk->stok }} <small>Sisa</small>
                                </div>
                            @else
                                <span class="fw-bold text-muted">{{ $produk->stok }} <small>Unit</small></span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch d-inline-block">
                                <!-- <input class="form-check-input" type="checkbox" role="switch" 
                                       {{ $produk->status_produk == 1 ? 'checked' : '' }} 
                                       style="width: 2.5em; height: 1.25em; cursor: pointer;"> -->
                                    <span class="badge bg-success text-white border border-primary border-opacity-25 px-3 py-2 rounded-pill fw-bold">
                                {{ $produk->status_produk == 1 ? 'Aktif' : 'Arsip' }}
                            </span>
                            </div>
                        </td>
                        <td class="px-4 text-end">
                            <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                <a href="{{ route('admin.list.produk.detail', $produk->id) }}" class="btn btn-white btn-sm border-end" title="Lihat Detail">
                                    <i data-lucide="eye" size="16" class="text-muted"></i>
                                </a>
                                <!-- <a href="{{ route('vendor.produk.edit', $produk->id) }}" class="btn btn-white btn-sm border-end" title="Edit Produk">
                                    <i data-lucide="edit-3" size="16" class="text-primary"></i>
                                </a>
                                <button class="btn btn-white btn-sm" title="Hapus Produk" onclick="confirmDelete('{{ $produk->id }}')">
                                    <i data-lucide="trash-2" size="16" class="text-danger"></i>
                                </button> -->
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="py-4">
                                <i data-lucide="package-search" size="48" class="text-muted mb-3"></i>
                                <h6 class="text-muted fw-bold">Belum ada produk yang dijual</h6>
                                <p class="smaller text-muted">Mulai tambahkan produk pertama Anda untuk mulai berjualan.</p>
                                <a href="{{ route('vendor.produk.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">Tambah Sekarang</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .table thead th { border: none; letter-spacing: 0.5px; }
    .table tbody td { border-bottom: 1px solid #f0f2f5; padding-top: 1.2rem; padding-bottom: 1.2rem; }
    .btn-white { background: white; border: 1px solid #e2e8f0; }
    .btn-white:hover { background: #f8fafc; }
    
    /* Custom Switch Color */
    .form-check-input:checked {
        background-color: #10b981;
        border-color: #10b981;
    }
</style>

@push('scripts')
<script>
    lucide.createIcons();

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')) {
            // Logika hapus (panggil form delete atau axios)
        }
    }
</script>
@endpush
@endsection