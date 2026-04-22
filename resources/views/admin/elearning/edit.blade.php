@extends('admin.main.main')

@section('content')
    <div class="container-fluid px-5 bg-white">

        @if ($errors->any())
            <div class="alert alert-danger mt-4 rounded-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.elearning.update', $elearning->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row py-5">
                <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-800 text-primary mb-1">Edit Materi: {{ $elearning->name }}</h4>
                        <p class="text-muted small mb-0">Perbarui konten video, e-book, atau informasi mentor untuk kelas
                            ini.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.elearning.index') }}"
                            class="btn btn-light rounded-pill px-4 fw-bold border">Batal</a>
                        <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold shadow text-white">Perbarui
                            Materi</button>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Judul Kelas E-Learning</label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-3 border-2"
                                value="{{ old('name', $elearning->name) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark d-block">Thumbnail Materi</label>
                            <div class="border border-2 border-dashed rounded-4 p-4 text-center bg-light position-relative">
                                {{-- Image Preview: Menampilkan data lama jika ada --}}
                                <img id="preview-thumbnail"
                                    src="{{ route('showFoto.elearning.thumnail.private', $elearning->thumbnail) }}"
                                    class="img-fluid rounded-3 mb-2 {{ $elearning->thumbnail ? '' : 'd-none' }}"
                                    style="max-height:200px; object-fit:cover;" />

                                <div id="placeholder-content" class="{{ $elearning->thumbnail ? 'd-none' : '' }}">
                                    <i data-lucide="image" size="32" class="text-muted mb-2"></i>
                                    <p class="smaller text-muted mb-0">Klik untuk mengganti gambar (Rasio 16:9)</p>
                                </div>
                                <input id="thumbnail-input" type="file" name="thumbnail"
                                    class="position-absolute w-100 h-100 top-0 start-0 opacity-0" style="cursor: pointer;">
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold text-dark">Deskripsi & Tujuan Pembelajaran</label>
                            <textarea id="editor"
                                name="deskripsi">{!! old('deskripsi', $elearning->deskripsi) !!}</textarea>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                            <i data-lucide="content" size="18" class="text-primary"></i> Konten Utama
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Link Video Utama (YouTube/Vimeo)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-2"><i data-lucide="youtube"
                                            size="16"></i></span>
                                    <input id="youtube-input" type="url" name="link_youtube" class="form-control border-2"
                                        value="{{ old('link_youtube', $elearning->link_youtube) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">File E-Book (PDF)</label>
                                <input type="file" name="pdf" class="form-control border-2" accept="application/pdf">
                                @if($elearning->pdf)
                                    <div class="mt-2 small">
                                        <a href="{{ route('showPdf.elearning.private', ['path' => $elearning->pdf]) }}"
                                            target="_blank" class="text-primary text-decoration-none">
                                            <i data-lucide="file-check" size="14"></i> Lihat PDF Saat Ini
                                        </a>
                                        <!-- <a href="{{ route('showPdf.elearning.private', $elearning->pdf) }}" target="_blank" class="text-primary text-decoration-none">
                                                <i data-lucide="file-check" size="14"></i> Lihat PDF Saat Ini
                                            </a> -->
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-3">
                                <div id="youtube-preview" class="mt-3 d-none">
                                    <p class="mt-2 text-muted fw-bold fs-3">Preview Video</p>
                                    <div class="ratio ratio-16x9">
                                        <iframe id="youtube-frame" src="" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                            <i data-lucide="list" size="18" class="text-primary"></i> Klasifikasi
                        </h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kategori</label>
                            <select name="kategori_elearning_id" class="form-select rounded-3">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $elearning->kategori_elearning_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold text-muted">Level</label>
                            <select name="level" class="form-select rounded-3">
                                <option value="semua level" {{ $elearning->level == 'semua level' ? 'selected' : '' }}>Semua
                                    Level</option>
                                <option value="pemula" {{ $elearning->level == 'pemula' ? 'selected' : '' }}>Pemula</option>
                                <option value="mahir" {{ $elearning->level == 'mahir' ? 'selected' : '' }}>Mahir</option>
                            </select>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h6 class="fw-800 mb-3 d-flex align-items-center gap-2">
                            <i data-lucide="info" size="18" class="text-primary"></i> Metadata
                        </h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Estimasi Waktu Belajar</label>
                            <div class="input-group">
                                <input type="number" name="durasi" class="form-control rounded-start-3"
                                    value="{{ old('durasi', $elearning->durasi) }}">
                                <span class="input-group-text">Menit</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-center bg-primary bg-opacity-10 border border-primary border-opacity-25">
                        @if($elearning->photo_mentor)
                            <!-- <img src="{{ route('showFoto.elearning.mentor.private', $elearning->photo_mentor) }}" class="rounded-circle mx-auto mb-3 shadow-sm border border-3 border-white" style="width: 80px; height: 80px; object-fit: cover;"> -->
                            <img id="preview-mentor"
                                src="{{ $elearning->photo_mentor ? route('showFoto.elearning.mentor.private', $elearning->photo_mentor) : '' }}"
                                class="rounded-circle mx-auto mb-3 shadow-sm border border-3 border-white {{ $elearning->photo_mentor ? '' : 'd-none' }}"
                                style="width: 80px; height: 80px; object-fit: cover;">

                            <div id="placeholder-mentor"
                                class="{{ $elearning->photo_mentor ? 'd-none' : '' }} mx-auto bg-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                                style="width: 80px; height: 80px;">
                                <i data-lucide="user-plus" size="32" class="text-primary"></i>
                            </div>
                        @else
                            <div class="mx-auto bg-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                                style="width: 80px; height: 80px;">
                                <i data-lucide="user-plus" size="32" class="text-primary"></i>
                            </div>
                        @endif

                        <h6 class="fw-800 mb-1">Informasi Mentor</h6>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-muted">Ganti Foto Mentor</label>
                            <input id="mentor-input" type="file" name="photo_mentor" class="form-control rounded-3 border-0 shadow-sm">
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-muted">Nama Mentor / Pengajar</label>
                            <input type="text" name="nama_mentor" class="form-control rounded-3 border-0 shadow-sm"
                                value="{{ old('nama_mentor', $elearning->nama_mentor) }}">
                        </div>
                        <div class="text-start">
                            <label class="form-label small fw-bold text-muted">Bidang Mentor</label>
                            <input type="text" name="bidang_menthor" class="form-control rounded-3 border-0 shadow-sm"
                                value="{{ old('bidang_menthor', $elearning->bidang_menthor) }}">
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary bg-opacity-10">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_publish" id="isActive" {{ $elearning->is_publish ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-primary" for="isActive">Publish E-learning</label>
                        </div>
                        <p class="smaller text-muted mb-0">Matikan untuk menyembunyikan dari publik sementara waktu.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        lucide.createIcons();
        ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });

        // Preview logic for Thumbnail
        document.getElementById('thumbnail-input').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview-thumbnail');
            const placeholder = document.getElementById('placeholder-content');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    if (placeholder) placeholder.classList.add('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /**
     * =========================
     * YOUTUBE PREVIEW
     * =========================
     */
    const ytInput = document.getElementById('youtube-input');
    const ytPreview = document.getElementById('youtube-preview');
    const ytFrame = document.getElementById('youtube-frame');

    function getYoutubeId(url) {
        const regExp = /(?:youtube\.com\/.*v=|youtu\.be\/)([^&]+)/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }

    function setYoutubePreview(url) {
        const videoId = getYoutubeId(url);
        if (videoId) {
            ytFrame.src = `https://www.youtube.com/embed/${videoId}`;
            ytPreview.classList.remove('d-none');
        } else {
            ytPreview.classList.add('d-none');
            ytFrame.src = '';
        }
    }

    // 🔥 INIT dari data lama
    if (ytInput.value) {
        setYoutubePreview(ytInput.value);
    }

    // 🔥 update realtime
    ytInput.addEventListener('input', function () {
        setYoutubePreview(ytInput.value);
    });


    /**
     * =========================
     * MENTOR PREVIEW
     * =========================
     */
    const mentorInput = document.getElementById('mentor-input');
    const mentorPreview = document.getElementById('preview-mentor');
    const mentorPlaceholder = document.getElementById('placeholder-mentor');

    mentorInput.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                mentorPreview.src = e.target.result;
                mentorPreview.classList.remove('d-none');
                mentorPlaceholder.classList.add('d-none');
            }

            reader.readAsDataURL(file);
        }
    });

});
</script>
    <style>
        .fw-800 {
            font-weight: 800;
        }

        .smaller {
            font-size: 0.75rem;
        }

        .ck-editor__editable {
            min-height: 250px;
            border-radius: 0 0 12px 12px !important;
        }
    </style>
@endsection