@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light min-vh-100 pb-5" style="margin-top: 20px;">
    
    <div class="row pt-5 mb-4">
        <div class="col-md-12 mx-auto d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-800 text-dark mb-1">Tambah Video Profil</h4>
                <p class="text-muted small mb-0">Kelola sumber video profil (YouTube atau Video Lokal) untuk beranda utama.</p>
            </div>
            <div>
                <a href="{{ route('admin.profil-beranda.index') }}" class="btn btn-white border rounded-3 px-3 fw-bold shadow-sm small">
                    <i data-lucide="arrow-left" size="16" class="me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <form action="{{ route('admin.profil-beranda.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4 bg-light p-3 rounded-3 border">
                        <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Sumber Video yang Aktif di Frontend</label>
                        <div class="d-flex gap-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="active_youtube" value="1" checked>
                                <label class="form-check-label small fw-bold text-dark" for="active_youtube">
                                    <span class="text-danger">●</span> Gunakan YouTube
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="active_local" value="0">
                                <label class="form-check-label small fw-bold text-dark" for="active_local">
                                    <span class="text-primary">●</span> Gunakan Video Lokal (Upload)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-6 border-end">
                            
                            <div class="mb-4">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Tautan Video YouTube</label>
                                <div class="input-group border-2 rounded-3 overflow-hidden bg-light">
                                    <span class="input-group-text bg-light border-0 pe-2 text-danger">
                                        <i data-lucide="youtube" size="20"></i>
                                    </span>
                                    <input type="text" id="youtube_url" name="video_youtube" class="form-control border-0 bg-light py-2 small" 
                                           placeholder="Contoh: https://www.youtube.com/watch?v=xxxxxx" autocomplete="off">
                                </div>
                                <div class="form-text smaller text-muted mt-1">Isi jika Anda memilih sumber YouTube.</div>
                            </div>

                            <div class="mb-4">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Unggah Video Lokal (Komp/HP)</label>
                                <div class="input-group border-2 rounded-3 overflow-hidden bg-light p-1">
                                    <input type="file" id="local_video_input" name="video_local" class="form-control border-0 bg-light py-1 small" accept="video/mp4,video/mkv">
                                </div>
                                <div class="form-text smaller text-muted mt-1">Format wajib: MP4 Maksimal Ukuran 20MB.</div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            
                            <div id="preview_youtube_container" class="mb-4 d-none">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Pratinjau Video YouTube</label>
                                <div class="ratio ratio-16x9 rounded-4 overflow-hidden border shadow-sm bg-dark">
                                    <iframe id="youtube_iframe" src="" title="YouTube video player" frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                    </iframe>
                                </div>
                            </div>

                            <div id="preview_local_container" class="mb-4 d-none">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Pratinjau Video Lokal</label>
                                <div class="ratio ratio-16x9 rounded-4 overflow-hidden border shadow-sm bg-dark">
                                    <video id="local_video_player" controls muted class="w-100 h-100">
                                        <source src="" type="video/mp4">
                                        Browser Anda tidak mendukung pratinjau video.
                                    </video>
                                </div>
                            </div>

                            <div id="preview_placeholder" class="d-flex flex-column align-items-center justify-content-center border border-dashed rounded-4 p-5 text-muted" style="height: 220px;">
                                <i data-lucide="video" size="40" class="opacity-25 mb-2"></i>
                                <span class="smaller fw-medium">Belum ada video untuk ditampilkan</span>
                            </div>

                        </div>
                    </div>

                    <hr class="opacity-50 my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" id="btn_reset" class="btn btn-light rounded-3 fw-bold px-4 py-2 small">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3 fw-bold px-4 py-2 small shadow-sm">
                            <i data-lucide="save" size="16" class="me-1"></i> Simpan Video Profil
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
        // Elemen Input
        const youtubeInput = document.getElementById('youtube_url');
        const localInput = document.getElementById('local_video_input');
        const btnReset = document.getElementById('btn_reset');

        // Elemen Containers & Players
        const previewYoutubeContainer = document.getElementById('preview_youtube_container');
        const previewLocalContainer = document.getElementById('preview_local_container');
        const previewPlaceholder = document.getElementById('preview_placeholder');
        const youtubeIframe = document.getElementById('youtube_iframe');
        const localVideoPlayer = document.getElementById('local_video_player');

        // Mengatur visibility placeholder utama
        function checkPlaceholderVisibility() {
            if (previewYoutubeContainer.classList.contains('d-none') && previewLocalContainer.classList.contains('d-none')) {
                previewPlaceholder.classList.remove('d-none');
            } else {
                previewPlaceholder.classList.add('d-none');
            }
        }

        // --- 1. HANDLING LOGIKA YOUTUBE ---
        function getYouTubeId(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }

        youtubeInput.addEventListener('input', function() {
            const url = this.value.trim();
            const videoId = getYouTubeId(url);

            if (videoId) {
                youtubeIframe.src = `https://www.youtube.com/embed/${videoId}`;
                previewYoutubeContainer.classList.remove('d-none');
            } else {
                youtubeIframe.src = '';
                previewYoutubeContainer.classList.add('d-none');
            }
            checkPlaceholderVisibility();
        });


        // --- 2. HANDLING LOGIKA LOCAL VIDEO UPLOAD ---
        localInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                // Buat Blob URL sementara dari file lokal untuk preview player
                const fileURL = URL.createObjectURL(file);
                localVideoPlayer.src = fileURL;
                previewLocalContainer.classList.remove('d-none');
            } else {
                localVideoPlayer.src = '';
                previewLocalContainer.classList.add('d-none');
            }
            checkPlaceholderVisibility();
        });


        // --- 3. LOGIKA TOMBOL RESET ---
        btnReset.addEventListener('click', function() {
            youtubeIframe.src = '';
            localVideoPlayer.src = '';
            previewYoutubeContainer.classList.add('d-none');
            previewLocalContainer.classList.add('d-none');
            previewPlaceholder.classList.remove('d-none');
        });
    });
</script>

<script>
    lucide.createIcons();
</script>
@endsection