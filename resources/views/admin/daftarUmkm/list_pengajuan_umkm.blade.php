@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 style="color: #a82282;" class="fw-800 mb-1">Daftar Pengajuan Mitra UMKM</h4>
                <p class="text-muted small mb-0">Terdapat <b>{{ $vendorRequests->count() }}</b> pendaftar yang perlu diverifikasi.</p>
            </div>
            <div class="d-flex gap-3">
                <div class="input-group" style="width: 350px;">
                    <span class="input-group-text bg-white border-end-0 rounded-3"><i data-lucide="search" size="18" class="text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 rounded-3 ps-0" placeholder="Cari nama toko atau pemilik...">
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        @forelse ($vendorRequests as $vendor)
        <div class="col-12 mb-2">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden transition-hover">
                <div class="row g-0 align-items-center">
                    
                    <div class="col-md-2">
                        <div class="position-relative" style="height: 160px;">
                            <img src="{{ route('show.icon.produk.private', $vendor->store_photo) }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Store Photo">
                            <!-- <img src="{{ asset('storage/' . $vendor->store_photo) }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Store Photo"> -->
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-primary smaller">{{ $vendor->category->name ?? 'UMKM' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 px-4">
                        <div class="py-3">
                            <h5 class="fw-bold text-dark mb-1">{{ $vendor->shop_name }}</h5>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="smaller text-muted fw-bold text-uppercase tracking-wider">{{ $vendor->name }}</span>
                                <span class="text-muted">•</span>
                                <span class="smaller text-muted">{{ $vendor->identity_number }}</span>
                            </div>
                            <p class="text-muted smaller mb-0 lh-sm">
                                <i data-lucide="map-pin" size="14" class="text-danger me-1"></i>
                                {{ $vendor->shop_address }}, {{ $vendor->kelurahan }}, {{ $vendor->kecamatan }}, {{ $vendor->kab_kota }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3 border-start px-4">
                        <div class="py-3">
                            <div class="mb-2 d-flex align-items-center">
                                <div class="icon-shape bg-success bg-opacity-10 text-success rounded-2 me-2" style="padding: 6px;">
                                    <i data-lucide="phone" size="16"></i>
                                </div>
                                <span class="small fw-bold">{{ $vendor->phone }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon-shape bg-info bg-opacity-10 text-info rounded-2 me-2" style="padding: 6px;">
                                    <i data-lucide="calendar" size="16"></i>
                                </div>
                                <span class="small text-muted">Daftar: {{ $vendor->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 border-start bg-light bg-opacity-50 px-4 h-100">
                        <div class="py-4 d-flex flex-column gap-2">
                            <a href="{{ route('daftar.pengajuan.detail', $vendor->id) }}" class="btn btn-outline-dark btn-sm rounded-2 fw-bold py-2 shadow-sm">
                                <i data-lucide="eye" size="14" class="me-1"></i> Tinjau Dokumen
                            </a>
                            <div class="d-flex gap-2">

                            @if($vendor->status_store === 0)
                                <form style="width: 50%;" action="{{ route('admin.update.status.pengajuan', $vendor->id) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" value="1" name="success">
                                    <button style="width: 100%;" class="btn btn-success btn-sm flex-grow-1 rounded-2 fw-bold py-2 shadow-sm">
                                        Setujui
                                    </button>
                                </form>
                                <form style="width: 50%;" action="{{ route('admin.update.status.pengajuan', $vendor->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" value="3" name="failed">
                                    <button style="width: 100%;" class="btn btn-danger btn-sm flex-grow-1 rounded-2 fw-bold py-2 shadow-sm">
                                        Tolak
                                    </button>
                                </form>
                            @elseif($vendor->status_store === 1)
                                <button class="btn btn-success btn-sm flex-grow-1 rounded-2 fw-bold py-2 shadow-sm">
                                        Disetujui
                                </button>
                            @else
                                <button class="btn btn-danger btn-sm flex-grow-1 rounded-2 fw-bold py-2 shadow-sm">
                                        Ditolak
                                </button>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 bg-white rounded-3 shadow-sm">
            <i data-lucide="inbox" size="48" class="text-muted mb-3"></i>
            <h5 class="text-muted">Tidak ada pengajuan yang masuk</h5>
        </div>
        @endforelse
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .tracking-wider { letter-spacing: 1px; }
    
    /* Hover Effect agar terasa interaktif */
    .transition-hover {
        transition: all 0.3s ease;
        border: 1px solid transparent !important;
    }
    .transition-hover:hover {
        transform: scale(1.01);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        border-color: #a82282 !important;
    }

    /* Ikon shape */
    .icon-shape {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Menghilangkan radius kapsul, ganti ke standar rounded-3 */
    .rounded-3 { border-radius: 12px !important; }
    .btn { border-radius: 8px !important; }
</style>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection