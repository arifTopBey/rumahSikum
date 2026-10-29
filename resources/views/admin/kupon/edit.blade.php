@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5" style="background-color: whitesmoke;">

    @if ($errors->any())
        <div class="alert alert-danger mt-4 rounded-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>  
    @endif

    <form action="{{ route('admin.kupon.update', $kupon->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row py-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 text-primary mb-1">Edit Kupon: {{ $kupon->code_kupon }}</h4>
                    <p class="text-muted small mb-0">Perbarui konfigurasi promo atau masa berlaku kupon voucher ini.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.kupon.index') }}" class="btn btn-light rounded-pill px-4 fw-bold border">Batal</a>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold shadow text-white">Simpan Perubahan</button>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-800 mb-4 d-flex align-items-center gap-2 text-primary">
                        <i data-lucide="ticket" size="18"></i> Informasi Utama Kupon
                    </h6>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Nama Kupon / Campaign</label>
                        <input type="text" name="nama_kupon" class="form-control form-control-lg rounded-3 border-2" value="{{ old('nama_kupon', $kupon->nama_kupon) }}" required>
                        <div class="form-text smaller text-muted">Nama ini akan membantu Anda mengidentifikasi tujuan pembuatan kupon.</div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-dark">Kode Kupon</label>
                            <div class="input-group">
                                <input type="text" id="code_kupon" name="code_kupon" class="form-control border-2 text-uppercase rounded-start-3 fw-bold" value="{{ old('code_kupon', $kupon->code_kupon) }}" required>
                                <button class="btn btn-outline-primary rounded-end-3" type="button" id="btn-generate">
                                    <i data-lucide="refresh-cw" size="16" class="me-1"></i> Acak Kode
                                </button>
                            </div>
                            <div class="form-text smaller text-muted">Kode unik yang nantinya dimasukkan oleh pembeli saat checkout.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-dark">Besar Potongan Diskon</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-2">Rp</span>
                                <input type="number" name="diskon_value" class="form-control border-2 rounded-end-3" value="{{ old('diskon_value', $kupon->diskon_value) }}" min="1" required>
                            </div>
                            <div class="form-text smaller text-muted">Jumlah nominal potongan langsung (dalam Rupiah).</div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-800 mb-4 d-flex align-items-center gap-2 text-primary">
                        <i data-lucide="shield-alert" size="18"></i> Batasan Penggunaan
                    </h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-dark">Maksimal Kuat / Penggunaan</label>
                            <div class="input-group">
                                <input type="number" name="max_use" class="form-control border-2 rounded-start-3" value="{{ old('max_use', $kupon->max_use) }}" min="1" required>
                                <span class="input-group-text bg-light border-2">Kali</span>
                            </div>
                            <div class="form-text smaller text-muted">Batas kuota total kupon ini bisa digunakan oleh seluruh pembeli.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <h6 class="fw-800 mb-4 d-flex align-items-center gap-2 text-primary">
                        <i data-lucide="calendar" size="18"></i> Masa Berlaku Promo
                    </h6>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control rounded-3 border-2" value="{{ old('tanggal_mulai', $kupon->tanggal_mulai) }}" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted">Tanggal Berakhir</label>
                        <input type="date" name="tanggal_berakhir" class="form-control rounded-3 border-2" value="{{ old('tanggal_berakhir', $kupon->tanggal_berakhir) }}" required>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary bg-opacity-10 border border-primary border-opacity-25">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="status_kupon" value="1" id="statusKupon" {{ $kupon->status_kupon == 1 ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold text-primary" for="statusKupon">Status Kupon Aktif</label>
                    </div>
                    <p class="smaller text-muted mb-0">Jika dinonaktifkan, pembeli tidak akan bisa menggunakan kode kupon ini meski dalam periode promo.</p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mt-4 bg-white">
                    <h6 class="fw-800 mb-1 small text-muted text-uppercase">Informasi Sistem</h6>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="smaller text-muted">Dibuat Pada</span>
                        <span class="smaller fw-bold">{{ $kupon->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="smaller text-muted">Update Terakhir</span>
                        <span class="smaller fw-bold">{{ $kupon->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    lucide.createIcons();

    document.getElementById('btn-generate').addEventListener('click', function() {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = 'PROMO';
        const charactersLength = characters.length;
        for (let i = 0; i < 6; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        document.getElementById('code_kupon').value = result;
    });
</script>
<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .form-check-input:checked { background-color: #4361ee; border-color: #4361ee; }
</style>
@endpush
@endsection