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
            <p class="text-muted small mb-0">Kelola narasumber / pemateri pelatihan</p>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left Column: Form Tambah Narasumber --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <i data-lucide="user-plus" class="text-danger" size="20"></i>
                    <h6 class="fw-bold mb-0 text-dark">Tambah Narasumber</h6>
                </div>

                <form action="{{ route('admin.narasumber.store', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control rounded-3 py-2" placeholder="Nama lengkap narasumber" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Keahlian / Jabatan</label>
                        <input type="text" name="keahlian_jabatan" class="form-control rounded-3 py-2" placeholder="mis. Praktisi Digital Marketing">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Bio Singkat</label>
                        <textarea name="bio" class="form-control rounded-3 py-2" rows="3" placeholder="Opsional"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark small">Foto <span class="text-muted fw-normal">(opsional)</span></label>
                        <input type="file" name="foto" class="form-control rounded-3 py-2" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 rounded-3 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <i data-lucide="plus" size="18"></i>
                        Tambah
                    </button>
                </form>
            </div>
        </div>

        {{-- Right Column: Daftar Narasumber --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <i data-lucide="users" class="text-danger" size="20"></i>
                    <h6 class="fw-bold mb-0 text-dark">Daftar Narasumber ({{ count($mentors ?? [1]) }})</h6>
                </div>

                <div class="d-flex flex-column gap-3">

                @foreach ($narasumber as $n )
                    <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-white hover-shadow transition">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ route('show.thumbnail.produk.private', $n->foto) }}" class="rounded-circle object-fit-cover flex-shrink-0" style="width: 48px; height: 48px;" alt="Foto Narasumber">
                            <div>
                                <h6 class="fw-bold text-dark mb-0 small">{{ $n->nama }}</h6>
                                <span class="text-danger fw-semibold d-block smaller mb-1">{{ $n->keahlian_jabatan }}</span>
                                <span class="text-muted smaller">Ok</span>
                            </div>
                        </div>
                        <div>
                            <form id="delete-form-{{ $n->id }}" action="{{ route('admin.narasumber.delete', [$event->id, $n->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                  <button onclick="confirmDelete('{{ $n->id }}', '{{ $n->nama }}')" type="button" class="btn btn-light btn-sm rounded-2 text-danger border p-2" title="Hapus">
                                        <i data-lucide="trash-2" size="16"></i>
                                 </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                    {{-- Item 1 --}}

                    {{-- Empty State (Jika Data Kosong) --}}
                    @if(isset($mentors) && count($mentors) == 0)
                        <div class="text-center py-5">
                            <i data-lucide="user-x" size="48" class="text-muted mb-2 opacity-50"></i>
                            <p class="text-muted small mb-0">Belum ada narasumber yang ditambahkan.</p>
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