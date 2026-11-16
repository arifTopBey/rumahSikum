@extends('admin.main.main')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container-fluid px-2" style="max-width: 1200px;">

        {{-- Top Bar Header with Back Button --}}
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.flipbook.index') }}" class="btn btn-white bg-white border rounded-3 p-2 d-flex align-items-center justify-content-center shadow-sm text-secondary">
                <i data-lucide="arrow-left" size="20"></i>
            </a>
            <div>
                <h3 class="fw-bold text-dark mb-0">Edit Flipbook</h3>
                <p class="text-muted small mb-0">Perbarui informasi, sampul, atau berkas PDF dari flipbook yang tersimpan.</p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <form action="{{ route('admin.flipbook.update', $flipbook->id) }}" method="POST" enctype="multipart/form-data" id="flipbookEditForm">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    {{-- Left Column: Form Inputs --}}
                    <div class="col-lg-7">
                        
                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold text-dark smaller">Judul Flipbook <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control rounded-3 py-2 px-3 @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul', $flipbook->judul) }}" 
                                   placeholder="Masukkan judul flipbook..." 
                                   required>
                            @error('judul')
                                <div class="invalid-feedback smaller">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold text-dark smaller">Deskripsi Singkat</label>
                            <textarea class="form-control rounded-3 py-2 px-3 @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      placeholder="Tuliskan ringkasan atau isi singkat dari flipbook ini...">{{ old('deskripsi', $flipbook->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback smaller">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload File PDF (Opsional) --}}
                        <div class="mb-3">
                            <label for="file_pdf" class="form-label fw-semibold text-dark smaller">File PDF Baru <span class="text-muted fw-normal">(Biarkan kosong jika tidak ingin diubah)</span></label>
                            
                            {{-- Current PDF Info --}}
                            @if($flipbook->file_pdf)
                            <div class="p-2.5 rounded-3 bg-light border d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center gap-2 overflow-hidden me-2">
                                    <i data-lucide="file-text" class="text-danger flex-shrink-0" size="18"></i>
                                    <span class="text-dark smaller fw-medium text-truncate">{{ basename($flipbook->file_pdf) }}</span>
                                </div>
                                <a href="{{ route('show.thumbnail.produk.private', $flipbook->file_pdf) }}" target="_blank" class="text-primary smaller text-decoration-none fw-semibold flex-shrink-0 d-flex align-items-center gap-1">
                                    <i data-lucide="external-link" size="12"></i> Lihat
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted ps-3">
                                    <i data-lucide="file-up" size="18" class="text-secondary"></i>
                                </span>
                                <input type="file" 
                                       class="form-control bg-light border-start-0 rounded-end-3 py-2 smaller @error('file_pdf') is-invalid @enderror" 
                                       id="file_pdf" 
                                       name="file_pdf" 
                                       accept="application/pdf" 
                                       onchange="updatePdfName(this)">
                            </div>
                            <div class="form-text smaller text-muted">Format: <strong>PDF</strong> (Maksimal 20MB).</div>
                            @error('file_pdf')
                                <div class="text-danger smaller mt-1">{{ $message }}</div>
                            @enderror

                            {{-- Selected PDF Name Alert --}}
                            <div id="pdfSelectedInfo" class="mt-2 p-2.5 rounded-3 bg-light border d-none align-items-center gap-2">
                                <i data-lucide="check-circle-2" class="text-success" size="16"></i>
                                <span class="text-dark smaller fw-medium text-truncate" id="pdfFileName"></span>
                            </div>
                        </div>

                    </div>

                    {{-- Right Column: Cover Upload & Preview --}}
                    <div class="col-lg-5">
                        <label class="form-label fw-semibold text-dark smaller mb-2">Sampul Flipbook (Cover Image)</label>
                        
                        {{-- Drag & Drop Area --}}
                        <div class="upload-cover-box rounded-4 border-2 border-dashed p-3 text-center position-relative d-flex flex-column align-items-center justify-content-center bg-light" id="coverDropZone" style="min-height: 260px;">
                            <input type="file" 
                                   name="cover_image" 
                                   id="cover_image" 
                                   class="position-absolute top-0 start-0 w-100 h-100 opacity-0 style-pointer" 
                                   accept="image/png, image/jpeg, image/jpg, image/webp" 
                                   onchange="previewCoverImage(this)">
                            
                            {{-- Preview View (Diisi otomatis dengan cover dari DB) --}}
                            <div id="coverPreviewContainer" class="w-100 h-100 position-relative">
                                <img id="coverImagePreview" 
                                     src="{{ route('show.thumbnail.produk.private', $flipbook->cover_image) }}" 
                                     alt="Preview Cover" 
                                     class="img-fluid rounded-3 object-fit-cover w-100" 
                                     style="max-height: 220px;"
                                     onerror="this.src='https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=600&auto=format&fit=crop&q=80'">
                                <div class="mt-2 text-muted smaller">Klik atau seret gambar baru di sini untuk mengganti.</div>
                            </div>
                        </div>
                        @error('cover_image')
                            <div class="text-danger smaller mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-end align-items-center gap-2 pt-4 mt-4 border-top">
                    <a href="{{ route('admin.flipbook.index') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-secondary smaller border">Batal</a>
                    <button type="submit" class="btn btn-danger rounded-3 px-4 py-2 fw-semibold smaller border-0 d-flex align-items-center gap-2" style="background-color: #e11d48;" id="submitBtn">
                        <i data-lucide="refresh-cw" size="16"></i> Perbarui Flipbook
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
    .style-pointer { cursor: pointer; z-index: 5; }
    .upload-cover-box {
        border-color: #cbd5e1;
        transition: all 0.2s ease-in-out;
    }
    .upload-cover-box:hover {
        border-color: #e11d48;
        background-color: #fff1f2 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });

    // Preview Image Function
    function previewCoverImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('coverImagePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    // Display PDF File Name
    function updatePdfName(input) {
        const file = input.files[0];
        const infoBox = document.getElementById('pdfSelectedInfo');
        const nameSpan = document.getElementById('pdfFileName');
        
        if (file) {
            nameSpan.textContent = 'PDF Baru: ' + file.name + ' (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)';
            infoBox.classList.remove('d-none');
            infoBox.classList.add('d-flex');
        } else {
            infoBox.classList.add('d-none');
            infoBox.classList.remove('d-flex');
        }
    }
</script>
@endsection