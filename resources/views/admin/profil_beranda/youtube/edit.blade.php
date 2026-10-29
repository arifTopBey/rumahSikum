@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light min-vh-100 pb-5" style="margin-top: 20px;">
    
    <!-- HEADER UTAMA -->
    <div class="row pt-5 mb-4">
        <div class="col-md-10 mx-auto d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-800 text-dark mb-1">Ubah Video Profil</h4>
                <p class="text-muted small mb-0">Perbarui tautan video YouTube untuk tampilan beranda utama.</p>
            </div>
            <div>
                <!-- Ganti '#' dengan route index video Anda, misal: route('admin.video.index') -->
                <a href="#" class="btn btn-white border rounded-3 px-3 fw-bold shadow-sm small">
                    <i data-lucide="arrow-left" size="16" class="me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- FORM INPUT & PREVIEW -->
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <!-- Gunakan method PUT/PATCH untuk update data di Laravel -->
                <form action="{{ route('admin.profil-beranda.update', $profilBeranda->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Input Tautan YouTube -->
                    <div class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Tautan Video YouTube</label>
                        <div class="input-group border-2 rounded-3 overflow-hidden bg-light">
                            <span class="input-group-text bg-light border-0 pe-2 text-danger">
                                <i data-lucide="youtube" size="20"></i>
                            </span>
                            <!-- Value diisi dengan data dari controller, contoh di bawah menggunakan data dummy link lama -->
                            <input type="text" id="youtube_url" name="video_youtube" class="form-control border-0 bg-light py-2 small" 
                                   value="{{ $profilBeranda->video_youtube?? 'https://www.youtube.com/watch?v=mixkit-dance' }}" required autocomplete="off">
                        </div>
                        <div class="form-text smaller text-muted mt-1">Ubah tautan di atas jika ingin mengganti video profil beranda.</div>
                    </div>

                    <!-- AREA PREVIEW (Otomatis Tampil Saat Load & Mengikuti Perubahan Input) -->
                    <div id="preview_container" class="mb-4">
                        <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Pratinjau Video Saat Ini</label>
                        <div class="ratio ratio-16x9 rounded-4 overflow-hidden border shadow-sm bg-dark">
                            <iframe id="youtube_iframe" src="" title="YouTube video player" frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <hr class="opacity-50 my-4">

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2">
                        <!-- Tombol Batal mengembalikan ke link semula -->
                        <button type="button" id="btn_cancel" class="btn btn-light rounded-3 fw-bold px-4 py-2 small">Kembalikan Semula</button>
                        <button type="submit" class="btn btn-primary rounded-3 fw-bold px-4 py-2 small shadow-sm">
                            <i data-lucide="save" size="16" class="me-1"></i> Perbarui Video
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambahan CSS -->
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
</style>

<!-- JAVASCRIPT: Load Preview Awal & Deteksi Perubahan URL -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlInput = document.getElementById('youtube_url');
        const previewContainer = document.getElementById('preview_container');
        const iframe = document.getElementById('youtube_iframe');
        const btnCancel = document.getElementById('btn_cancel');
        
        // Simpan nilai awal URL untuk fitur tombol 'Kembalikan Semula'
        const initialUrl = urlInput.value;

        // Fungsi mengekstrak ID unik video YouTube
        function getYouTubeId(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }

        // Fungsi untuk memperbarui iframe preview
        function updatePreview() {
            const url = urlInput.value.trim();
            const videoId = getYouTubeId(url);

            if (videoId) {
                iframe.src = `https://www.youtube.com/embed/${videoId}`;
                previewContainer.classList.remove('d-none');
            } else {
                iframe.src = '';
                previewContainer.classList.add('d-none');
            }
        }

        // 1. Jalankan fungsi preview pertama kali saat halaman selesai dimuat (Load data lama)
        updatePreview();

        // 2. Jalankan fungsi ketika Admin mengubah isi input field (Ketik/Paste)
        urlInput.addEventListener('input', updatePreview);

        // 3. Logika tombol kembalikan ke data awal semula
        btnCancel.addEventListener('click', function() {
            urlInput.value = initialUrl;
            updatePreview();
        });
    });
</script>

<script>
    lucide.createIcons();
</script>
@endsection