@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white">
    <div class="row py-5">
        <div style="background-color: rgba(168, 34, 130, 0.5);" class="col-md-12 border-primary rounded-3 py-3 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-800 text-white mb-0">Manajemen Pelatihan</h5>
                <p class="text-muted small mb-0">Kelola pelatihan , dan agenda UMKM lainnya.</p>
            </div>
            <a href="{{ route('admin.pelatihan.create') }}" style="background-color: #a82282; color: white" class="btn  rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                <i data-lucide="calendar-plus" size="18"></i> Buat Pelatihan Baru
            </a>
        </div>

        <div class="col-md-12 mb-4">
            <div class="row g-3">
                <div class="col-md-8 d-flex gap-2">
                    <select class="form-select w-auto rounded-pill border-2">
                        <option>Semua Status</option>
                    </select>
                    <select class="form-select w-auto rounded-pill border-2">
                        <option>Tipe Pelatihan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-start-pill border-2 ps-4" placeholder="Cari nama acara...">
                        <button style="background-color: #a82282; color: white" class="btn  rounded-end-pill px-4"><i data-lucide="search" size="18"></i></button>
                    </div>
                </div>
            </div>
        </div>

 

         <div class="col-lg-12" style="min-height: 100vh;">
            <div class="table-responsive">
                <table class="table table-hover align-middle border" style="min-height: 30vh;">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 fw-semibold text-dark text-center" width="50">No</th>
                            <th class="py-3 fw-semibold text-dark" >Nama Pelatihan</th>
                            <th class="py-3 fw-semibold text-dark">Tanggal Pelaksanaan</th>
                            <th class="py-3 fw-semibold text-dark">lokasi</th>
                            <!-- <th class="py-3 fw-semibold text-dark text-center">Peserta</th> -->
                            <th class="py-3 fw-semibold text-dark text-center">Status</th>
                            <th class="py-3 fw-semibold text-dark text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                
                @foreach ($pelatihan as $latih)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                    <i data-lucide="ticket" size="22"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $latih->judul }}</h6>
                                    <small class="text-muted">Kategori: {{ $latih->kategoriPelatihan->name }}</small>
                                </div>
                            </div>                           
                        </td>
                        <td class="text-center small">
                            <div class="fw-bold small">{{ \Carbon\Carbon::parse($latih->tanggal_acara)->format('d M Y') }}</div>
                            <div class="smaller text-muted">{{ $latih->waktu_acara_mulai }} - {{ $latih->waktu_acara_selesai }} WIB</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill smaller fw-normal">
                                <i data-lucide="map-pin" size="12" class="me-1"></i> {{ $latih->lokasi }}
                            </span>
                        </td>
                    
                        @php
                            $now = \Carbon\Carbon::now();

                            $mulai = \Carbon\Carbon::parse($latih->tanggal_acara . ' ' . $latih->waktu_acara_mulai);
                            $selesai = \Carbon\Carbon::parse($latih->tanggal_acara . ' ' . $latih->waktu_acara_selesai);

                            if ($now->lt($mulai)) {
                                $status = 'Mendatang';
                                $badge = 'bg-primary-subtle text-primary border-primary-subtle';
                            } elseif ($now->between($mulai, $selesai)) {
                                $status = 'Berlangsung';
                                $badge = 'bg-warning-subtle text-warning border-warning-subtle';
                            } else {
                                $status = 'Selesai';
                                $badge = 'bg-success-subtle text-success border-success-subtle';
                            }
                        @endphp

                        <td class="text-center">
                            <span class="badge {{ $badge }} border px-3 py-2 rounded-2 fw-bold smaller">{{ $status }}</span>                       
                        </td>

                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                    <i data-lucide="more-horizontal" size="18"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                    <li><a class="dropdown-item py-2" href=""><i data-lucide="edit-3" size="14" class="me-2"></i> Edit</a></li>
                                    <li><a href="{{ route('admin.pelatihan.show', $latih->id) }}"  class="dropdown-item py-2" ><i data-lucide="eye" size="14" class="me-2"></i> Pratinjau</a></li>
                                    <!-- <li><a class="dropdown-item py-2 text-danger" href="#"><i data-lucide="trash-2" size="14" class="me-2"></i> Hapus</a></li> -->
                                    <form id="delete-form-{{ $latih->id }}"  method="POST" action="{{ route('admin.pelatihan.destroy', $latih->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="confirmDelete('{{ $latih->id }}', '{{ $latih->judul }}')"  type="button" class="btn btn-sm btn-light text-danger px-3">
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

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .table thead th { border-top: none; }
    .table td { border-bottom: 1px solid #f2f2f2; }
</style>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection