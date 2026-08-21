@extends('admin.main.main')

@section('content')
<div class="container-fluid px-4 py-4 bg-light min-vh-100">

    {{-- Alert Section --}}
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

    {{-- Header Navigation --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="" class="btn btn-white bg-white rounded-circle shadow-sm p-2 d-flex align-items-center justify-content-center border" style="width: 40px; height: 40px;">
            <i data-lucide="arrow-left" size="20" class="text-dark"></i>
        </a>
        <div>
            <h4 class="fw-bold text-dark mb-0">{{ $elearning->judul_event ?? 'Fellonge 2026' }}</h4>
            <p class="text-muted small mb-0">Kelola materi pelatihan (PDF, PPT, Video, Modul, Tugas)</p>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left Column: Form Tambah Materi --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <i data-lucide="plus-circle" class="text-danger" size="20"></i>
                    <h6 class="fw-bold mb-0 text-dark">Tambah Materi</h6>
                </div>

                <form action="{{ route('admin.elearning.materi.store', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Tipe Materi <span class="text-danger">*</span></label>
                        <select name="tipe_materi" class="form-select rounded-3 py-2" required>
                            <option value="">Pilih tipe...</option>
                            <option value="PDF">PDF</option>
                            <option value="PPT">PPT (Presentasi)</option>
                            <option value="Video">Video Streaming</option>
                            <option value="Modul">Modul / Dokumen</option>
                            <option value="Tugas">Tugas</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control rounded-3 py-2" placeholder="cth: Materi Sesi 1 - Dasar Branding" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control rounded-3 py-2" rows="3" placeholder="Opsional"></textarea>
                    </div>

                    <!-- <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">File <span class="text-muted fw-normal">(PDF/PPT/DOC/XLS/MP4/ZIP, maks 20MB)</span></label>
                        <input type="file" name="file_materi" class="form-control rounded-3 py-2">
                    </div> -->

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">atau Tautan <span class="text-muted fw-normal">(mis. link Video/Drive)</span></label>
                        <input type="url" name="tautan" class="form-control rounded-3 py-2" placeholder="https://...">
                    </div>

                    <p class="text-muted smaller mb-4">Isi <strong>file</strong> atau <strong>tautan</strong> (minimal salah satu). Untuk Video, biasanya pakai tautan.</p>

                    <button type="submit" class="btn btn-danger w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <i data-lucide="upload" size="18"></i>
                        Simpan Materi
                    </button>
                </form>
            </div>
        </div>

        {{-- Right Column: Daftar Materi --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <i data-lucide="archive" class="text-danger" size="20"></i>
                    <h6 class="fw-bold mb-0 text-dark">Daftar Materi ({{ count($materials ?? [1, 2]) }})</h6>
                </div>

           
                <div class="d-flex flex-column gap-3">
                    {{-- Item 1 --}}

                     @foreach ($materi as $e )
                        <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-white hover-shadow transition">
                            <div class="d-flex align-items-center gap-3">

                                  @if ($e->tipe_materi == 'Modul')
                                    <div class="icon-materi bg-secondary bg-opacity-10 text-muted rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                        <i data-lucide="clipboard-check" size="22"></i>
                                    </div>
                                  @elseif($e->tipe_materi == 'Tugas')
                                    <div class="icon-materi bg-success bg-opacity-10 text-success rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                        <i data-lucide="clipboard-check" size="22"></i>
                                    </div>
                                 @elseif($e->tipe_materi == 'PPT')
                                     <div class="icon-materi bg-warning bg-opacity-10 text-warning rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                        <i data-lucide="file" size="22"></i>
                                    </div>
                                  @elseif($e->tipe_materi == 'Video')
                                   <div class="icon-materi bg-danger bg-opacity-10 text-danger rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                        <i data-lucide="play" size="22"></i>
                                    </div>
                                    @elseif($e->tipe_materi == 'PDF')
                                    <div class="icon-materi bg-danger bg-opacity-10 text-danger rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                         <i data-lucide="file" size="22"></i>
                                     </div>
                                     @else
                                       <div class="icon-materi bg-secondary bg-opacity-10 text-muted rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                        <i data-lucide="clipboard-check" size="22"></i>
                                    </div>
                                @endif
                                <div>
                                        <h6 class="fw-bold text-dark mb-1 small">{{ $e->judul }}</h6>
                                    @if ($e->tipe_materi == 'Modul')
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-secondary bg-opacity-10 text-muted fw-bold px-2 py-1 smaller">Modul</span>
                                            <span class="text-muted smaller">• OK</span>
                                        </div>
                                    @elseif($e->tipe_materi == 'Tugas')
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2 py-1 smaller">Tugas</span>
                                            <span class="text-muted smaller">• OK</span>
                                        </div>
                                    @elseif($e->tipe_materi == 'PPT')
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-warning bg-opacity-10 text-warning fw-bold px-2 py-1 smaller">PPT</span>
                                            <span class="text-muted smaller">• OK</span>
                                        </div>
                                    @elseif($e->tipe_materi == 'Video')
                                    <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-2 py-1 smaller">Video</span>
                                            <span class="text-muted smaller">• OK</span>
                                        </div>
                                        @elseif($e->tipe_materi == 'PDF')
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-2 py-1 smaller">PDF</span>
                                            <span class="text-muted smaller">• OK</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ $e->tautan }}" class="btn btn-light btn-sm rounded-2 text-muted border p-2" target="_blank" title="Buka Link / File">
                                    <i data-lucide="external-link" size="16"></i>
                                </a>
                                <form id="delete-form-{{ $e->id }}" action="{{route('admin.elearning.materi.delete', [$event->id, $e->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="confirmDelete('{{ $e->id }}', '{{ $e->judul }}')" type="button" class="btn btn-light btn-sm rounded-2 text-danger border p-2" title="Hapus">
                                        <i data-lucide="trash-2" size="16"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                     @endforeach

                    {{-- Item 2 --}}
                    <!-- <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-white hover-shadow transition">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-materi bg-warning bg-opacity-10 text-warning rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                <i data-lucide="file-text" size="22"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1 small">Materi Sesi 2</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-warning bg-opacity-10 text-warning fw-bold px-2 py-1 smaller">PPT</span>
                                    <span class="text-muted smaller">• OK</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="#" class="btn btn-light btn-sm rounded-2 text-muted border p-2" title="Buka Link / File">
                                <i data-lucide="external-link" size="16"></i>
                            </a>
                            <form action="#" method="POST" onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm rounded-2 text-danger border p-2" title="Hapus">
                                    <i data-lucide="trash-2" size="16"></i>
                                </button>
                            </form>
                        </div>
                    </div> -->

                    {{-- Empty State (Jika Data Kosong) --}}
                    @if(isset($materials) && count($materials) == 0)
                        <div class="text-center py-5">
                            <i data-lucide="folder-open" size="48" class="text-muted mb-2 opacity-50"></i>
                            <p class="text-muted small mb-0">Belum ada materi pelatihan yang diunggah.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
    .transition { transition: all 0.2s ease; }
    .hover-shadow:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-color: #cbd5e1 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection