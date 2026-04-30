@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-white">
    <div class="row py-5">
        <div style="background-color: rgba(168, 34, 130, 0.3);" class="col-md-12 mx-auto border-primary  rounded-2 py-3 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <p class="fw-bold fs-5 text-white mb-0">Manajemen WhatApp Info</p>
                <p class="text-muted mb-0">Kelola Nomor WhatApp Dan Pesan</p>
            </div>
            <a href="{{ route('admin.whatapp.create') }}" style="background-color: #a82282; color: white" class="btn rounded-pill px-4 fw-bold shadow-sm">
                <i data-lucide="plus-circle" size="18" class="me-1"></i> Buat Wa Baru
            </a>
        </div>

        <div class="col-md-12 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <!-- <div class="d-flex gap-2">
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
                    </div> -->
                </div>
                <div class="col-md-4">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Cari Nomor whatapp..." name="search" value="{{ request('search') }}">
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
                            <th class="py-3 fw-semibold text-dark" width="100">No WA</th>
                            <th class="py-3 fw-semibold text-dark">Message</th>
                            <th class="py-3 fw-semibold text-dark text-center">Status</th>
                            <th class="py-3 fw-semibold text-dark text-center">Tanggal</th>
                            <th class="py-3 fw-semibold text-dark text-center">Id Message</th>
                            <th class="py-3 fw-semibold text-dark text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach ($whatApps as $wa )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center small">{{ $wa->no_wa }}</td>
                            <td class="text-center small">{{ $wa->message }}</td>
                
                        
                            <td class="text-center">
                                @if ($wa->status === 'success')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-2">Success</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-2">Failed</span>
                                @endif
                            </td>
                            <td class="text-center small">{{ \Carbon\Carbon::parse($wa->created_at)->format('d M Y') }}</td>
                            <td class="text-center small">{{ $wa->id_message }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-horizontal" size="18"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                        <li><a class="dropdown-item py-2" ><i data-lucide="send" size="14" class="me-2"></i> Resend</a></li>
                                        <!-- <li><a class="dropdown-item py-2" ><i data-lucide="eye" size="14" class="me-2"></i> Pratinjau</a></li> -->
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