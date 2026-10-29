@extends('admin.main.main')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container-fluid px-4">

        {{-- Top Bar Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Halo, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-muted small mb-0">Ringkasan performa {{ auth()->user()->name }}</p>
            </div>
            <a href="{{ route('admin.elearning.index') }}" class="btn btn-danger d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-semibold border-0" style="background-color: #e11d48;">
                <i data-lucide="plus" size="18"></i> Buat Event Baru
            </a>
        </div>

        {{-- Stats Cards Row --}}
        <div class="row g-3 mb-4">
            {{-- Event Dibuat --}}
            <div class="col-md-3">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #2563eb;">
                        <i data-lucide="calendar-plus" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">2</h4>
                        <span class="text-muted smaller">Event Dibuat</span>
                    </div>
                </div>
            </div>

            {{-- Event Aktif --}}
            <div class="col-md-3">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #059669;">
                        <i data-lucide="calendar-check" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">0</h4>
                        <span class="text-muted smaller">Event Aktif</span>
                    </div>
                </div>
            </div>

            {{-- Total Peserta --}}
            <div class="col-md-3">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #d97706;">
                        <i data-lucide="users" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">1</h4>
                        <span class="text-muted smaller">Total Peserta</span>
                    </div>
                </div>
            </div>

            {{-- Daftar Hari Ini --}}
            <div class="col-md-3">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #e11d48;">
                        <i data-lucide="user-check" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">0</h4>
                        <span class="text-muted smaller">Daftar Hari Ini</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content Section --}}
        <div class="row g-4">
            
            {{-- Left Column: Pendaftar Terbaru --}}
            <div class="col-lg-7">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <i data-lucide="user-plus" class="text-danger" size="18"></i>
                        <h6 class="fw-bold text-dark mb-0">Pendaftar Terbaru</h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead>
                                <tr class="text-uppercase border-bottom" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                                    <th class="py-2 px-2">NAMA</th>
                                    <th class="py-2 px-2">USAHA</th>
                                    <th class="py-2 px-2">EVENT</th>
                                    <th class="py-2 px-2">TGL DAFTAR</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                            
                            @forelse ($registered as $register )
                                <tr class="border-bottom">
                                    <td class="px-2 py-3 fw-bold text-dark">{{ $register->nama }}</td>
                                    <td class="px-2 py-3 text-secondary">{{ $register->jenis_usaha }}</td>
                                    <td class="px-2 py-3 text-secondary">{{ $register->event->judul_event }}</td>
                                    <td class="px-2 py-3 text-secondary"> {{ \Carbon\Carbon::parse($register->register_at)->format('d M Y') }}</td>
                                </tr>
                                
                            @empty
                                
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Right Column: Event Saya --}}
            <div class="col-lg-5">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i data-lucide="calendar" class="text-danger" size="18"></i>
                            <h6 class="fw-bold text-dark mb-0">Event Saya</h6>
                        </div>
                        <a href="{{ route('admin.daftarPeserta.index') }}" class="btn btn-outline-danger rounded-pill px-3 py-0.5 smaller fw-medium">Semua</a>
                    </div>

                    <div class="d-flex flex-column gap-3">

                    @forelse ($elearning as $e )
                        
                        {{-- Event Item 1 --}}
                        <div class="d-flex justify-content-between align-items-start pb-3 border-bottom">
                            <div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">{{ $e->judul_event }}</h6>
                                <div class="text-muted smaller d-flex align-items-center gap-1">
                                    <i data-lucide="calendar" size="13"></i> {{ \Carbon\Carbon::parse($e->waktu_mulai)->format('d M Y') }}
                                    <span class="mx-1">•</span>
                                    <i data-lucide="users" size="13"></i> {{ $e->peserta->count() }} peserta
                                </div>
                            </div>
                            <!-- <span class="badge rounded-pill px-2.5 py-1 smaller fw-medium" style="background-color: #fee2e2; color: #dc2626;">Dibatalkan</span> -->
                        </div>
                    @empty
                        {{-- Event Item 2 --}}
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">Belum Tersedia</h6>
                                <div class="text-muted smaller d-flex align-items-center gap-1">
                                    <i data-lucide="calendar" size="13"></i> -
                                    <span class="mx-1">•</span>
                                    <i data-lucide="users" size="13"></i> -
                                </div>
                            </div>
                            <span class="badge rounded-pill px-2.5 py-1 smaller fw-medium" style="background-color: #fee2e2; color: #dc2626;">-</span>
                        </div>

                    @endforelse

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection