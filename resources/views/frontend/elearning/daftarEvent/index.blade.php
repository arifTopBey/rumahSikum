@extends('frontend.main.index')

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container" style="max-width: 1140px; margin-top: 60px;">

 @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

      @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif

        <div class="row g-4">
            {{-- Kolom Kiri: Konten Utama --}}
            <div class="col-lg-8">
                
                {{-- Banner Hero Event --}}
                <div class="card border-0 rounded-4 overflow-hidden mb-4 shadow-sm">
                    <img src="{{ route('show.thumbnail.produk.private', $elearning->banner_event) }}" class="img-fluid w-100" alt="Legal Academy Banner" style="max-height: 500px;">
                </div>

                {{-- Information & Judul Event --}}
                <div class="mb-4">
                    <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-3 py-2 rounded-pill mb-2" style="font-size: 0.8rem;">
                        {{ $event->category ?? 'Legal Academy' }}
                    </span>
                    <h3 class="fw-bold text-dark mb-2">{{ $elearning->judul_event ?? 'Legal Academy' }}</h3>
                    
                    <div class="d-flex flex-wrap align-items-center gap-3 text-muted small">
                        <div class="d-flex align-items-center gap-1">
                            <i data-lucide="calendar" size="16" class="text-danger"></i>
                            <span>{{ \Carbon\Carbon::parse($elearning->waktu_mulai)->translatedFormat('d M Y, H:i') ?? '01 Jul 2026, 09:00 — 01 Jul 2026, 17:00' }} - {{ \Carbon\Carbon::parse($elearning->waktu_selesai)->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <span class="badge bg-danger bg-opacity-10 text-danger fw-semibold px-2 py-1 smaller">Online</span>
                            <!-- <span>Online</span> -->
                        </div>
                    </div>
                </div>

                {{-- Card Tentang Event --}}
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white mb-4">
                    <h6 class="fw-bold text-dark mb-2">Tentang Event</h6>
                    <p class="text-secondary mb-0 small">
                        {{ $event->deskripsi ?? 'Materi seputar pengetahuan legal dalam dunia usaha' }}
                    </p>
                </div>

                {{-- Card Materi Pelatihan --}}
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i data-lucide="archive" class="text-danger" size="20"></i>
                            <h6 class="fw-bold text-dark mb-0">Materi Pelatihan <span class="text-muted fw-normal small">• {{ count($materials ?? []) }} item</span></h6>
                        </div>
                        <a href="{{ route('frontend.e-learning.detail', $elearning->id) }}" class="btn btn-danger btn-sm rounded-pill px-3 py-1 fw-semibold d-flex align-items-center gap-1 smaller shadow-sm" style="background-color: #e11d48; border: none;">
                            <i data-lucide="graduation-cap" size="16"></i> Masuk Kelas
                        </a>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        @forelse ($modules as $index => $item)
                            <div class="d-flex align-items-center justify-content-between p-2 rounded-3 hover-item transition">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 bg-warning bg-opacity-10 p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                        <i data-lucide="file-text" size="20" class="text-warning"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0 small">{{ $item->judul }}</h6>
                                        <span class="text-muted smaller">
                                            <span class="badge bg-warning bg-opacity-10 text-warning fw-bold px-1 py-0 smaller" style="color: #ea580c !important;">{{ $item->tipe }}</span>
                                            • Materi Sesi {{ $index + 1 }} Modul {{ $event->judul ?? 'Legal Academy' }}
                                        </span>
                                    </div>
                                </div>
                                <i data-lucide="chevron-right" size="18" class="text-muted"></i>
                            </div>
                        @empty
                          
                                <a href="#" class="d-flex align-items-center justify-content-between p-2 rounded-3 text-decoration-none hover-item transition">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-3 bg-warning bg-opacity-10 p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                            <i data-lucide="file-text" size="20" class="text-warning"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0 small">Materi Belum Tersedia</h6>
                                            <span class="text-muted smaller">
                                                <span class="badge bg-warning bg-opacity-10 text-warning fw-bold px-1 py-0 smaller" style="color: #ea580c !important;">X</span>
                                                Materi Belum Tersedia
                                            </span>
                                        </div>
                                    </div>
                                    <i data-lucide="chevron-right" size="18" class="text-muted"></i>
                                </a>
                            
                        @endforelse
                    </div>
                </div>

                {{-- Card Ulasan --}}
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white mb-4">
                    <h6 class="fw-bold text-dark mb-4">Ulasan</h6>
                    <div class="text-center py-4">
                        <i data-lucide="message-square opacity-25" size="40" class="text-muted mb-2 mx-auto d-block"></i>
                        <p class="text-muted small mb-0">Belum ada ulasan. Jadilah yang pertama!</p>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Sidebar Ikuti Acara --}}
            <div class="col-lg-4">
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white sticky-top" style="top: 80px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold text-dark mb-0">Ikuti Acara</h6>
                        <span class="badge bg-success text-white fw-bold px-2 py-1 rounded-2 smaller">Gratis</span>
                    </div>

                    <p class="text-muted smaller mb-4">
                        Daftar gratis untuk mengikuti acara ini. Isi data diri & usahamu pada formulir berikut.
                    </p>
               @if (auth()->check() && !$eventRegister)
                    <button type="button" class="btn btn-danger w-100 rounded-3 py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm" style="background-color: #e11d48; border: none;" data-bs-toggle="modal" data-bs-target="#modalIkutiAcara">
                        <i data-lucide="user-plus" size="18"></i>
                        Ikuti Acara
                    </button>
                @elseif($eventRegister)
                    <button type="button" class="btn btn-success w-100 rounded-3 py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm" style="border: none;">
                        <i data-lucide="user-plus" size="18"></i>
                        Anda Sudah Terdaftar
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-danger w-100 text-decoration-none rounded-3 py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm" style="background-color: #e11d48; border: none;">
                            <i data-lucide="user-plus" size="18"></i>
                            Login Untuk Mengikuti Acara
                    </a>
               @endif
                </div>
            </div>




        </div>

    </div>

    {{-- MODAL POPUP: Formulir Ikuti Acara --}}
<div class="modal fade" id="modalIkutiAcara" tabindex="-1" aria-labelledby="modalIkutiAcaraLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow p-3">
            
            {{-- Header Modal --}}
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="modalIkutiAcaraLabel">Formulir Ikuti Acara</h5>
                    <p class="text-muted smaller mb-0">{{ $event->judul ?? 'Legal Academy' }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Form Body Modal --}}
            <form action="{{ route('frontend.modul.store', $elearning->id) }}" method="POST">
                @csrf
                <div class="modal-body py-4">
                    <div class="row g-3">
                        
                        {{-- Row 1: Nama & No HP --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control rounded-3 py-2" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">No HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control rounded-3 py-2" placeholder="08xxxxxxxxxx" required>
                        </div>

                        {{-- Row 2: Email & Alamat --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control rounded-3 py-2" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Alamat <span class="text-danger">*</span></label>
                            <input type="text" name="alamat" class="form-control rounded-3 py-2" required>
                        </div>

                        {{-- Row 3: Jenis Usaha & Nama Usaha --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Jenis Usaha <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_usaha" class="form-control rounded-3 py-2" placeholder="mis. Kuliner, Fashion, Kerajinan" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Nama Usaha <span class="text-danger">*</span></label>
                            <input type="text" name="nama_usaha" class="form-control rounded-3 py-2" required>
                        </div>

                        {{-- Row 4: Lokasi Merchant & Pendapatan / Bulan --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Lokasi Merchant <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi_merchant" class="form-control rounded-3 py-2" placeholder="Kota / alamat tempat usaha" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">Pendapatan / Bulan <span class="text-danger">*</span></label>
                            <select name="pendapatan_bulanan" class="form-select rounded-3 py-2" required>
                                <option value="" selected disabled>Pilih rentang...</option>
                                <option value="< 5 Juta">&lt; Rp 5.000.000</option>
                                <option value="5 - 15 Juta">Rp 5.000.000 - Rp 15.000.000</option>
                                <option value="15 - 50 Juta">Rp 15.000.000 - Rp 50.000.000</option>
                                <option value="> 50 Juta">&gt; Rp 50.000.000</option>
                            </select>
                        </div>

                    </div>
                </div>

                {{-- Footer Modal Buttons --}}
                <div class="modal-footer border-0 pt-0 justify-content-end gap-2">
                    <button type="button" class="btn btn-light border rounded-3 px-4 py-2 text-dark small fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-3 px-4 py-2 text-white small fw-semibold d-flex align-items-center gap-1 shadow-sm" style="background-color: #e11d48; border: none;">
                        <i data-lucide="check-circle-2" size="16"></i>
                        Daftar Sekarang
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
</div>

<style>
    .smaller { font-size: 0.78rem; }
    .transition { transition: all 0.2s ease; }
    .hover-item:hover {
        background-color: #f8fafc;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>
@endsection