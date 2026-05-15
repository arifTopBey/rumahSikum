@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light min-vh-100 pb-5">
    <div class="row pt-5 mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Manajemen Pengguna</a></li>
                        <li class="breadcrumb-item active">Detail Akun</li>
                    </ol>
                </nav>
                <h4 class="fw-800 text-dark mb-0">Informasi Pengguna</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.daftar.pengguna.index') }}" class="btn btn-white border rounded-3 px-4 fw-bold shadow-sm">
                    <i data-lucide="arrow-left" size="18" class="me-1"></i> Kembali
                </a>
                <!-- <button class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                    <i data-lucide="edit-3" size="18" class="me-1"></i> Edit User
                </button> -->
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-4">
                <div class="position-relative d-inline-block mx-auto mb-3">
                    <div class="avatar-big bg-{{ $user->role == 'admin' ? 'primary' : ($user->role == 'vendor' ? 'success' : 'info') }} text-white shadow">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <span class="status-badge-online shadow-sm" title="User Online"></span>
                </div>
                
                <h5 class="fw-800 text-dark mb-1">{{ $user->name }}</h5>
                <p class="text-muted small mb-3">{{ $user->email }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-4">
                    <span class="role-badge role-{{ $user->role }}">
                        {{ ucfirst($user->role) }}
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-bold smaller">
                        ID: #USR-{{ $user->id }}
                    </span>
                </div>

                <div class="row g-2 border-top pt-4">
                    <div class="col-6 border-end">
                        <p class="smaller text-muted mb-1 text-uppercase fw-bold">Status Akut</p>
                        <span class="text-success fw-bold small"><i data-lucide="check-circle" size="14"></i> Aktif</span>
                    </div>
                    <div class="col-6">
                        <p class="smaller text-muted mb-1 text-uppercase fw-bold">Terverifikasi</p>
                        <span class="text-primary fw-bold small"><i data-lucide="shield-check" size="14"></i> Ya</span>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-800 mb-3 smaller text-muted text-uppercase">Kontak & Keamanan</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-light rounded-3 me-3"><i data-lucide="phone" size="18"></i></div>
                    <div>
                        <p class="smaller text-muted mb-0">Nomor Telepon</p>
                        <p class="small fw-bold mb-0">{{ $user->phone ?? 'Belum diatur' }}</p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-light rounded-3 me-3"><i data-lucide="mail" size="18"></i></div>
                    <div>
                        <p class="smaller text-muted mb-0">Email Utama</p>
                        <p class="small fw-bold mb-0 text-truncate">{{ $user->email }}</p>
                    </div>
                </div>
                <hr>
                <button class="btn btn-outline-danger w-100 rounded-3 fw-bold btn-sm py-2 mt-2">
                    <i data-lucide="lock" size="14" class="me-2"></i> Reset Password
                </button>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h6 class="fw-800 mb-4 text-dark d-flex align-items-center gap-2 border-bottom pb-3">
                    <i data-lucide="user" class="text-primary" size="20"></i> Informasi Pribadi
                </h6>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="smaller text-muted fw-bold text-uppercase d-block mb-1">Nama Lengkap</label>
                        <p class="text-dark fw-medium">{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted fw-bold text-uppercase d-block mb-1">Role Akun</label>
                        <p class="text-dark fw-medium text-capitalize">{{ $user->role }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted fw-bold text-uppercase d-block mb-1">Tanggal Pendaftaran</label>
                        <p class="text-dark fw-medium">{{ $user->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="smaller text-muted fw-bold text-uppercase d-block mb-1">Terakhir Login</label>
                        <p class="text-dark fw-medium">2 jam yang lalu <span class="smaller text-muted fw-normal">(Contoh)</span></p>
                    </div>
                </div>
            </div>

            @if($user->role == 'vendor')
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-primary bg-opacity-10 border-start border-4 border-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-white p-3 rounded-4 shadow-sm">
                            <i data-lucide="store" class="text-primary" size="32"></i>
                        </div>
                        <div>
                            <h6 class="fw-800 mb-1 text-dark">Informasi Toko Mitra</h6>
                            <p class="small text-muted mb-0">User ini terdaftar sebagai pemilik toko UMKM.</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary rounded-3 fw-bold btn-sm px-4">Lihat Profil Toko</a>
                </div>
            </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-800 mb-4 text-dark d-flex align-items-center gap-2 border-bottom pb-3">
                    <i data-lucide="activity" class="text-primary" size="20"></i> Aktivitas Terakhir
                </h6>
                <div class="timeline">
                    <div class="d-flex gap-3 mb-4">
                        <div class="smaller text-muted" style="width: 80px;">14:10</div>
                        <div class="border-start ps-3 position-relative">
                            <span class="dot-timeline bg-success"></span>
                            <p class="small fw-bold mb-0">Login Berhasil</p>
                            <p class="smaller text-muted mb-0">Login via Chrome - Windows 11</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-4">
                        <div class="smaller text-muted" style="width: 80px;">Kemarin</div>
                        <div class="border-start ps-3 position-relative">
                            <span class="dot-timeline bg-primary"></span>
                            <p class="small fw-bold mb-0">Memperbarui Produk</p>
                            <p class="smaller text-muted mb-0">Mengubah stok pada "Kripik Tempe Pedas"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .btn-white { background: white; }

    /* Avatar & Badge */
    .avatar-big {
        width: 120px;
        height: 120px;
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 800;
    }
    .status-badge-online {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
        background: #22c55e;
        border: 4px solid #fff;
        border-radius: 50%;
    }

    /* Role Badges */
    .role-badge {
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .role-admin { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
    .role-vendor { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }
    .role-user { background: #f8fafc; color: #64748b; border: 1px solid #f1f5f9; }

    .icon-box {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
    }

    /* Timeline Style */
    .dot-timeline {
        position: absolute;
        left: -5px;
        top: 5px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
</style>

<script>
    lucide.createIcons();
</script>
@endsection