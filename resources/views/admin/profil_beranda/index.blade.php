@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light min-vh-100 pb-5" style="margin-top: 20px;">

    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-800 text-dark mb-1">Kelola Video Profil</h4>
                <p class="text-muted small mb-0">Atur dan pilih video profil yang akan ditampilkan pada halaman beranda utama sistem.</p>
            </div>
            <div>
                @if($profiBeranda->isEmpty())
                <a href="{{ route('admin.profil-beranda.create') }}" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                    <i data-lucide="plus-circle" size="18"></i> Unggah Video Baru
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 rounded-0 mb-0" role="alert">
                <div class="d-flex align-items-center gap-2 small fw-semibold">
                    <i data-lucide="alert-circle" size="18"></i> {{ session('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-0 mb-0" role="alert">
                <div class="d-flex align-items-center gap-2 small fw-semibold">
                    <i data-lucide="check-circle" size="18"></i> {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="ps-4" style="width: 80px;">NO</th>
                        <th>PRATINJAU VIDEO (PREVIEW)</th>
                        <th>SUMBER / TIPE DATA</th>
                        <th>TANGGAL UNGGAH</th>
                        <th class="pe-4 text-end" style="width: 150px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($profiBeranda as $video)
                    @php
                        $embedUrl = null;
                        $videoId = null;

                        // Ekstraksi ID YouTube jika data tersedia
                        if ($video->video_youtube) {
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $video->video_youtube, $match)) {
                                $videoId = $match[1];
                                $embedUrl = "https://www.youtube.com/embed/" . $videoId;
                            }
                        }
                    @endphp
                    <tr class="video-row">
                        <td class="ps-4 fw-bold text-secondary">{{ $loop->iteration }}</td>
                        <td>
                            <div class="video-preview-box rounded-3 overflow-hidden border shadow-sm position-relative" style="width: 160px; height: 90px; background-color: #000;">
                                @if($video->status == 1)
                                    @if($videoId)
                                        <iframe width="160" height="90" src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 bg-dark text-danger smaller px-2 text-center fw-bold">Link YouTube Rusak</div>
                                    @endif
                                @elseif($video->status == 0 && $video->video_local)
                                    <video width="160" height="90" muted controls class="bg-dark w-100 h-100" style="object-fit: cover;">
                                        <source src="{{ asset('storage/' . $video->video_local) }}" type="video/mp4">
                                    </video>
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-dark text-muted smaller px-2 text-center">Video Kosong</div>
                                @endif

                                <span class="badge bg-success position-absolute top-0 start-0 m-2 shadow-sm smaller-badge text-uppercase">Aktif</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                @if($video->status == 1)
                                    <span class="badge bg-danger align-self-start smaller-badge px-2 py-1"><i data-lucide="youtube" size="12" class="me-1"></i> YouTube</span>
                                    <span class="small text-muted text-break" style="max-width: 320px;">{{ $video->video_youtube }}</span>
                                @else
                                    <span class="badge bg-primary align-self-start smaller-badge px-2 py-1"><i data-lucide="hard-drive" size="12" class="me-1"></i> Video Lokal</span>
                                    <span class="small text-dark fw-semibold text-break" style="max-width: 320px;">{{ basename($video->video_local) }}</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="small text-muted fw-medium">{{ $video->created_at->format('d F Y') }}</span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.profil-beranda.edit', $video->id) }}" class="btn btn-light btn-sm rounded-3 text-secondary p-2 shadow-sm border" title="Ganti Video">
                                    <i data-lucide="edit-2" size="16"></i>
                                </a>
                                <form id="delete-form-{{ $video->id }}" action="{{ route('admin.profil-beranda.destroy', $video->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="confirmDelete('{{ $video->id }}')" type="button" class="btn btn-light btn-sm rounded-3 text-danger p-2 shadow-sm border" title="Hapus Video">
                                        <i data-lucide="trash-2" size="16"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 bg-white">
                            <div class="text-muted mb-2"><i data-lucide="video-off" size="32" class="opacity-50"></i></div>
                            <span class="text-muted small fw-medium">Tidak ada video profil yang dikonfigurasi saat ini.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .smaller-badge { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.02rem; }

    .table-header-custom tr { display: table-row !important; }
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

    .video-row { display: table-row !important; }
    .video-row td {
        display: table-cell !important;
        border-bottom: 1px solid #f1f5f9;
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    .video-preview-box {
        width: 160px;
        height: 90px;
        background-color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data video profil ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

<script>
    lucide.createIcons();
</script>
@endsection