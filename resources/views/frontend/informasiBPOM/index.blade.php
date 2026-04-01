@extends('frontend.main.index')

@section('content')


<div class="container bpom-wrapper">
    <div class="bpom-header shadow-sm text-center">
        <span class="bpom-badge">Panduan Legalitas UMKM</span>
        <h1 class="fw-800 display-5 mb-3 text-dark">Informasi Sertifikasi BPOM</h1>
        <p class="text-muted lead mx-auto" style="max-width: 800px;">
            Pastikan produk UMKM Anda aman dan memiliki daya saing tinggi dengan mendaftarkan izin edar BPOM. Berikut adalah panduan lengkap proses pendaftarannya.
        </p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="step-card shadow-sm">
                <div class="step-number">1</div>
                <h5 class="fw-800 mb-3">Persiapan Dokumen</h5>
                <p class="text-muted small">Menyiapkan data administratif dan data teknis produk sesuai dengan kategori pangan atau kosmetik.</p>
                <ul class="req-list">
                    <li><i data-lucide="check-circle" size="18" class="check-icon"></i> NIB (Nomor Induk Berusaha)</li>
                    <li><i data-lucide="check-circle" size="18" class="check-icon"></i> NPWP Perusahaan/Individu</li>
                    <li><i data-lucide="check-circle" size="18" class="check-icon"></i> Hasil Uji Laboratorium</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="step-card shadow-sm">
                <div class="step-number">2</div>
                <h5 class="fw-800 mb-3">Pendaftaran Akun</h5>
                <p class="text-muted small">Melakukan registrasi melalui portal resmi e-BPOM untuk mendapatkan User ID dan Password.</p>
                <a href="https://e-bpom.pom.go.id" target="_blank" class="btn btn-outline-primary rounded-pill btn-sm fw-bold px-4">Kunjungi e-BPOM <i data-lucide="external-link" size="14"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="step-card shadow-sm">
                <div class="step-number">3</div>
                <h5 class="fw-800 mb-3">Pemeriksaan & Audit</h5>
                <p class="text-muted small">Tahap evaluasi dokumen dan pemeriksaan sarana produksi (PSB) oleh petugas BPOM setempat.</p>
                <div class="alert alert-info rounded-4 border-0 small py-2 mt-3">
                    <i data-lucide="info" size="14" class="me-1"></i> Estimasi waktu: 30 - 60 Hari Kerja.
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6">
            <h3 class="fw-800 mb-4">Pertanyaan Populer (FAQ)</h3>
            <div class="accordion" id="faqBpom">
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apakah UMKM mendapatkan keringanan biaya?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqBpom">
                        <div class="accordion-body text-muted">
                            Ya, berdasarkan PP No. 32 Tahun 2017, pelaku UMKM mendapatkan keringanan biaya pendaftaran sebesar 50% dari tarif normal PNBP.
                        </div>
                    </div>
                </div>
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Berapa lama masa berlaku izin BPOM?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqBpom">
                        <div class="accordion-body text-muted">
                            Nomor Izin Edar (NIE) BPOM berlaku selama 5 tahun dan dapat diperpanjang melalui aplikasi e-BPOM sebelum masa berlakunya habis.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 offset-lg-1 mt-4 mt-lg-0">
            <div class="bg-primary text-white p-5 rounded-5 shadow-lg position-relative overflow-hidden">
                <i data-lucide="help-circle" size="120" style="position: absolute; right: -20px; bottom: -20px; opacity: 0.1;"></i>
                <h4 class="fw-800 mb-3">Butuh Bantuan Konsultasi?</h4>
                <p class="opacity-90 mb-4">Tim RumahSikum siap membantu mendampingi proses pendaftaran izin BPOM produk Anda secara gratis.</p>
                <a href="https://wa.me/6281234567890" class="btn btn-white bg-white text-primary rounded-pill px-4 fw-bold shadow">
                    Chat Admin Lewat WA
                </a>
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