@extends('frontend.main.index')

@section('content')
<div class="container training-wrapper">
    <div class="training-hero shadow-sm">
        <div class="flex-grow-1">
            <span class="badge bg-primary-soft text-primary mb-3 px-3 py-2 rounded-pill fw-bold">Pusat Pelatihan UMKM</span>
            <h1 class="fw-800 mb-3">Tingkatkan Bisnis Anda dengan Mentor Ahli</h1>
            <p class="text-muted lead mb-0">Program pelatihan intensif untuk membantu UMKM Kabupaten Tangerang naik kelas dalam pemasaran digital, branding, dan manajemen.</p>
        </div>
        <div class="d-none d-lg-block">
            <i data-lucide="graduation-cap" size="120" class="text-primary opacity-25"></i>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div class="d-flex gap-2">
            <button class="btn btn-primary rounded-pill px-4">Semua Kelas</button>
            <button class="btn btn-light border rounded-pill px-4">Pemasaran</button>
            <button class="btn btn-light border rounded-pill px-4">Manajemen</button>
            <button class="btn btn-light border rounded-pill px-4">Legalitas</button>
        </div>
        <div class="text-muted fw-bold">Menampilkan 12 Kelas Pelatihan</div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="training-card shadow-sm">
                <div class="training-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600" class="training-img" alt="Digital Marketing">
                    <div class="price-badge">Gratis</div>
                </div>
                <div class="training-body">
                    <div class="mentor-info">
                        <img src="https://i.pravatar.cc/100?u=mentor1" class="mentor-img">
                        <span class="small text-muted fw-bold">Andi Pratama, MBA</span>
                    </div>
                    <h5 class="training-title">Strategi Digital Marketing & Iklan Facebook untuk Pemula</h5>
                    
                    <div class="d-flex gap-2 mb-4">
                        <span class="tag-item"><i data-lucide="video" size="12"></i> Zoom</span>
                        <span class="tag-item"><i data-lucide="calendar" size="12"></i> 10 April</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="slot-status">Sisa 5 Slot Lagi!</span>
                        <div class="progress flex-grow-1 ms-3" style="height: 6px;">
                            <div class="progress-bar bg-danger" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <a href="{{ route('frontend.daftar.pelatihan') }}" class="btn-register-training">Daftar Pelatihan</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="training-card shadow-sm">
                <div class="training-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600" class="training-img" alt="Branding">
                    <div class="price-badge">Rp 50.000</div>
                </div>
                <div class="training-body">
                    <div class="mentor-info">
                        <img src="https://i.pravatar.cc/100?u=mentor2" class="mentor-img">
                        <span class="small text-muted fw-bold">Sarah Wijaya</span>
                    </div>
                    <h5 class="training-title">Membangun Identitas Brand yang Menarik Pelanggan</h5>
                    
                    <div class="d-flex gap-2 mb-4">
                        <span class="tag-item"><i data-lucide="map-pin" size="12"></i> Tigaraksa</span>
                        <span class="tag-item"><i data-lucide="calendar" size="12"></i> 15 April</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-success small fw-bold">Slot Tersedia</span>
                        <div class="progress flex-grow-1 ms-3" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 40%"></div>
                        </div>
                    </div>
                    
                    <a href="{{ route('frontend.daftar.pelatihan') }}" class="btn-register-training">Daftar Pelatihan</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="training-card shadow-sm">
                <div class="training-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600" class="training-img" alt="Finance">
                    <div class="price-badge">Gratis</div>
                </div>
                <div class="training-body">
                    <div class="mentor-info">
                        <img src="https://i.pravatar.cc/100?u=mentor3" class="mentor-img">
                        <span class="small text-muted fw-bold">Hendra Saputra</span>
                    </div>
                    <h5 class="training-title">Manajemen Keuangan & Pembukuan Sederhana UMKM</h5>
                    
                    <div class="d-flex gap-2 mb-4">
                        <span class="tag-item"><i data-lucide="video" size="12"></i> Webinar</span>
                        <span class="tag-item"><i data-lucide="calendar" size="12"></i> 20 April</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-success small fw-bold">Slot Tersedia</span>
                        <div class="progress flex-grow-1 ms-3" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 20%"></div>
                        </div>
                    </div>
                    
                    <a href="{{ route('frontend.daftar.pelatihan') }}" class="btn-register-training">Daftar Pelatihan</a>
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