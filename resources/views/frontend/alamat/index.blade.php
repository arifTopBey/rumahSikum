@extends('frontend.main.index')

@section('content')
@push('styles')
<style>
    body { background-color: #f4f7fe; }
    .address-wrapper { margin-top: 120px; margin-bottom: 100px; }

    /* Sidebar Nav (Konsisten dengan Profile) */
    .account-nav {
        background: white;
        border-radius: 25px;
        padding: 20px;
        border: 1px solid #edf2f7;
    }
    .nav-link-account {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        border-radius: 15px;
        color: #64748b;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
        margin-bottom: 5px;
    }
    .nav-link-account:hover, .nav-link-account.active {
        background: rgba(67, 97, 238, 0.08);
        color: #4361ee;
    }

    /* Address Card */
    .address-card {
        background: white;
        border-radius: 25px;
        padding: 25px;
        border: 2px solid transparent;
        transition: 0.3s;
        position: relative;
    }
    .address-card.is-main {
        border-color: #4361ee;
        background: #f8faff;
    }
    
    .badge-main {
        background: #4361ee;
        color: white;
        font-size: 10px;
        padding: 4px 10px;
        border-radius: 8px;
        text-transform: uppercase;
        font-weight: 800;
    }

    .btn-add-address {
        border: 2px dashed #cbd5e1;
        background: transparent;
        color: #64748b;
        border-radius: 25px;
        padding: 30px;
        width: 100%;
        font-weight: 700;
        transition: 0.3s;
    }
    .btn-add-address:hover {
        border-color: #4361ee;
        color: #4361ee;
        background: rgba(67, 97, 238, 0.02);
    }

    /* Modal Styling */
    .modal-content { border-radius: 30px; border: none; padding: 15px; }
    .form-control-custom {
        border-radius: 15px;
        padding: 12px 18px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }
</style>
@endpush

<div class="container address-wrapper">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="account-nav shadow-sm">
                <div class="text-center mb-4">
                    <h6 class="fw-800 mb-0">Budi Santoso</h6>
                    <p class="small text-muted m-0">Member Silver</p>
                </div>
                <nav>
                    <a href="#" class="nav-link-account">
                        <i data-lucide="user" size="18"></i> Profil Saya
                    </a>
                    <a href="#" class="nav-link-account">
                        <i data-lucide="package" size="18"></i> Pesanan Saya
                    </a>
                    <a href="#" class="nav-link-account active">
                        <i data-lucide="map-pin" size="18"></i> Daftar Alamat
                    </a>
                    <a href="#" class="nav-link-account text-danger mt-4">
                        <i data-lucide="log-out" size="18"></i> Keluar Akun
                    </a>
                </nav>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 m-0">Alamat Pengiriman</h4>
                <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAlamat">
                    <i data-lucide="plus" size="18" class="me-1"></i> Tambah Alamat
                </button>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <div class="address-card is-main shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="fw-800 fs-5 d-block">Rumah Utama</span>
                                <span class="badge-main mt-2 d-inline-block">Utama</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                    <i data-lucide="more-horizontal" size="18"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                    <li><a class="dropdown-item rounded-3" href="#"><i data-lucide="edit" size="14" class="me-2"></i> Ubah Alamat</a></li>
                                    <li><a class="dropdown-item rounded-3 text-danger" href="#"><i data-lucide="trash-2" size="14" class="me-2"></i> Hapus</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="text-muted">
                            <p class="fw-bold text-dark mb-1">Budi Santoso (0812-3456-7890)</p>
                            <p class="small mb-0">Jl. Raya Tigaraksa No. 12, Kelurahan Tigaraksa, Kec. Tigaraksa, Kabupaten Tangerang, Banten, 15720.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="address-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="fw-800 fs-5 d-block">Kantor</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                    <i data-lucide="more-horizontal" size="18"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                    <li><a class="dropdown-item rounded-3" href="#">Jadikan Utama</a></li>
                                    <li><a class="dropdown-item rounded-3" href="#"><i data-lucide="edit" size="14" class="me-2"></i> Ubah</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="text-muted">
                            <p class="fw-bold text-dark mb-1">Budi Santoso (0812-9988-7766)</p>
                            <p class="small mb-0">Gedung Pusat Pemerintahan Kabupaten Tangerang, Lantai 3, Jl. H. Somawinata, Tigaraksa.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <button class="btn-add-address" data-bs-toggle="modal" data-bs-target="#modalAlamat">
                        <i data-lucide="plus-circle" size="30" class="mb-2 d-block mx-auto opacity-50"></i>
                        Tambah Alamat Baru
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAlamat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 px-4">
                <h5 class="fw-800 m-0">Tambah Alamat Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label class="fw-bold small mb-2">Label Alamat</label>
                        <input type="text" class="form-control form-control-custom" placeholder="Contoh: Rumah, Kantor, Kos">
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold small mb-2">Nama Penerima</label>
                        <input type="text" class="form-control form-control-custom" placeholder="Nama Lengkap">
                    </div>
                    <div class="col-md-12">
                        <label class="fw-bold small mb-2">Nomor WhatsApp</label>
                        <input type="number" class="form-control form-control-custom" placeholder="0812xxxx">
                    </div>
                    <div class="col-md-12">
                        <label class="fw-bold small mb-2">Alamat Lengkap</label>
                        <textarea class="form-control form-control-custom" rows="3" placeholder="Nama jalan, nomor rumah, RT/RW"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold small mb-2">Kecamatan</label>
                        <select class="form-select form-control-custom">
                            <option>Tigaraksa</option>
                            <option>Kelapa Dua</option>
                            <option>Cikupa</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold small mb-2">Kode Pos</label>
                        <input type="text" class="form-control form-control-custom">
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow">Simpan Alamat</button>
                    </div>
                </form>
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