@extends('admin.main.main')

@section('content')
    <div class="bg-light min-vh-100 py-4">
        <div class="container-fluid px-4">

            {{-- Top Bar Header with Back Button --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="#"
                    class="btn btn-white bg-white border rounded-3 p-2 d-flex align-items-center justify-content-center shadow-sm text-secondary">
                    <i data-lucide="arrow-left" size="20"></i>
                </a>
                <div>
                    <h3 class="fw-bold text-dark mb-0">{{ $elearning->judul_event }}</h3>
                    <p class="text-muted small mb-0">Daftar peserta & progres</p>
                </div>
            </div>

            {{-- Stats Cards Row --}}
            <div class="row g-3 mb-4">

                {{-- Total Peserta --}}
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                        <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white"
                            style="width: 44px; height: 44px; background-color: #2563eb;">
                            <i data-lucide="users" size="22"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">{{ $elearning->peserta->count() }}</h4>
                            <span class="text-muted smaller">Total Peserta</span>
                        </div>
                    </div>
                </div>

                {{-- selesai --}}
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                        <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white"
                            style="width: 44px; height: 44px; background-color: #059669;">
                            <i data-lucide="user-check" size="22"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">{{ $pesertaSelesai }}</h4>
                            <span class="text-muted smaller">Selesai</span>
                        </div>
                    </div>
                </div>

                {{-- Belum selesai --}}
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                        <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white"
                            style="width: 44px; height: 44px; background-color: #6b7280;">
                            <i data-lucide="hourglass" size="22"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">{{ $pesertaBelumSelesai }}</h4>
                            <span class="text-muted smaller">Belum Selesai</span>
                        </div>
                    </div>
                </div>

                {{-- Kehadiran --}}
                <!-- <div class="col-md-3">
                    <div class="card border-0 rounded-4 p-3 shadow-sm bg-white d-flex flex-row align-items-center gap-3">
                        <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center text-white"
                            style="width: 44px; height: 44px; background-color: #d97706;">
                            <i data-lucide="line-chart" size="22"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">100%</h4>
                            <span class="text-muted smaller">Kehadiran</span>
                        </div>
                    </div>
                </div>
            </div> -->

            {{-- QR Code / Check-in Banner Card --}}
            <!-- <div class="card border-0 rounded-4 shadow-sm bg-white p-3.5 mb-4">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="qr-code" class="text-danger" size="20"></i>
                        <div>
                            <span class="fw-bold text-dark d-block">Catat Kehadiran</span>
                            <span class="text-muted smaller">Scan QR peserta (kamera HP membuka link otomatis) atau tempel
                                kode QR di sini.</span>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row align-items-center gap-2 style-input-group">
                        <input type="text" class="form-control rounded-3 py-2 px-3 smaller"
                            placeholder="Tempel kode/URL QR peserta..." style="min-width: 260px;">
                        <button
                            class="btn btn-danger px-4 py-2 rounded-3 fw-semibold smaller border-0 d-flex align-items-center gap-1.5"
                            style="background-color: #e11d48;">
                            <i data-lucide="check-square" size="16"></i> Catat
                        </button>
                        <button
                            class="btn btn-outline-danger px-3 py-2 rounded-3 fw-semibold smaller d-flex align-items-center gap-1.5"
                            style="color: #e11d48; border-color: #fca5a5;">
                            <i data-lucide="award" size="16"></i> Terbitkan Sertifikat (Hadir)
                        </button>
                    </div>
                </div>
            </div> -->

            {{-- Main Table Card --}}
            <div class="card border-0 rounded-4 shadow-sm bg-white p-4">

                {{-- Top Controls (Show entries & Search) --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-2 smaller text-muted">
                        <span>Tampilkan</span>
                        <select class="form-select form-select-sm rounded-3 style-select px-3 py-1.5" style="width: 70px;">
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="style-search">
                        <input type="text" class="form-control form-control-sm rounded-3 py-1.5 px-3 smaller"
                            placeholder="Cari..." style="width: 200px;">
                    </div>
                </div>

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr class="text-uppercase border-bottom" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                <th class="py-3 px-2 text-center" style="width: 40px;">#</th>
                                <th class="py-3 px-3" style="min-width: 220px;">
                                    PESERTA
                                </th>
                                <th class="py-3 px-3" style="min-width: 140px;">
                                    NO. HP
                                </th>
                                <th class="py-3 px-3" style="min-width: 130px;">
                                    USAHA
                                </th>
                                <th class="py-3 px-3" style="min-width: 160px;">
                                    LOKASI MERCHANT
                                </th>
                                <th class="py-3 px-3" style="min-width: 150px;">
                                    PENDAPATAN/BLN
                                </th>
                                <th class="py-3 px-3" style="min-width: 120px;">
                                    TGL DAFTAR
                                </th>
                                <th class="py-3 px-3 text-center" style="min-width: 110px;">STATUS PELATIHAN</th>
                                <th class="py-3 px-3 text-center" style="min-width: 110px;">SERTIFIKAT</th>
                            </tr>
                        </thead>
                        <tbody class="small fw-semibold">
                            @forelse ($daftarPeserta as $serta)

                                @php
                                    $materiSelesai = $serta->materi_selesai_count ?? 0;

                                    if ($totalMateri == 0 || $materiSelesai == 0) {
                                        $statusPelatihan = 'belum';
                                    } elseif ($materiSelesai < $totalMateri) {
                                        $statusPelatihan = 'proses';
                                    } else {
                                        $statusPelatihan = 'selesai';
                                    }
                                @endphp


                                <tr class="border-bottom">
                                    <td class="px-2 py-3 text-center text-muted fw-normal">1</td>
                                    <td class="px-3 py-3">
                                        <div class="fw-bold text-dark">{{ $serta->nama }}</div>
                                        <div class="text-muted smaller fw-normal d-flex align-items-center gap-1">
                                            <i data-lucide="mail" size="12"></i> {{ $serta->email }}
                                        </div>
                                        <div class="text-muted smaller fw-normal d-flex align-items-center text-truncate gap-1">
                                            <i data-lucide="map-pin" size="12"></i> {{ $serta->alamat }}
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-dark">{{ $serta->no_hp }}</td>
                                    <td class="px-3 py-3">
                                        <!-- <div class="fw-bold text-dark">Klontong</div> -->
                                        <span
                                            class="badge rounded-pill bg-light text-secondary border fw-normal smaller px-2">{{ $serta->jenis_usaha }}</span>
                                    </td>
                                    <td class="px-3 py-3 text-dark fw-normal">{{ $serta->lokasi_merchant }}</td>
                                    <td class="px-3 py-3 text-dark fw-normal">{{ $serta->pendapatan_bulanan }}</td>
                                    <!-- <td class="px-3 py-3 text-dark fw-normal">17 Jun 2026</td> -->
                                    <td class="px-3 py-3 text-dark fw-normal">
                                        {{ \Carbon\Carbon::parse($serta->register_at)->format('d M Y') }}
                                    </td>
                                    <!-- <td class="px-3 py-3 text-center">
                                                <span
                                                    class="badge rounded-3 px-2.5 py-1.5 fw-semibold d-inline-flex align-items-center gap-1"
                                                    style="background-color: #059669; color: #ffffff;">
                                                    <i data-lucide="check-circle-2" size="14"></i> SELESAI
                                                </span>
                                            </td> -->
                                    <td class="px-3 py-3 text-center">

                                        @if ($statusPelatihan === 'selesai')

                                            <span
                                                class="badge rounded-3 px-2 py-1 fw-semibold d-inline-flex align-items-center gap-1"
                                                style="background-color: #059669; color: #ffffff;">
                                                <i data-lucide="check-circle-2" size="14"></i>
                                                SELESAI
                                            </span>

                                        @elseif ($statusPelatihan === 'proses')

                                            <span
                                                class="badge rounded-3 px-2 py-1 fw-semibold d-inline-flex align-items-center gap-1"
                                                style="background-color: #f59e0b; color: #ffffff;">
                                                <i data-lucide="clock-3" size="14"></i>
                                                SEDANG DIPELAJARI
                                            </span>

                                        @else

                                            <span
                                                class="badge rounded-3 px-2 py-1 fw-semibold d-inline-flex align-items-center gap-1"
                                                style="background-color: #64748b; color: #ffffff;">
                                                <i data-lucide="circle" size="14"></i>
                                                BELUM SELESAI
                                            </span>

                                        @endif

                                        <div class="text-muted smaller mt-1">
                                            {{ $materiSelesai }} / {{ $totalMateri }} Materi
                                        </div>

                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <a href="#"
                                            class="btn btn-sm rounded-3 px-2.5 py-1.5 fw-semibold d-inline-flex align-items-center gap-1 text-white"
                                            style="background-color: #059669;">
                                            <i data-lucide="check-circle" size="14"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <p class="text-center">Belum ada Peserta</p>

                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Table Footer / Pagination --}}
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center pt-4 gap-3">
                    <span class="text-muted smaller">Menampilkan 1–1 dari 1 data</span>

                    <nav>
                        <ul class="pagination pagination-sm mb-0 gap-1">
                            <li class="page-item disabled">
                                <a class="page-link rounded-2 px-2 py-1 border-0 bg-light text-muted" href="#"><i
                                        data-lucide="chevron-left" size="14"></i></a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link rounded-2 px-2.5 py-1 border-0" style="background-color: #e11d48;"
                                    href="#">1</a>
                            </li>
                            <li class="page-item disabled">
                                <a class="page-link rounded-2 px-2 py-1 border-0 bg-light text-muted" href="#"><i
                                        data-lucide="chevron-right" size="14"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>
    </div>

    <style>
        .smaller {
            font-size: 0.78rem;
        }

        .style-select,
        .style-search input {
            border-color: #e5e7eb;
        }

        .style-select:focus,
        .style-search input:focus {
            border-color: #e11d48;
            box-shadow: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>
@endsection