@extends('frontend.main.index')

@section('content')
<div class="container registration-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="registration-card shadow-lg">
                <div class="row g-0">
                    <div class="col-md-5">
                        <div class="training-summary-box">
                            <a href="{{ url()->previous() }}" class="text-white text-decoration-none small mb-4 d-inline-block">
                                <i data-lucide="chevron-left" size="16"></i> Kembali ke Daftar
                            </a>
                            <h3 class="fw-800 mb-4">Konfirmasi Pendaftaran</h3>
                            <p class="opacity-75 mb-5">Anda akan mendaftar pada program pelatihan berikut. Pastikan jadwal sesuai dengan agenda Anda.</p>

                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="book-open"></i></div>
                                <div>
                                    <span class="smaller opacity-75 d-block">Judul Pelatihan</span>
                                    <span class="fw-bold">Strategi Digital Marketing & Iklan Facebook</span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="user"></i></div>
                                <div>
                                    <span class="smaller opacity-75 d-block">Mentor Ahli</span>
                                    <span class="fw-bold">Andi Pratama, MBA</span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="calendar"></i></div>
                                <div>
                                    <span class="smaller opacity-75 d-block">Tanggal Pelaksanaan</span>
                                    <span class="fw-bold">10 April 2026</span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="video"></i></div>
                                <div>
                                    <span class="smaller opacity-75 d-block">Metode Pelatihan</span>
                                    <span class="fw-bold">Online via Zoom Meeting</span>
                                </div>
                            </div>

                            <hr class="my-5 opacity-25">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Biaya Pendaftaran</span>
                                <h4 class="fw-800 m-0">GRATIS</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="form-container">
                            <h4 class="fw-800 mb-4">Lengkapi Data Diri</h4>
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Nama Lengkap (Sesuai Sertifikat)</label>
                                    <input type="text" class="form-control input-custom" placeholder="Masukkan nama lengkap Anda" required>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">WhatsApp</label>
                                        <input type="tel" class="form-control input-custom" placeholder="0812xxxx" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">E-mail</label>
                                        <input type="email" class="form-control input-custom" placeholder="email@anda.com" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Nama UMKM / Usaha</label>
                                    <input type="text" class="form-control input-custom" placeholder="Contoh: Batik Maju Tangerang" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-muted">Apa motivasi Anda mengikuti kelas ini?</label>
                                    <textarea class="form-control input-custom" rows="3" placeholder="Ceritakan singkat target yang ingin Anda capai..."></textarea>
                                </div>

                                <div class="alert alert-warning rounded-4 border-0 small d-flex gap-2">
                                    <i data-lucide="alert-circle" size="18" class="flex-shrink-0"></i>
                                    <span>Link akses pelatihan akan dikirimkan melalui WhatsApp maksimal H-1 acara.</span>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow mt-3">
                                    Kirim Pendaftaran Sekarang
                                </button>
                                
                                <p class="text-center mt-3 text-muted smaller">
                                    Pendaftaran bersifat final. Mohon hadir tepat waktu.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
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