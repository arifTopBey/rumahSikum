@extends('admin.main.main')

@section('content')
<div class="container-fluid px-5 bg-light pb-5">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row pt-5 mb-4">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-800 text-primary mb-1">Profil Toko UMKM</h4>
                    <p class="text-muted small mb-0">Kelola identitas bisnis Anda untuk membangun kepercayaan pelanggan.</p>
                </div>
                <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                    <i data-lucide="save" size="18" class="me-2"></i> Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                    <h6 class="fw-800 mb-4 text-start text-dark">Branding Toko</h6>
                    
                    <div class="position-relative d-inline-block mb-3">
                        <div class="rounded-circle overflow-hidden border border-4 border-white shadow-sm mx-auto" style="width: 150px; height: 150px;">
                            <img id="logo-preview" src="{{ route('show.thumbnail.produk.private', $vendor->store_photo) }}" class="w-100 h-100 object-fit-cover">
                            <!-- <img id="logo-preview" src="{{ asset('storage/' . $vendor->store_photo) }}" class="w-100 h-100 object-fit-cover"> -->
                        </div>
                        <label for="store_photo" class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0 p-2 shadow">
                            <i data-lucide="camera" size="16"></i>
                            <input type="file" name="store_photo" id="store_photo" class="d-none" onchange="previewLogo(this)">
                        </label>
                    </div>
                    
                    <h5 class="fw-bold mb-1">{{ $vendor->shop_name }}</h5>
                    <p class="text-muted smaller mb-3">Mitra sejak {{ $vendor->created_at->format('M Y') }}</p>
                    
                    <div class="bg-light rounded-3 p-3 text-start">
                        <div class="d-flex align-items-center mb-2">
                            <i data-lucide="user" size="16" class="text-primary me-2"></i>
                            <span class="small fw-bold">{{ $vendor->name }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i data-lucide="phone" size="16" class="text-success me-2"></i>
                            <span class="small text-muted">{{ $vendor->phone }}</span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 rounded-4 p-4 mt-4 bg-primary bg-opacity-10 text-primary">
                    <div class="d-flex gap-3">
                        <i data-lucide="shield-check" size="24"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Status Verifikasi</h6>
                            <p class="smaller mb-0 opacity-75">Toko Anda telah terverifikasi oleh Admin Dinas. Perubahan nama toko mungkin memerlukan peninjauan kembali.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-800 mb-4 text-dark d-flex align-items-center gap-2 border-bottom pb-3">
                        <i data-lucide="info" class="text-primary" size="20"></i> Informasi Bisnis
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Nama Brand / Toko</label>
                            <input type="text" name="shop_name" class="form-control rounded-3 border-2" value="{{ $vendor->shop_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Kategori Produk Utama</label>
                            <select name="kategori_produk_id" class="form-select rounded-3 border-2">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $vendor->kategori_produk_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Deskripsi Singkat Toko</label>
                            <textarea name="shop_description" class="form-control rounded-3 border-2" rows="4" placeholder="Ceritakan keunggulan produk atau sejarah singkat UMKM Anda...">{{ $vendor->shop_description ?? '' }}</textarea>
                        </div>
                    </div>

                    <h6 class="fw-800 mt-5 mb-4 text-dark d-flex align-items-center gap-2 border-bottom pb-3">
                        <i data-lucide="map-pin" class="text-primary" size="20"></i> Lokasi & Alamat Operasional
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control rounded-3 border-2" value="{{ $vendor->provinsi }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Kabupaten / Kota</label>
                            <input type="text" name="kab_kota" class="form-control rounded-3 border-2" value="{{ $vendor->kab_kota }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control rounded-3 border-2" value="{{ $vendor->kecamatan }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control rounded-3 border-2" value="{{ $vendor->kelurahan }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control rounded-3 border-2" value="{{ $vendor->kode_pos }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Alamat Lengkap</label>
                            <textarea name="shop_address" class="form-control rounded-3 border-2" rows="3">{{ $vendor->shop_address }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .smaller { font-size: 0.75rem; }
    .object-fit-cover { object-fit: cover; }
    .border-2 { border-width: 2px !important; }
    .form-control:focus, .form-select:focus {
        border-color: #a82282;
        box-shadow: none;
    }
</style>

@push('scripts')
<script>
    lucide.createIcons();

    function previewLogo(input) {
        const preview = document.getElementById('logo-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection