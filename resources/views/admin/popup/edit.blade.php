@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light min-vh-100 pb-5" style="margin-top: 20px;">
    
    <div class="row pt-5 mb-4">
        <div class="col-md-12 mx-auto d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-800 text-dark mb-1">Ubah Banner Pop-up</h4>
                <p class="text-muted small mb-0">Perbarui konfigurasi, status tayang, atau gambar banner pengumuman website.</p>
            </div>
            <div>
                <a href="{{ route('admin.banner.pop.up.index') }}" class="btn btn-white border rounded-3 px-3 fw-bold shadow-sm small">
                    <i data-lucide="arrow-left" size="16" class="me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">

     @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="col-md-12 mx-auto">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <form action="{{ route('admin.banner.pop.up.update', $popup->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-lg-7 border-end pe-lg-4">
                            
                            <div class="mb-4">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Unggah Gambar Banner Baru (Opsional)</label>
                                <div class="input-group border-2 rounded-3 overflow-hidden bg-light p-1">
                                    <input type="file" id="image_upload" name="banner_image" class="form-control border-0 bg-light py-1 small" accept="image/jpeg,image/png,image/jpg">
                                </div>
                                <div class="form-text smaller text-muted mt-1">Biarkan kosong jika Anda tidak ingin mengganti gambar banner yang saat ini sedang aktif.</div>
                            </div>

                            <div class="mb-2">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Status Tayang</label>
                                <div class="form-check form-switch bg-light p-3 rounded-3 border d-flex justify-content-between align-items-center ps-5">
                                    <label class="form-check-label small fw-bold text-dark mb-0" for="status">Aktifkan pop-up ini langsung di halaman depan</label>
                                    <input class="form-check-input my-0" type="checkbox" name="status" id="is_active" 
                                           {{ old('status', $popup->status) ? 'checked' : '' }} style="width: 40px; height: 20px; cursor: pointer;">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-5 ps-lg-4 d-flex flex-column">
                            <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Pratinjau Gambar Banner</label>
                            
                            <div class="flex-grow-1 border border-dashed rounded-4 p-3 bg-light d-flex align-items-center justify-content-center position-relative shadow-inner overflow-hidden" style="min-height: 280px;">
                                
                                <img id="image_preview" 
                                     src="{{ route('show.thumbnail.produk.private', $popup->banner_image) }}" 
                                     alt="Live Preview Banner" 
                                     class="img-fluid rounded-3 shadow {{ $popup->banner_image ? '' : 'd-none' }}" 
                                     style="max-height: 260px; object-fit: contain;">
                                
                                <!-- <div id="preview_placeholder" class="{{ $popup->banner_image ? 'd-none' : 'd-flex' }} flex-column align-items-center justify-content-center text-center text-muted">
                                    <i data-lucide="image" size="48" class="opacity-25 mb-2"></i>
                                    <p class="smaller fw-medium mb-0">Belum ada file gambar yang diunggah</p>
                                </div> -->
                                
                            </div>
                        </div>
                    </div>

                    <hr class="opacity-50 my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" id="btn_cancel" class="btn btn-light rounded-3 fw-bold px-4 py-2 small">Kembalikan Semula</button>
                        <button type="submit" class="btn btn-primary rounded-3 fw-bold px-4 py-2 small shadow-sm">
                            <i data-lucide="save" size="16" class="me-1"></i> Perbarui Pop-up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .btn-white { background: white; }
    
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: none;
    }
    .input-group:focus-within {
        border-color: #7728a8 !important;
        background-color: #fff !important;
    }
    .form-check-input:checked {
        background-color: #7728a8;
        border-color: #7728a8;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const imageUpload = document.getElementById('image_upload');
        const imagePreview = document.getElementById('image_preview');
        const previewPlaceholder = document.getElementById('preview_placeholder');
        const btnCancel = document.getElementById('btn_cancel');

        // Menyimpan backup path gambar asli yang bersumber dari server database awal
        const initialImageSrc = imagePreview.getAttribute('src');

        imageUpload.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    // Masukkan data gambar baru (Base64) ke pratinjau
                    imagePreview.setAttribute('src', this.result);
                    imagePreview.classList.remove('d-none');
                    
                    // Sembunyikan total placeholder teks
                    previewPlaceholder.classList.add('d-none');
                    previewPlaceholder.classList.remove('d-flex');
                });

                reader.readAsDataURL(file);
            } else {
                restoreOriginalState();
            }
        });

        // Event listener tombol "Kembalikan Semula"
        btnCancel.addEventListener('click', function() {
            imageUpload.value = ''; // Kosongkan file input baru yang sempat terpilih
            restoreOriginalState();
        });

        // Fungsi pembantu untuk memulihkan tampilan ke kondisi database asal
        function restoreOriginalState() {
            if (initialImageSrc && initialImageSrc.trim() !== '') {
                // Jika data awal di database memang punya gambar, kembalikan gambar tersebut
                imagePreview.setAttribute('src', initialImageSrc);
                imagePreview.classList.remove('d-none');
                
                previewPlaceholder.classList.add('d-none');
                previewPlaceholder.classList.remove('d-flex');
            } else {
                // Jika aslinya kosong, kosongkan kembali
                imagePreview.setAttribute('src', '');
                imagePreview.classList.add('d-none');
                
                previewPlaceholder.classList.remove('d-none');
                previewPlaceholder.classList.add('d-flex');
            }
        }
    });
</script>

<script>
    lucide.createIcons();
</script>
@endsection