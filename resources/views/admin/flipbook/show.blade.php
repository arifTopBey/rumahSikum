@extends('admin.main.main')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container-fluid px-4">

        {{-- Top Bar Header with Back & Action Buttons --}}
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.flipbook.index') }}" class="btn btn-white bg-white border rounded-3 p-2 d-flex align-items-center justify-content-center shadow-sm text-secondary">
                    <i data-lucide="arrow-left" size="20"></i>
                </a>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Detail Flipbook</h3>
                    <p class="text-muted small mb-0">Lihat preview isi buku dan informasi lengkap flipbook.</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('show.thumbnail.produk.private', $flipbook->file_pdf) }}" target="_blank" class="btn btn-outline-primary rounded-3 px-3 py-2 fw-semibold smaller d-flex align-items-center gap-2">
                    <i data-lucide="external-link" size="16"></i> Buka di Tab Baru
                </a>
                <a href="{{ route('admin.flipbook.edit', $flipbook->id) }}" class="btn btn-light border text-secondary rounded-3 px-3 py-2 fw-semibold smaller d-flex align-items-center gap-2">
                    <i data-lucide="edit-3" size="16"></i> Edit
                </a>
                <form action="{{ route('admin.flipbook.destroy', $flipbook->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus flipbook ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-light border text-danger rounded-3 px-3 py-2 fw-semibold smaller d-flex align-items-center gap-2">
                        <i data-lucide="trash-2" size="16"></i> Hapus
                    </button>
                </form>
            </div>
        </div>

        {{-- Main Layout Grid --}}
        <div class="row g-4">
            
            {{-- Left Column: PDF Preview Canvas --}}
            <div class="col-lg-8">
                <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden h-100">
                    <div class="card-header bg-white border-bottom p-3.5 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <i data-lucide="book-open" class="text-danger" size="20"></i>
                            <span class="fw-bold text-dark smaller">Preview Berkas PDF</span>
                        </div>
                        <a href="{{ route('show.thumbnail.produk.private', $flipbook->file_pdf) }}" download class="btn btn-sm btn-danger rounded-3 px-3 py-1.5 fw-semibold smaller d-inline-flex align-items-center gap-1.5" style="background-color: #e11d48;">
                            <i data-lucide="download" size="14"></i> Unduh PDF
                        </a>
                    </div>
                    
                    <div class="card-body p-0 bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="min-height: 550px;">
                        @if($flipbook->file_pdf)
                            <iframe src="{{ route('show.thumbnail.produk.private', $flipbook->file_pdf) }}" class="w-100 h-100 border-0" style="min-height: 600px;" title="PDF Preview"></iframe>
                        @else
                            <div class="text-center p-5 text-muted">
                                <i data-lucide="file-x" size="48" class="mb-2"></i>
                                <p class="mb-0">File PDF tidak ditemukan atau belum diunggah.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column: Information & Metadata --}}
            <div class="col-lg-4">
                <div class="d-flex flex-column gap-4">

                    {{-- Cover Card --}}
                    <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden p-3 text-center">
                        <div class="position-relative rounded-3 overflow-hidden bg-dark mb-3" style="max-height: 320px;">
                            <img src="{{ route('show.thumbnail.produk.private', $flipbook->cover_image) }}" 
                                 class="w-100 h-100 object-fit-cover" 
                                 alt="{{ $flipbook->judul }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=600&auto=format&fit=crop&q=80'">
                            <span class="badge position-absolute top-0 end-0 m-3 rounded-pill px-2.5 py-1.5 smaller fw-semibold bg-danger text-white shadow-sm">
                                Sampul Flipbook
                            </span>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">{{ $flipbook->judul }}</h5>
                        <p class="text-muted smaller mb-0">{{ $flipbook->deskripsi ?? 'Tidak ada deskripsi singkat.' }}</p>
                    </div>

                    {{-- Details Info Card --}}
                    <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
                        <h6 class="fw-bold text-dark mb-3 smaller text-uppercase" style="letter-spacing: 0.5px;">Informasi Dokumen</h6>
                        
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 p-2 bg-light text-secondary">
                                    <i data-lucide="file-text" size="18"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <span class="text-muted smaller d-block">Nama Berkas</span>
                                    <span class="fw-semibold text-dark smaller text-truncate d-block">{{ basename($flipbook->file_pdf) }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 p-2 bg-light text-secondary">
                                    <i data-lucide="calendar" size="18"></i>
                                </div>
                                <div>
                                    <span class="text-muted smaller d-block">Dibuat Pada</span>
                                    <span class="fw-semibold text-dark smaller">{{ \Carbon\Carbon::parse($flipbook->created_at)->format('d F Y, H:i') }} WIB</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 p-2 bg-light text-secondary">
                                    <i data-lucide="clock" size="18"></i>
                                </div>
                                <div>
                                    <span class="text-muted smaller d-block">Terakhir Diperbarui</span>
                                    <span class="fw-semibold text-dark smaller">{{ \Carbon\Carbon::parse($flipbook->updated_at)->format('d F Y, H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection