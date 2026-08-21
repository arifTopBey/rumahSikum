@extends('admin.main.main')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container-fluid px-4">

        {{-- Top Bar Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Laporan Pelatihan</h3>
                <p class="text-muted small mb-0">Rekap peserta, kehadiran & sertifikat dari acaramu</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-success d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-semibold border-0" style="background-color: #059669;">
                    <i data-lucide="file-spreadsheet" size="18"></i> Export Peserta
                </button>
                <button class="btn btn-danger d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-semibold border-0" style="background-color: #e11d48;">
                    <i data-lucide="printer" size="18"></i> Cetak / PDF
                </button>
            </div>
        </div>

        {{-- Stats Cards Row --}}
        <div class="row g-3 mb-4">
            {{-- Total Pelatihan --}}
            <div class="col">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 bg-primary p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #2563eb !important;">
                        <i data-lucide="graduation-cap" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">2</h4>
                        <span class="text-muted smaller">Total Pelatihan</span>
                    </div>
                </div>
            </div>

            {{-- Total Peserta --}}
            <div class="col">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #7c3aed;">
                        <i data-lucide="users" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">1</h4>
                        <span class="text-muted smaller">Total Peserta</span>
                    </div>
                </div>
            </div>

            {{-- Hadir --}}
            <div class="col">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #059669;">
                        <i data-lucide="user-check" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">1</h4>
                        <span class="text-muted smaller">Hadir</span>
                    </div>
                </div>
            </div>

            {{-- % Kehadiran --}}
            <div class="col">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #d97706;">
                        <i data-lucide="line-chart" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">100%</h4>
                        <span class="text-muted smaller">% Kehadiran</span>
                    </div>
                </div>
            </div>

            {{-- Sertifikat --}}
            <div class="col">
                <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background-color: #059669;">
                        <i data-lucide="badge-check" size="22"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">1</h4>
                        <span class="text-muted smaller">Sertifikat</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Rekap per Pelatihan --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <div class="d-flex align-items-center gap-2 mb-4">
                <i data-lucide="calendar" class="text-danger" size="20"></i>
                <h5 class="fw-bold text-dark mb-0">Rekap per Pelatihan</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead>
                        <tr class="text-uppercase text-muted border-bottom" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                            <th class="py-3 px-3" style="min-width: 200px;">Pelatihan</th>
                            <th class="py-3 px-3" style="min-width: 140px;">Tanggal</th>
                            <th class="py-3 px-3 text-center" style="min-width: 90px;">Peserta</th>
                            <th class="py-3 px-3 text-center" style="min-width: 90px;">Hadir</th>
                            <th class="py-3 px-3 text-center" style="min-width: 110px;">Kehadiran</th>
                            <th class="py-3 px-3 text-center" style="min-width: 110px;">Sertifikat</th>
                            <th class="py-3 px-3 text-center" style="min-width: 90px;">Materi</th>
                            <th class="py-3 px-3 text-center" style="min-width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small fw-semibold">
                        {{-- Row 1 --}}
                        <tr class="border-bottom">
                            <td class="px-3 py-3">
                                <div class="fw-bold text-dark mb-1">Konser Ahir Tahun</div>
                                <div class="d-flex gap-1">
                                    <span class="badge rounded-pill px-2 py-0.5 smaller fw-medium" style="background-color: #e0e7ff; color: #4338ca;">
                                        <i data-lucide="monitor" size="10" class="me-0.5"></i> Offline
                                    </span>
                                    <span class="badge rounded-pill px-2 py-0.5 smaller fw-medium" style="background-color: #fee2e2; color: #dc2626;">Dibatalkan</span>
                                </div>
                            </td>
                            <td class="px-3 text-secondary fw-normal">30 Dec 2026</td>
                            <td class="px-3 text-center fw-bold text-dark">0</td>
                            <td class="px-3 text-center fw-bold text-dark">0</td>
                            <td class="px-3 text-center">
                                <span class="badge rounded-pill px-2.5 py-1 text-secondary fw-medium" style="background-color: #f3f4f6;">0%</span>
                            </td>
                            <td class="px-3 text-center text-secondary">
                                <i data-lucide="check-circle-2" size="15" class="text-muted opacity-50 me-1"></i> 0
                            </td>
                            <td class="px-3 text-center text-secondary">
                                <i data-lucide="folder" size="15" class="text-muted opacity-50 me-1"></i> 0
                            </td>
                            <td class="px-3 text-center">
                                <a href="#" class="btn btn-sm btn-outline-success rounded-3 p-1.5 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i data-lucide="download" size="16"></i>
                                </a>
                            </td>
                        </tr>

                        {{-- Row 2 --}}
                        <tr class="border-bottom">
                            <td class="px-3 py-3">
                                <div class="fw-bold text-dark mb-1">Fellonge 2026</div>
                                <div class="d-flex gap-1">
                                    <span class="badge rounded-pill px-2 py-0.5 smaller fw-medium" style="background-color: #e0e7ff; color: #4338ca;">
                                        <i data-lucide="monitor" size="10" class="me-0.5"></i> Online
                                    </span>
                                    <span class="badge rounded-pill px-2 py-0.5 smaller fw-medium" style="background-color: #fee2e2; color: #dc2626;">Dibatalkan</span>
                                </div>
                            </td>
                            <td class="px-3 text-secondary fw-normal">01 Aug 2026</td>
                            <td class="px-3 text-center fw-bold text-dark">1</td>
                            <td class="px-3 text-center fw-bold text-dark">1</td>
                            <td class="px-3 text-center">
                                <span class="badge rounded-pill px-2.5 py-1 fw-bold" style="background-color: #d1fae5; color: #059669;">100%</span>
                            </td>
                            <td class="px-3 text-center text-secondary">
                                <i data-lucide="check-circle-2" size="15" class="text-muted opacity-50 me-1"></i> 1
                            </td>
                            <td class="px-3 text-center text-secondary">
                                <i data-lucide="folder" size="15" class="text-muted opacity-50 me-1"></i> 2
                            </td>
                            <td class="px-3 text-center">
                                <a href="#" class="btn btn-sm btn-outline-success rounded-3 p-1.5 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i data-lucide="download" size="16"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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