@extends('dashboard.main.index')

@section('content-dashboard')
<div class="dashboard-wrapper border">
    <div class="row g-0">
        <div class="col-lg-3 border-end" style="min-height: 100vh; background: white;">
            <div class="sidebar-menu p-4">
                <div class="d-flex align-items-center gap-3 mb-4 px-2">
                    <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i data-lucide="store" size="24"></i>
                    </div>
                    <div>
                        <h6 class="fw-800 mb-0">Toko Batik Jaya</h6>
                        <span class="badge bg-success-subtle text-success smaller">Toko Aktif</span>
                    </div>
                </div>
                
                <nav>
                    <a href="#" class="nav-dash-link"><i data-lucide="layout-dashboard" size="18"></i> Dashboard</a>
                    <a href="#" class="nav-dash-link"><i data-lucide="package" size="18"></i> Produk Saya</a>
                    <a href="#" class="nav-dash-link d-flex justify-content-between align-items-center">
                        <span class="d-flex align-items-center gap-2"><i data-lucide="shopping-cart" size="18"></i> Pesanan</span>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </a>
                    <a href="#" class="nav-dash-link"><i data-lucide="wallet" size="18"></i> Saldo & Penarikan</a>
                    <a href="#" class="nav-dash-link"><i data-lucide="megaphone" size="18"></i> Promosi Toko</a>
                    <hr class="my-3 opacity-50">
                    <a href="#" class="nav-dash-link active"><i data-lucide="settings" size="18"></i> Pengaturan Toko</a>
                    <a href="#" class="nav-dash-link text-danger"><i data-lucide="log-out" size="18"></i> Keluar Seller</a>
                </nav>
            </div>
        </div>

        <div class="col-lg-9 px-4 py-4 bg-light">
            <div class="mb-4">
                <h4 class="fw-800 mb-1 text-dark">Pengaturan Toko</h4>
                <p class="text-muted small mb-0">Perbarui informasi profil toko dan alamat pengiriman Anda.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white mb-4">
                        <h6 class="fw-800 mb-4 text-start">Logo Toko</h6>
                        <div class="position-relative d-inline-block mx-auto mb-3">
                            <img src="https://ui-avatars.com/api/?name=Batik+Jaya&background=4361ee&color=fff&size=128" class="rounded-circle border p-1" width="120" id="preview-logo">
                            <label for="logo-upload" class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0 p-2 shadow">
                                <i data-lucide="camera" size="16"></i>
                                <input type="file" id="logo-upload" hidden>
                            </label>
                        </div>
                        <p class="smaller text-muted">Format: JPG, PNG. Maksimal 2MB.</p>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h6 class="fw-800 mb-3">Status Operasional</h6>
                        <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                            <label class="form-check-label small fw-bold" for="tutupToko">Buka Toko</label>
                            <input class="form-check-input ms-0" type="checkbox" role="switch" id="tutupToko" checked style="width: 40px; height: 20px;">
                        </div>
                        <hr class="my-3 opacity-50">
                        <p class="smaller text-muted mb-0"><i data-lucide="info" size="14" class="me-1"></i> Jika dinonaktifkan, produk Anda tidak akan muncul di pencarian pelanggan.</p>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                        <div class="card-header bg-white p-0">
                            <ul class="nav nav-tabs border-0 px-4 pt-3">
                                <li class="nav-item">
                                    <a class="nav-link active fw-bold small border-0 border-bottom border-primary border-3" href="#">Informasi Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-muted small border-0" href="#">Alamat & Kurir</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <form>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">Nama Toko</label>
                                        <input type="text" class="form-control rounded-3" value="Toko Batik Jaya">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">Slogan Toko (Opsional)</label>
                                        <input type="text" class="form-control rounded-3" placeholder="Contoh: Batik Berkualitas Tangerang">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold text-muted">Deskripsi Toko</label>
                                        <textarea class="form-control rounded-3" rows="4">Menyediakan berbagai macam batik khas Tangerang dengan motif unik dan kualitas premium sejak tahun 2020.</textarea>
                                    </div>
                                </div>

                                <h6 class="fw-800 mb-3 pt-3 border-top">Informasi Kontak</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">Nomor WhatsApp</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 small">+62</span>
                                            <input type="text" class="form-control rounded-3 border-start-0" value="81234567890">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">Email Bisnis</label>
                                        <input type="email" class="form-control rounded-3" value="batikjaya@email.com">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold me-2">Batal</button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow">Simpan Perubahan</button>
                                </div>
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