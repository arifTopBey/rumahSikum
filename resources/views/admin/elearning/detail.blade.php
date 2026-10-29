@extends('admin.main.main')

@section('content')
<div class="container-fluid px-4 py-4 bg-light min-vh-100">

    {{-- Alert Notifications --}}
    @if (session('success'))
        <div class="alert alert-success rounded-3 border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header Navigation & Action --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Kelola E-Learning: {{ $elearning->judul_event }}</h4>
            <p class="text-muted small mb-0">Detail informasi materi dan menu pengelolaan modul e-learning.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.elearning.index') }}" class="btn btn-white bg-white rounded-3 px-4 fw-semibold border shadow-sm">Kembali</a>
            <button type="submit" form="form-update-elearning" class="btn btn-primary rounded-3 px-4 fw-semibold shadow-sm">Simpan Perubahan</button>
        </div>
    </div>

    <form id="form-update-elearning" action="{{ route('admin.elearning.update', $elearning->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Main Column (Left) --}}
            <div class="col-lg-8">

                {{-- SECTION 1: INFORMASI DASAR --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-section bg-danger bg-opacity-10 text-danger rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i data-lucide="info" size="22"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Informasi Dasar</h6>
                            <small class="text-muted">Judul & kategori event</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Judul Event <span class="text-danger">*</span></label>
                        <input type="text" name="judul_event" class="form-control rounded-3 py-2" value="{{ old('judul_event', $elearning->judul_event) }}" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold text-dark small">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori_organizer_id" class="form-select rounded-3 py-2" required>
                            <option value="">— Pilih Kategori —</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $elearning->kategori_organizer_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- SECTION 2: JADWAL --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-section bg-primary bg-opacity-10 text-primary rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i data-lucide="calendar" size="22"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Jadwal</h6>
                            <small class="text-muted">Kapan event berlangsung</small>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="waktu_mulai" class="form-control rounded-3 py-2" value="{{ old('waktu_mulai', \Carbon\Carbon::parse($elearning->waktu_mulai)->format('Y-m-d\TH:i')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Selesai <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="waktu_selesai" class="form-control rounded-3 py-2" value="{{ old('waktu_selesai', \Carbon\Carbon::parse($elearning->waktu_selesai)->format('Y-m-d\TH:i')) }}" required>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: JENIS PELATIHAN & LINK / VENUE --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-section bg-success bg-opacity-10 text-success rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i data-lucide="graduation-cap" size="22"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Jenis Pelatihan</h6>
                            <small class="text-muted">Online & Webinar pakai link streaming, sisanya pakai venue</small>
                        </div>
                    </div>

                    {{-- Cards Selector --}}
                    <div class="row g-3 mb-4">
                        @php $jenis = $elearning->jenis_pelatihan; @endphp
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_online" value="online" {{ $jenis == 'online' ? 'checked' : '' }}>
                            <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100" for="type_online">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i data-lucide="video" class="option-icon text-danger" size="20"></i>
                                    <span class="fw-bold text-dark option-title">Online</span>
                                </div>
                                <span class="text-muted smaller d-block">Streaming daring</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_offline" value="offline" {{ $jenis == 'offline' ? 'checked' : '' }}>
                            <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100" for="type_offline">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i data-lucide="building-2" class="option-icon" size="20"></i>
                                    <span class="fw-bold text-dark option-title">Offline</span>
                                </div>
                                <span class="text-muted smaller d-block">Di lokasi / venue</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_webinar" value="webinar" {{ $jenis == 'webinar' ? 'checked' : '' }}>
                            <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100" for="type_webinar">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i data-lucide="radio" class="option-icon" size="20"></i>
                                    <span class="fw-bold text-dark option-title">Webinar</span>
                                </div>
                                <span class="text-muted smaller d-block">Seminar daring</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_workshop" value="workshop" {{ $jenis == 'workshop' ? 'checked' : '' }}>
                            <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100" for="type_workshop">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i data-lucide="scissors" class="option-icon" size="20"></i>
                                    <span class="fw-bold text-dark option-title">Workshop</span>
                                </div>
                                <span class="text-muted smaller d-block">Praktik di lokasi</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="jenis_pelatihan" id="type_bootcamp" value="bootcamp" {{ $jenis == 'bootcamp' ? 'checked' : '' }}>
                            <label class="btn btn-outline-light text-start p-3 rounded-3 w-100 option-card h-100" for="type_bootcamp">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i data-lucide="rocket" class="option-icon" size="20"></i>
                                    <span class="fw-bold text-dark option-title">Bootcamp</span>
                                </div>
                                <span class="text-muted smaller d-block">Intensif di lokasi</span>
                            </label>
                        </div>
                    </div>

                    {{-- Link Streaming / Location Details --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Link Streaming</label>
                        <input type="url" name="link_streaming" class="form-control rounded-3 py-2" value="{{ old('link_streaming', $elearning->link_streaming ?? 'https://meet.google.com/xuk-jdmg-qte') }}" placeholder="https://meet.google.com/...">
                        <span class="text-muted smaller">Link akan tampil untuk peserta yang sudah mendaftar.</span>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold text-dark small">Kuota Peserta</label>
                        <input type="number" name="kuota_peserta" class="form-control rounded-3 py-2" value="{{ old('kuota_peserta', $elearning->kuota_peserta ?? 1000) }}" placeholder="0" style="max-width: 200px;">
                        <span class="text-muted smaller">Isi <strong>0</strong> untuk tanpa batas.</span>
                    </div>
                </div>

                {{-- SECTION 4: DESKRIPSI & BANNER --}}
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-section bg-warning bg-opacity-10 text-warning rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i data-lucide="image" size="22"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Deskripsi & Banner</h6>
                            <small class="text-muted">Buat event-mu menarik</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark small">Deskripsi Event</label>
                        <textarea id="editor" name="deskripsi_event">{{ old('deskripsi_event', $elearning->deskripsi_event) }}</textarea>
                    </div>

                    <div>
                        <label class="form-label fw-semibold text-dark small">Banner / Poster Event</label>
                        <div class="position-relative rounded-4 overflow-hidden mb-2 border shadow-sm">
                            <img id="preview-banner" src="{{ asset('storage/' . $elearning->banner_event) }}" class="w-100 object-fit-cover" style="max-height: 380px;" alt="Banner Event">
                        </div>
                        <input type="file" name="banner_event" id="banner-input" class="form-control rounded-3 py-2 mt-2" accept="image/*">
                    </div>
                </div>

            </div>

            {{-- Sidebar Column (Right) --}}
            <div class="col-lg-4">

                {{-- CARD 1: RINGKASAN EVENT --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="trending-up" class="text-danger" size="18"></i> Ringkasan Event
                    </h6>

                    <div class="row g-2 text-center">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <h3 class="fw-bold text-dark mb-0">{{ $elearning->peserta_count ?? 1 }}</h3>
                                <span class="text-muted smaller">Peserta Terdaftar</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <h3 class="fw-bold text-dark mb-0">{{ $elearning->views_count ?? 10 }}</h3>
                                <span class="text-muted smaller">Dilihat</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 2: AKSI LAIN (MENU KELOLA MATERI DLL) --}}
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <h6 class="fw-bold text-dark mb-3 px-2 pt-2 d-flex align-items-center gap-2">
                        <i data-lucide="layout-grid" class="text-danger" size="18"></i> Aksi Lain
                    </h6>

                    <div class="list-group list-group-flush gap-1">
                        {{-- Menu Kelola Materi Pelatihan --}}
                        <a href="{{ route('admin.elearning.materials', $elearning->id) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between border-0 rounded-3 p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light p-2 rounded-3 d-flex align-items-center justify-content-center text-muted">
                                    <i data-lucide="archive" size="18"></i>
                                </div>
                                <span class="fw-semibold text-dark small">Materi Pelatihan</span>
                            </div>
                            <i data-lucide="chevron-right" size="16" class="text-muted"></i>
                        </a>

                        {{-- Menu Kelola Narasumber --}}
                        <a href="{{ route('admin.elearning.mentors', $elearning->id) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between border-0 rounded-3 p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light p-2 rounded-3 d-flex align-items-center justify-content-center text-muted">
                                    <i data-lucide="smartphone" size="18"></i>
                                </div>
                                <span class="fw-semibold text-dark small">Narasumber</span>
                            </div>
                            <i data-lucide="chevron-right" size="16" class="text-muted"></i>
                        </a>

                        {{-- Menu Daftar Peserta --}}
                        <a href="{{ route('admin.elearning.participants', $elearning->id) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between border-0 rounded-3 p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light p-2 rounded-3 d-flex align-items-center justify-content-center text-muted">
                                    <i data-lucide="users" size="18"></i>
                                </div>
                                <span class="fw-semibold text-dark small">Daftar Peserta</span>
                            </div>
                            <i data-lucide="chevron-right" size="16" class="text-muted"></i>
                        </a>

                        {{-- Menu Lihat Halaman Publik --}}
                        <a href="{{ route('elearning.show', $elearning->id) }}" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between border-0 rounded-3 p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light p-2 rounded-3 d-flex align-items-center justify-content-center text-muted">
                                    <i data-lucide="external-link" size="18"></i>
                                </div>
                                <span class="fw-semibold text-dark small">Lihat Halaman Publik</span>
                            </div>
                            <i data-lucide="chevron-right" size="16" class="text-muted"></i>
                        </a>
                    </div>
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
        min-height: 180px;
        border-bottom-left-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }

    .ck-toolbar {
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
    }

    /* Option Card radio design */
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

    .btn-check:checked + .option-card {
        border-color: #dc3545 !important;
        background-color: #fff5f5 !important;
    }

    .btn-check:checked + .option-card .option-icon,
    .btn-check:checked + .option-card .option-title {
        color: #dc3545 !important;
    }

    /* Hover effect list group Aksi Lain */
    .list-group-item-action:hover {
        background-color: #f8fafc;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Render Icons
        lucide.createIcons();

        // CKEditor Init
        ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });

        // Banner Image Live Change Preview
        const bannerInput = document.getElementById('banner-input');
        const previewBanner = document.getElementById('preview-banner');

        if (bannerInput) {
            bannerInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewBanner.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection