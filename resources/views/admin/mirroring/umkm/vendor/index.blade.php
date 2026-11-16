@extends('admin.main.main')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container py-3" style="max-width: 1200px;">

        {{-- Top Bar Header & Back Button --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url()->previous() }}" class="btn btn-white bg-white border rounded-3 p-2 d-flex align-items-center justify-content-center shadow-sm text-secondary">
                    <i data-lucide="arrow-left" size="20"></i>
                </a>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Profil UMKM Saya</h3>
                    <p class="text-muted small mb-0">Kelola dan lihat informasi detail badan usaha serta data keuangan Anda.</p>
                </div>
            </div>
            @if($umkm)
            <a href="{{ route('vendor.mirroring.umkm.edit', auth()->user()->nik) }}" class="btn btn-danger btn-sm rounded-3 px-3 py-2 fw-semibold d-flex align-items-center gap-1.5 border-0 shadow-sm" style="background-color: #e11d48;">
                <i data-lucide="edit-3" size="16"></i> Edit Profil
            </a>
            @endif
        </div>

        {{-- Kondisi Jika UMKM Kosong / NIK Belum Terisi --}}
        @if(!$umkm)
            <div class="card border-0 rounded-4 shadow-sm bg-white p-5 text-center my-5">
                <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-4 d-inline-flex mx-auto mb-3">
                    <i data-lucide="alert-circle" size="48"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2">NIK Belum Terisi / Data Tidak Ditemukan</h4>
                <p class="text-muted smaller mb-4" style="max-width: 400px; margin: 0 auto;">
                    Maaf, data UMKM dengan NIK tersebut tidak ditemukan di sistem atau parameter NIK belum terisi dengan benar.
                </p>
                <div>
                    <a href="{{ route('user.prfile.index', Crypt::encryptString(auth()->user()->id)) }}" class="btn btn-secondary rounded-3 px-4 py-2 smaller fw-semibold">
                        Kembali ke Halaman Akun
                    </a>
                    <!-- <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-3 px-4 py-2 smaller fw-semibold">
                        Kembali ke Halaman Sebelumnya
                    </a> -->
                </div>
            </div>
        @else
            {{-- Profile Header Banner Card --}}
            <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
                <div class="row align-items-center g-4">
                    <div class="col-md-auto text-center text-md-start">
                        <div class="rounded-4 bg-danger bg-opacity-10 text-danger fw-bold d-flex align-items-center justify-content-center mx-auto mx-md-0 shadow-sm" style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ strtoupper(substr($umkm->nama_lengkap_usaha ?? 'U', 0, 2)) }}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                            <h4 class="fw-bold text-dark mb-0">{{ $umkm->nama_lengkap_usaha ?? 'Nama Usaha Belum Diisi' }}</h4>
                            
                            {{-- Skala Usaha Badge Logic --}}
                            @php
                                $omzet = optional($umkm->laporanKeuangan)->omzet_usaha ?? 0;
                            @endphp

                            @if($omzet <= 2000000)
                                <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning border border-warning-subtle px-3 py-1 smaller fw-semibold">Usaha Mikro</span>
                            @elseif($omzet > 2000000 && $omzet <= 15000000)
                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary-subtle px-3 py-1 smaller fw-semibold">Usaha Kecil</span>
                            @else
                                <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger border border-danger-subtle px-3 py-1 smaller fw-semibold">Usaha Menengah</span>
                            @endif
                        </div>
                        <p class="text-muted smaller mb-2 d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                            <i data-lucide="map-pin" size="14"></i> 
                            {{ preg_replace('/^[0-9.]+\s+/', '', $umkm->kecamatan ?? '-') }}, 
                            {{ preg_replace('/^[0-9.]+\s+/', '', $umkm->kabupaten ?? '-') }}, 
                            {{ preg_replace('/^[0-9.]+\s+/', '', $umkm->provinsi ?? '-') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tabs Navigation --}}
            <ul class="nav nav-pills custom-pills gap-2 bg-white p-2 rounded-4 shadow-sm border mb-4" id="umkmTab" role="tablist">
                <li class="nav-item flex-fill text-center" role="presentation">
                    <button class="nav-link active w-100 py-2.5 rounded-3 fw-semibold smaller d-flex align-items-center justify-content-center gap-2" id="info-tab" data-bs-toggle="pill" data-bs-target="#info-pane" type="button" role="tab" aria-controls="info-pane" aria-selected="true">
                        <i data-lucide="store" size="16"></i> Informasi Umum Usaha
                    </button>
                </li>
                <li class="nav-item flex-fill text-center" role="presentation">
                    <button class="nav-link w-100 py-2.5 rounded-3 fw-semibold smaller d-flex align-items-center justify-content-center gap-2" id="keuangan-tab" data-bs-toggle="pill" data-bs-target="#keuangan-pane" type="button" role="tab" aria-controls="keuangan-pane" aria-selected="false">
                        <i data-lucide="wallet" size="16"></i> Data Keuangan & Omzet
                    </button>
                </li>
            </ul>

            {{-- Tab Content Containers --}}
            <div class="tab-content" id="umkmTabContent">
                
                {{-- TAB 1: Informasi Umum Usaha --}}
                <div class="tab-pane fade show active" id="info-pane" role="tabpanel" aria-labelledby="info-tab">
                    <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
                        <div class="d-flex align-items-center gap-2 mb-4 pb-2 border-bottom">
                            <i data-lucide="info" class="text-danger" size="18"></i>
                            <h6 class="fw-bold text-dark mb-0">Detail Informasi Badan Usaha</h6>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 bg-light border h-100">
                                    <span class="text-muted smaller d-block mb-1">Nama Lengkap Usaha</span>
                                    <span class="fw-bold text-dark">{{ $umkm->nama_lengkap_usaha ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded-3 bg-light border h-100">
                                    <span class="text-muted smaller d-block mb-1">ID Badan Usaha</span>
                                    <span class="fw-bold text-dark font-monospace">{{ $umkm->id_badan_usaha ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="p-3 rounded-3 bg-light border h-100">
                                    <span class="text-muted smaller d-block mb-1">Provinsi</span>
                                    <span class="fw-semibold text-dark">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm->provinsi ?? '-') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="p-3 rounded-3 bg-light border h-100">
                                    <span class="text-muted smaller d-block mb-1">Kabupaten / Kota</span>
                                    <span class="fw-semibold text-dark">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm->kabupaten ?? '-') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="p-3 rounded-3 bg-light border h-100">
                                    <span class="text-muted smaller d-block mb-1">Kecamatan</span>
                                    <span class="fw-semibold text-dark">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm->kecamatan ?? '-') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: Data Keuangan & Omzet --}}
                <div class="tab-pane fade" id="keuangan-pane" role="tabpanel" aria-labelledby="keuangan-tab">
                    <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
                        <div class="d-flex align-items-center gap-2 mb-4 pb-2 border-bottom">
                            <i data-lucide="trending-up" class="text-success" size="18"></i>
                            <h6 class="fw-bold text-dark mb-0">Informasi Keuangan & Klasifikasi Usaha</h6>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-3.5 rounded-3 bg-light border h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="text-muted smaller d-block mb-1">Estimasi Omzet Usaha / Bulan</span>
                                        <h3 class="fw-bold text-dark mb-0">
                                            Rp {{ number_format(optional($umkm->laporanKeuangan)->omzet_usaha ?? 0, 0, ',', '.') }}
                                        </h3>
                                    </div>
                                    <div class="mt-3 pt-2 border-top">
                                        <span class="text-muted smaller">Berdasarkan laporan finansial terakhir</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3.5 rounded-3 bg-light border h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="text-muted smaller d-block mb-1">Status Skala Usaha</span>
                                        <div class="mt-2">
                                            @if($omzet <= 2000000)
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-3 py-2 rounded-2 fw-semibold fs-6">Usaha Mikro (&le; Rp 2 Juta)</span>
                                            @elseif($omzet > 2000000 && $omzet <= 15000000)
                                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2 rounded-2 fw-semibold fs-6">Usaha Kecil (Rp 2Jt - Rp 15Jt)</span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-2 fw-semibold fs-6">Usaha Menengah (&gt; Rp 15 Juta)</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 pt-2 border-top">
                                        <span class="text-muted smaller">Klasifikasi otomatis sistem</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
    .custom-pills .nav-link {
        color: #6b7280;
        background-color: transparent;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }
    .custom-pills .nav-link:hover {
        color: #e11d48;
        background-color: #fff1f2;
    }
    .custom-pills .nav-link.active {
        background-color: #e11d48 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(225, 29, 72, 0.2);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection