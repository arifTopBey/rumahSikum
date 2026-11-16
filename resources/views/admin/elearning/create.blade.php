@extends('admin.main.main')

@section('content')
    <div class="container-fluid px-4 py-4 bg-light min-vh-100">

        {{-- Alert Section --}}
        @if ($errors->any())
            <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success rounded-3 border-0 shadow-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.elearning.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Header Navigation & Action --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Tambah Materi E-Learning</h4>
                    <p class="text-muted small mb-0">Publikasikan konten video, e-book, atau pelatihan mandiri untuk UMKM.
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.elearning.index') }}"
                        class="btn btn-white bg-white rounded-3 px-4 fw-semibold border shadow-sm">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-semibold shadow-sm">Simpan &
                        Publikasikan</button>
                </div>
            </div>

            <div class="row g-4">
                {{-- Main Column (Left) --}}
                <div class="col-lg-8">

                    {{-- SECTION 1: INFORMASI DASAR --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-section bg-danger bg-opacity-10 text-danger rounded-3 p-2 d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i data-lucide="info" size="22"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Informasi Dasar</h6>
                                <small class="text-muted">Judul & kategori e-learning</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small">Judul E-Learning <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="judul_event" class="form-control rounded-3 py-2"
                                placeholder="cth: Optimasi Penjualan Melalui TikTok Shop 2026" required>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold text-dark small">Kategori <span
                                    class="text-danger">*</span></label>
                            <select name="kategori_organizer_id" class="form-select rounded-3 py-2" required>
                                <option value="">— Pilih Kategori —</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- SECTION 2: METADATA & DURASI --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-section bg-primary bg-opacity-10 text-primary rounded-3 p-2 d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i data-lucide="calendar" size="22"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Jadwal</h6>
                                <small class="text-muted">Jadwal Event Berlangsung</small>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Mulai <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="waktu_mulai" class="form-control rounded-3 py-2"
                                    placeholder="cth: 11:00" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Selesai <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="waktu_selesai" class="form-control rounded-3 py-2"
                                    placeholder="cth: 12:00" required>

                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: JENIS PELATIHAN --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="icon-section bg-success bg-opacity-10 text-success rounded-3 p-2 d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i data-lucide="graduation-cap" size="22"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Jenis Pelatihan</h6>
                                <small class="text-muted">Pilih format atau ketersediaan e-learning ini</small>
                            </div>
                        </div>

                        {{-- Cards Selector --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_online" value="online"
                                    checked autocomplete="off">
                                <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100"
                                    for="type_online">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i data-lucide="video" class="option-icon" size="20"></i>
                                        <span class="fw-bold text-dark option-title">Online</span>
                                    </div>
                                    <span class="text-muted smaller d-block">Streaming mandiri</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_webinar"
                                    value="webinar" autocomplete="off">
                                <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100"
                                    for="type_webinar">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i data-lucide="radio" class="option-icon" size="20"></i>
                                        <span class="fw-bold text-dark option-title">Webinar</span>
                                    </div>
                                    <span class="text-muted smaller d-block">Seminar daring live</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_offline"
                                    value="offline" autocomplete="off">
                                <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100"
                                    for="type_offline">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i data-lucide="building-2" class="option-icon" size="20"></i>
                                        <span class="fw-bold text-dark option-title">Offline</span>
                                    </div>
                                    <span class="text-muted smaller d-block">Tatap muka / venue</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_workshop"
                                    value="workshop" autocomplete="off">
                                <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100"
                                    for="type_workshop">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i data-lucide="square-scissors" class="option-icon" size="20"></i>
                                        <span class="fw-bold text-dark option-title">Workshop</span>
                                    </div>
                                    <span class="text-muted smaller d-block">Praktik Dilokasi</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_bootcamp"
                                    value="bootcamp" autocomplete="off">
                                <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100"
                                    for="type_bootcamp">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i data-lucide="rocket" class="option-icon" size="20"></i>
                                        <span class="fw-bold text-dark option-title">Bootcamp</span>
                                    </div>
                                    <span class="text-muted smaller d-block">Intensif Dilokasi</span>
                                </label>
                            </div>
                        </div>

                    </div>

                     {{-- SECTION 4: Nama Venue --}}
                      <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-section bg-primary bg-opacity-10 text-primary rounded-3 p-2 d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i data-lucide="calendar" size="22"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Venue</h6>
                                <!-- <small class="text-muted">Jadwal Event Berlangsung</small> -->
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Nama Venue <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_venue" class="form-control rounded-3 py-2"
                                    placeholder="cth: Alun-alun Tigaraksa" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Kota <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="kota" class="form-control rounded-3 py-2"
                                    placeholder="masukan nama kota/Kab" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Provinsi <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="provinsi" class="form-control rounded-3 py-2"
                                    placeholder="cth: 12:00" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Kouta Peserta <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="kuota_peserta" class="form-control rounded-3 py-2"
                                    placeholder="masukan batas jumlah peserta" required>

                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-dark small">Alamat Lengkap <span
                                        class="text-danger">*</span></label>
                               <textarea name="alamat_lengkap" id="" class="form-control rounded-3 py-2 px-2"></textarea>

                            </div>
                        </div>
                    </div>

                    {{-- SECTION 5: DESKRIPSI & BANNER --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-section bg-warning bg-opacity-10 text-warning rounded-3 p-2 d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i data-lucide="image" size="22"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Deskripsi & Banner</h6>
                                <small class="text-muted">Buat e-learning kamu lebih menarik</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark small">Deskripsi E-Learning</label>
                            <textarea id="editor" name="deskripsi_event"
                                placeholder="Ceritakan tentang materi ini — apa yang akan didapat peserta..."></textarea>
                        </div>

                        <div>
                            <label class="form-label fw-semibold text-dark small">Banner / Thumbnail E-Learning</label>
                            <div
                                class="upload-dropzone border border-2 border-dashed rounded-4 p-4 text-center position-relative bg-light">
                                <img id="preview-thumbnail" src="" class="img-fluid rounded-3 mb-3 d-none shadow-sm"
                                    style="max-height: auto; width: 100%; object-fit: cover;" />

                                <div id="placeholder-thumbnail" class="py-3">
                                    <div class="upload-icon-wrapper mb-2">
                                        <i data-lucide="upload-cloud" size="36" class="text-muted mx-auto"></i>
                                    </div>
                                    <p class="fw-bold text-dark mb-1">Klik untuk pilih gambar</p>
                                    <span class="text-muted smaller">Rekomendasi 1400x490px · JPG/PNG/JPEG · maks
                                        20MB</span>
                                </div>
                                <input id="thumbnail-input" type="file" name="banner_event"
                                    class="position-absolute w-100 h-100 top-0 start-0 opacity-0" style="cursor: pointer;">
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Sidebar Column (Right) --}}
                <div class="col-lg-4">

                    <!-- TIPS E-LEARNING CARD (Dark Theme) -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-white" style="background-color: #111827;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="fs-5">💡</span>
                            <h6 class="fw-bold mb-0 text-white fs-5">Tips E-Learning Sukses</h6>
                        </div>
                        <p class="text-secondary smaller mb-4" style="color: #9ca3af !important;">Tarik lebih banyak peserta
                            UMKM</p>

                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start gap-2">
                                <i data-lucide="check-circle-2" class="text-success flex-shrink-0 mt-1" size="18"></i>
                                <span class="smaller" style="color: #d1d5db;">
                                    Gunakan <strong class="text-white">judul yang jelas</strong> dan menarik perhatian.
                                </span>
                            </div>

                            <div class="d-flex align-items-start gap-2">
                                <i data-lucide="check-circle-2" class="text-success flex-shrink-0 mt-1" size="18"></i>
                                <span class="smaller" style="color: #d1d5db;">
                                    Upload <strong class="text-white">banner berkualitas</strong> rasio 1400×490px agar
                                    tampil rapi.
                                </span>
                            </div>

                            <div class="d-flex align-items-start gap-2">
                                <i data-lucide="check-circle-2" class="text-success flex-shrink-0 mt-1" size="18"></i>
                                <span class="smaller" style="color: #d1d5db;">
                                    Tulis <strong class="text-white">deskripsi lengkap</strong> — tujuan, silabus, dan
                                    benefit.
                                </span>
                            </div>

                            <div class="d-flex align-items-start gap-2">
                                <i data-lucide="check-circle-2" class="text-success flex-shrink-0 mt-1" size="18"></i>
                                <span class="smaller" style="color: #d1d5db;">
                                    Pastikan <strong class="text-white">link video / modul</strong> dapat diakses dengan
                                    baik.
                                </span>
                            </div>
                        </div>

                        <hr class="my-4 border-secondary opacity-25">

                        <div class="d-flex align-items-start gap-2">
                            <i data-lucide="info" class="text-info flex-shrink-0 mt-1" size="18"></i>
                            <span class="smaller" style="color: #9ca3af;">
                                Materi yang dipublikasikan akan langsung tampil di katalog <strong
                                    class="text-warning">Akademi Digital</strong> peserta.
                            </span>
                        </div>
                    </div>


                    {{-- PUBLISH CARD --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <div class="form-check form-switch d-flex align-items-center justify-content-between ps-0 mb-2">
                            <label class="form-check-label fw-bold text-dark cursor-pointer" for="isActive">Publikasikan
                                Langsung</label>
                            <input class="form-check-input ms-0" type="checkbox" name="is_publish" id="isActive"
                                style="width: 2.8em; height: 1.4em;" checked>
                        </div>
                        <small class="text-muted d-block mt-2">Jika dinonaktifkan, materi akan disimpan sebagai draft &
                            tidak tampil di katalog publik.</small>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <style>
        .smaller {
            font-size: 0.78rem;
        }

        .ck-editor__editable {
            min-height: 200px;
            border-bottom-left-radius: 12px !important;
            border-bottom-right-radius: 12px !important;
        }

        .ck-toolbar {
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }

        /* Option Card radio custom design */
        .option-card {
            border: 1px solid #e2e8f0;
            background-color: #fff;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }

        .option-card:hover {
            border-color: #cbd5e1;
            background-color: #f8fafc;
        }

        .btn-check:checked+.option-card {
            border-color: #dc3545 !important;
            /* Warna accent border merah sesuai gambar */
            background-color: #fff5f5 !important;
        }

        .btn-check:checked+.option-card .option-icon,
        .btn-check:checked+.option-card .option-title {
            color: #dc3545 !important;
        }

        .upload-dropzone {
            background-color: #f8fafc;
            border-color: #cbd5e1 !important;
            transition: background-color 0.2s ease;
        }

        .upload-dropzone:hover {
            background-color: #f1f5f9;
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lucide Icons Render
            lucide.createIcons();

            // CKEditor 5
            ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });

            // Live Preview Thumbnail
            const thumbnailInput = document.getElementById('thumbnail-input');
            const previewThumbnail = document.getElementById('preview-thumbnail');
            const placeholderThumbnail = document.getElementById('placeholder-thumbnail');

            thumbnailInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewThumbnail.src = e.target.result;
                        previewThumbnail.classList.remove('d-none');
                        placeholderThumbnail.classList.add('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection