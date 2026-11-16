@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light min-vh-100 pb-5" style="margin-top: 20px;">

    <!-- HEADER UTAMA -->
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-800 text-dark mb-1">Kelola Video Profil</h4>
                <p class="text-muted small mb-0">Atur dan pilih video profil yang akan ditampilkan pada halaman beranda utama sistem.</p>
            </div>
            <div>

                <a href="{{ route('admin.profil-beranda.create') }}" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                    <i data-lucide="plus-circle" size="18"></i> Unggah Video Baru
                </a>
            </div>
        </div>
    </div>

    <!-- TABEL UTAMA -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
         @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="ps-4" style="width: 80px;">NO</th>
                        <th>PRATINJAU VIDEO (PREVIEW)</th>
                        <th>NAMA FILE / URL</th>
                        <th>TANGGAL UNGGAH</th>
                        <th class="pe-4 text-end" style="width: 150px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh Data Loop 1 (Aktif) -->
                    <!-- <tr class="video-row">
                        <td class="ps-4 fw-bold text-secondary">1</td>
                        <td>
                            <div class="video-preview-box rounded-3 overflow-hidden border shadow-sm position-relative">
                                <video width="160" height="90" muted controls class="bg-dark">
                                    <source src="https://assets.mixkit.co/videos/preview/mixkit-indonesian-traditional-dance-performance-41584-large.mp4" type="video/mp4">
                                    Browser tidak mendukung video preview.
                                </video>
                                <span class="badge bg-success position-absolute top-0 start-0 m-2 shadow-sm smaller-badge">Aktif di Beranda</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="small fw-bold text-dark">video-profil-umkm-tangerang-2026.mp4</span>
                                <span class="smaller text-muted">Format: MP4 • Ukuran: 14.2 MB</span>
                            </div>
                        </td>
                        <td>
                            <span class="small text-muted">09 Juli 2026</span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-light btn-sm rounded-3 text-secondary p-2" title="Ganti Video">
                                    <i data-lucide="edit-2" size="16"></i>
                                </button>
                                <button class="btn btn-light btn-sm rounded-3 text-danger p-2" title="Hapus Video" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                                    <i data-lucide="trash-2" size="16"></i>
                                </button>
                            </div>
                        </td>
                    </tr> -->


                    @forelse ($profiBeranda as $video)
                    @php
                    // Helper untuk mengubah berbagai format link YouTube menjadi format EMBED agar bisa diputar di iframe
                    $url = $video->video_youtube;
                    $videoId = null;

                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match)) {
                    $videoId = $match[1];
                    }

                    $embedUrl = $videoId ? "https://www.youtube.com/embed/" . $videoId : $url;
                    @endphp
                    <tr class="video-row">
                        <td class="ps-4 fw-bold text-secondary">{{ $loop->iteration }}</td>
                        <td>
                            <div class="video-preview-box rounded-3 overflow-hidden border shadow-sm position-relative">
                                <!-- <video width="160" height="90" muted controls class="bg-dark">
                                    <source src="{{ $video->video_youtube }}" type="video/mp4">
                                </video> -->
                                <!-- <iframe width="160" height="90" src="{{ $video->video_youtube }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                                @if($videoId)
                                <!-- Menggunakan $embedUrl yang sudah dikonversi -->
                                 <iframe width="160" height="90" src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-dark text-white smaller px-2 text-center">
                                        Format Link Salah
                                    </div>
                                @endif
                                <!-- <span class="badge bg-secondary position-absolute top-0 start-0 m-2 shadow-sm smaller-badge">Draft</span> -->
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="small fw-bold text-dark">{{ $video->video_youtube }}</span>
                                <!-- <span class="smaller text-muted">Format: MP4 • Ukuran: 8.5 MB</span> -->
                            </div>
                        </td>
                        <td>
                            <span class="small text-muted">{{ $video->created_at->format('d F Y') }}</span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <!-- <button class="btn btn-primary btn-sm rounded-3 px-3 py-2 fw-bold smaller-badge" title="Aktifkan Video">
                                    Aktifkan
                                </button> -->
                                <a href="{{ route('admin.profil-beranda.edit', $video->id) }}" class="btn btn-light btn-sm rounded-3 text-secondary p-2" title="Ganti Video">
                                    <i data-lucide="edit-2" size="16"></i>
                                </a>
                                <form id="delete-form-{{ $video->id }}" action="{{ route('admin.profil-beranda.destroy', $video->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="confirmDelete('{{ $video->id }}', '{{ $video->id }}')"  type="button" class="btn btn-light btn-sm rounded-3 text-danger p-2" title="Hapus Video" >
                                        <i data-lucide="trash-2" size="16"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <span class="text-muted">Tidak ada video yang tersedia.</span>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambahan CSS Khusus -->
<style>
    .fw-800 {
        font-weight: 800;
    }

    .smaller {
        font-size: 0.75rem;
    }

    .smaller-badge {
        font-size: 0.68rem;
        font-weight: 700;
    }

    /* Pengaturan Header Tabel */
    .table-header-custom tr {
        display: table-row !important;
    }

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

    /* Pengaturan Baris Body Tabel */
    .video-row {
        display: table-row !important;
    }

    .video-row td {
        display: table-cell !important;
        border-bottom: 1px solid #f1f5f9;
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    /* Box Player Video Preview */
    .video-preview-box {
        width: 160px;
        height: 90px;
        background-color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-preview-box video {
        object-fit: cover;
    }
</style>

<script>
    lucide.createIcons();
</script>
@endsection