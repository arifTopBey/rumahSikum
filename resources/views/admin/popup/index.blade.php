@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light min-vh-100 pb-5" style="margin-top: 20px;">

    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-800 text-dark mb-1">Kelola Pop-up Gambar</h4>
                <p class="text-muted small mb-0">Atur banner promosi atau pengumuman yang muncul otomatis saat pengunjung membuka website.</p>
            </div>
            <div>
               
                <a href="{{ route('admin.banner.pop.up.create') }}" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                    <i data-lucide="plus-circle" size="18"></i> Tambah Banner Pop-up
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 rounded-0 mb-0" role="alert">
                <div class="d-flex align-items-center gap-2 small fw-semibold">
                    <i data-lucide="alert-circle" size="18"></i> {{ session('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-0 mb-0" role="alert">
                <div class="d-flex align-items-center gap-2 small fw-semibold">
                    <i data-lucide="check-circle" size="18"></i> {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="ps-4" style="width: 80px;">NO</th>
                        <th>PRATINJAU BANNER (PREVIEW)</th>
                        <!-- <th>NAMA BANNER / LINK TUJUAN</th> -->
                        <th>STATUS TAYANG</th>
                        <th class="pe-4 text-end" style="width: 150px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($popupGambar as $popup)
                    <tr class="popup-row">
                        <td class="ps-4 fw-bold text-secondary">{{ $loop->iteration }}</td>
                        <td>
                            <div class="image-preview-box  rounded-3 overflow-hidden border shadow-sm bg-light" style="width: 120px; height: 120px;">
                                @if($popup->banner_image)
                                    <img src="{{ route('show.thumbnail.produk.private', $popup->banner_image) }}" alt="Banner Pop-up" class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-muted smaller">Tidak ada gambar</div>
                                @endif
                            </div>
                        </td>
                        <!-- <td>
                            <div class="d-flex flex-column gap-1">
                                <span class="small fw-bold text-dark text-break" style="max-width: 350px;">{{ $popup->nama_banner ?? 'Banner Pop-up Utama' }}</span>
                                @if($popup->link_tujuan)
                                    <span class="smaller text-primary text-break" style="max-width: 350px;">
                                        <i data-lucide="link" size="12" class="me-1"></i>{{ $popup->link_tujuan }}
                                    </span>
                                @else
                                    <span class="smaller text-muted italic">Tidak ada link eksternal</span>
                                @endif
                            </div>
                        </td> -->
                        <td>
                            @if($popup->status)
                                <span class="badge bg-success smaller-badge px-2 py-1 text-uppercase">
                                    <i data-lucide="eye" size="12" class="me-1"></i> Aktif
                                </span>
                            @else
                                <span class="badge bg-secondary smaller-badge px-2 py-1 text-uppercase">
                                    <i data-lucide="eye-off" size="12" class="me-1"></i> Non-Aktif
                                </span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.banner.pop.up.edit', $popup->id) }}" class="btn btn-light btn-sm rounded-3 text-secondary p-2 shadow-sm border" title="Ubah Pop-up">
                                    <i data-lucide="edit-2" size="16"></i>
                                </a>
                                <form id="delete-form-{{ $popup->id }}" action="{{ route('admin.banner.pop.up.destroy', $popup->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="confirmDelete('{{ $popup->id }}', '{{ $popup->id }}')" type="button" class="btn btn-light btn-sm rounded-3 text-danger p-2 shadow-sm border" title="Hapus Pop-up">
                                        <i data-lucide="trash-2" size="16"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 bg-white">
                            <div class="text-muted mb-2"><i data-lucide="image-off" size="32" class="opacity-50"></i></div>
                            <span class="text-muted small fw-medium">Belum ada gambar banner pop-up yang dikonfigurasi.</span>
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
    .smaller-badge { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.02rem; }
    .italic { font-style: italic; }

    .table-header-custom tr { display: table-row !important; }
    .table-header-custom th {
        display: table-cell !important;
        background-color: #f8fafc;
        padding-top: 18px !important;
        padding-bottom: 18px !important;
        color: #64748b !important;
        font-size: 0.75rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.05rem;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .popup-row { display: table-row !important; }
    .popup-row td {
        display: table-cell !important;
        border-bottom: 1px solid #f1f5f9;
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }
</style>

<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data banner pop-up ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

<script>
    lucide.createIcons();
</script>
@endsection