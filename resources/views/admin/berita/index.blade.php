@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white">
    <div class="row py-5">
        <div class="col-md-12 mx-auto border-primary bg-primary bg-opacity-10 rounded-2 py-3 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <p class="fw-bold fs-5 text-primary mb-0">Manajemen Berita & Artikel</p>
                <p class="text-muted mb-0">Kelola konten edukasi, kebijakan, dan informasi terkini untuk UMKM.</p>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                <i data-lucide="plus-circle" size="18" class="me-1"></i> Buat Berita Baru
            </a>
        </div>

        <div class="col-md-12 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex gap-2">
                        <select class="form-select w-auto rounded-3">
                            <option value="">Semua Kategori</option>
                            <option value="Kebijakan">Kebijakan</option>
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Tips">Tips Bisnis</option>
                        </select>
                        <select class="form-select w-auto rounded-3">
                            <option value="">Status</option>
                            <option value="Published">Published</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Cari judul berita..." name="search" value="{{ request('search') }}">
                            <button class="btn btn-outline-primary border-start-0" type="submit">
                                <i data-lucide="search" size="18"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12" style="min-height: 100vh;">
            <div class="table-responsive">
                <table class="table table-hover align-middle border" style="min-height: 30vh;">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 fw-semibold text-dark text-center" width="50">No</th>
                            <th class="py-3 fw-semibold text-dark" width="100">Thumbnail</th>
                            <th class="py-3 fw-semibold text-dark">Judul Berita</th>
                            <th class="py-3 fw-semibold text-dark">View</th>
                            <th class="py-3 fw-semibold text-dark text-center">Kategori</th>
                            <th class="py-3 fw-semibold text-dark text-center">Penulis</th>
                            <th class="py-3 fw-semibold text-dark text-center">Status</th>
                            <th class="py-3 fw-semibold text-dark text-center">Tanggal</th>
                            <th class="py-3 fw-semibold text-dark text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach ($beritas as $berita )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ route('showFoto.berita.private', $berita->gambar) }}" class="rounded-2 border" width="80" height="50" style="object-fit: cover;">
                                <!-- <img src="{{ Storage::url($berita->gambar) }}" class="rounded-2 border" width="80" height="50" style="object-fit: cover;"> -->
                            </td>
                            <td class="text-center small">{{ $berita->judul }}</td>
                            <td>
                                <div class="fw-bold text-dark"></div>
                                <span class="smaller text-muted"><i data-lucide="eye" size="12"></i> {{ $berita->views }} Klik</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">{{ $berita->kategori->name }}</span>
                            </td>
                            <td class="text-center small">{{ $berita->users->name }}</td>
                            <td class="text-center">
                                @if ($berita->is_published === 1)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-2">Published</span>
                                    @else   
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-2">Non Published</span>
                                @endif
                            </td>
                            <td class="text-center small">{{ $berita->created_at->format('Y-m-d') }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-horizontal" size="18"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.berita.edit', $berita->id) }}"><i data-lucide="edit-3" size="14" class="me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.berita.show', $berita->id) }}"><i data-lucide="eye" size="14" class="me-2"></i> Pratinjau</a></li>
                                        <!-- <li><a class="dropdown-item py-2 text-danger" href="#"><i data-lucide="trash-2" size="14" class="me-2"></i> Hapus</a></li> -->
                                        <form id="delete-form-{{ $berita->id }}" action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirmDelete('{{ $berita->id }}', '{{ $berita->judul }}')" type="button" class="btn btn-sm btn-light text-danger px-3">
                                                <i data-lucide="trash-2" size="14" class="me-3"></i>Hapus
                                            </button>

                                        </form>
                                        <!-- <li><hr class="dropdown-divider"></li> -->
                                    </ul>
                                </div>
                            </td>
                        </tr>      
                    @endforeach
                      
                        <!-- <tr>
                            <td colspan="8" class="text-center py-5 text-muted">Belum ada berita yang diterbitkan.</td>
                        </tr> -->
                      
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection