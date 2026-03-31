@extends('frontend.main.index')

@section('content')


<div class="container account-wrapper">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="account-nav shadow-sm">
                <div class="text-center mb-4">
                    <h6 class="fw-800 mb-0">Halo, Budi Santoso!</h6>
                    <p class="small text-muted">Member sejak 2024</p>
                </div>
                <nav>
                    <a href="#" class="nav-link-account active">
                        <i data-lucide="user" size="18"></i> Profil Saya
                    </a>
                    <a href="#" class="nav-link-account">
                        <i data-lucide="package" size="18"></i> Pesanan Saya
                    </a>
                    <a href="{{ route('frontend.alamat.saya') }}" class="nav-link-account">
                        <i data-lucide="map-pin" size="18"></i> Daftar Alamat
                    </a>
                    <a href="#" class="nav-link-account text-danger mt-4">
                        <i data-lucide="log-out" size="18"></i> Keluar Akun
                    </a>
                </nav>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="profile-card">
                <h4 class="fw-800 mb-4">Pengaturan Profil</h4>
                
                <form action="#" method="POST">
                    @csrf
                    <div class="avatar-upload">
                        <img src="https://i.pravatar.cc/300?u=budi" class="avatar-preview" id="preview">
                        <button type="button" class="btn-edit-avatar shadow-sm">
                            <i data-lucide="camera" size="16"></i>
                        </button>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-custom" value="Budi Santoso">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Email</label>
                            <input type="email" class="form-control form-control-custom" value="budi.santoso@email.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Nomor WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light rounded-start-3">62</span>
                                <input type="number" class="form-control form-control-custom rounded-start-0" value="8123456789">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-custom">
                        </div>
                        <div class="col-12 mt-5">
                            <hr class="opacity-50">
                            <h5 class="fw-bold mb-4">Keamanan Akun</h5>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Password Baru (Kosongkan jika tidak ganti)</label>
                            <input type="password" class="form-control form-control-custom" placeholder="••••••••">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control form-control-custom" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="mt-5 d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow">Simpan Perubahan</button>
                        <button type="reset" class="btn btn-light rounded-pill px-4 py-2">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    lucide.createIcons();
</script>

@endsection