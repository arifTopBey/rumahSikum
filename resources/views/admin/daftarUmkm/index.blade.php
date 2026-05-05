@extends('admin.main.main')

@section('content')

<style>
    :root {
            /* --primary-color: #0d6efd; */
            --primary-color: #a82282;
            --step-bg: #e2e8f0;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #f8fafc; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .reg-header {
            background: white;
            padding: 40px 0;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 50px;
        }

        /* Stepper Style */
        .step-indicator {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 40px;
        }
        .step-indicator::before {
            content: "";
            position: absolute;
            top: 50%; left: 0; right: 0;
            height: 2px;
            background: var(--step-bg);
            z-index: 1;
            transform: translateY(-50%);
        }
        .step {
            width: 40px; height: 40px;
            background: white;
            border: 2px solid var(--step-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            font-weight: bold;
            color: #64748b;
            transition: 0.3s;
        }
        .step.active {
            border-color: var(--primary-color);
            background: var(--primary-color);
            color: white;
        }
        .step.completed {
            background: #10b981;
            border-color: #10b981;
            color: white;
        }

        /* Card Form */
        .form-container {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
        }

        .form-label { font-weight: 600; font-size: 0.9rem; color: #475569; }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            background: #fcfdfe;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            border-color: var(--primary-color);
        }

        .upload-box {
            border: 2px dashed #cbd5e1;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }
        .upload-box:hover { background: #f1f5f9; border-color: var(--primary-color); }
</style>



<header class="reg-header text-center py-5">
    <div class="container">
        <h4 class="fw-bold">Pendaftaran Mitra UMKM</h4>
        <p class="text-muted small mb-0">Lengkapi data usaha Anda untuk mulai Go-Digital</p>
    </div>
</header>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="px-md-5">
                <div class="step-indicator">
                    <div class="step active" id="step-i-1">1</div>
                    <div class="step" id="step-i-2">2</div>
                    <div class="step" id="step-i-3">3</div>
                    <div class="step" id="step-i-4">4</div>
                </div>
            </div>

            <div class="form-container shadow-sm">
                <form action="" method="POST" enctype="multipart/form-data" id="registrationForm">
                    @csrf
                    
                    <div class="step-content" id="step-1">
                        <h5 class="fw-bold mb-4"><i data-lucide="user" class="me-2 text-primary"></i>Informasi Pemilik Usaha</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap Sesuai KTP</label>
                                <input type="text" name="nama_pemilik" class="form-control" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor WhatsApp</label>
                                <input type="number" name="no_wa" class="form-control" placeholder="0812xxxx" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">NIK (Nomor Induk Kependudukan)</label>
                                <input type="number" name="nik" class="form-control" placeholder="16 Digit NIK" required>
                            </div>
                        </div>
                    </div>

                    <div class="step-content d-none" id="step-2">
                        <h5 class="fw-bold mb-4"><i data-lucide="briefcase" class="me-2 text-primary"></i>Profil Bisnis</h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Nama Brand / Toko</label>
                                <input type="text" name="nama_toko" class="form-control" placeholder="Contoh: Kripik Berkah Jaya">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori Usaha</label>
                                <select name="kategori" class="form-select">
                                    <option selected disabled>Pilih Kategori</option>
                                    <option>Kuliner</option>
                                    <option>Fashion</option>
                                    <option>Kerajinan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <select name="kecamatan" class="form-select">
                                    <option selected disabled>Pilih Kecamatan</option>
                                    <option>Tigaraksa</option>
                                    <option>Cikupa</option>
                                    <option>Kelapa Dua</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat Lengkap Usaha</label>
                                <textarea name="alamat_usaha" class="form-control" rows="3" placeholder="Jl. Raya No. XX, Desa XX..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="step-content d-none" id="step-3">
                        <h5 class="fw-bold mb-4"><i data-lucide="file-text" class="me-2 text-primary"></i>Dokumen Pendukung</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Foto Produk Unggulan</label>
                                <div class="upload-box" onclick="document.getElementById('foto_produk').click()">
                                    <i data-lucide="image" class="text-muted mb-2"></i>
                                    <p class="small text-muted mb-0" id="produk_label">Klik untuk upload foto produk</p>
                                    <input type="file" name="foto_produk" id="foto_produk" class="d-none" onchange="updateFileName(this, 'produk_label')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto KTP Pemilik</label>
                                <div class="upload-box" onclick="document.getElementById('foto_ktp').click()">
                                    <i data-lucide="camera" class="text-muted mb-2"></i>
                                    <p class="small text-muted mb-0" id="ktp_label">Pastikan NIK terbaca jelas</p>
                                    <input type="file" name="foto_ktp" id="foto_ktp" class="d-none" onchange="updateFileName(this, 'ktp_label')">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-content d-none" id="step-4">
                        <h5 class="fw-bold mb-4"><i data-lucide="check-circle" class="me-2 text-success"></i>Konfirmasi & Kirim</h5>
                        <div class="alert alert-primary border-0 rounded-4 p-4">
                            <h6>Pernyataan Kebenaran Data</h6>
                            <p class="small text-muted mb-3">Dengan menekan tombol kirim, saya menyatakan bahwa data yang saya berikan adalah benar dan bersedia mengikuti aturan dinas terkait.</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agree" required>
                                <label class="form-check-label small fw-bold" for="agree">Saya Setuju dengan Syarat & Ketentuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                        <button type="button" class="btn btn-light rounded-pill px-4" id="prevBtn" onclick="nextPrev(-1)" style="display:none;">Sebelumnya</button>
                        <button type="button" style="background-color: #a82282; color: white" class="btn rounded-pill px-5 shadow" id="nextBtn"  onclick="nextPrev(1)">Lanjutkan &rarr;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    let currentStep = 1;
    const totalSteps = 4;

    function nextPrev(n) {
        // Validasi simpel sebelum lanjut
        if (n == 1 && !validateForm()) return false;

        // Sembunyikan step saat ini
        document.getElementById(`step-${currentStep}`).classList.add('d-none');
        
        // Update index step
        currentStep += n;

        // Jika sudah sampai akhir, submit form
        if (currentStep > totalSteps) {
            document.getElementById("registrationForm").submit();
            return false;
        }

        showStep(currentStep);
    }

    function showStep(n) {
        // Tampilkan step yang dituju
        document.getElementById(`step-${n}`).classList.remove('d-none');

        // Update Stepper Visual
        for (let i = 1; i <= totalSteps; i++) {
            let s = document.getElementById(`step-i-${i}`);
            if (i < n) s.className = "step completed";
            else if (i == n) s.className = "step active";
            else s.className = "step";
        }

        // Update Tombol
        document.getElementById("prevBtn").style.display = (n == 1) ? "none" : "inline";
        if (n == totalSteps) {
            document.getElementById("nextBtn").innerHTML = "Kirim Pendaftaran";
            document.getElementById("nextBtn").className = "btn btn-success rounded-pill px-5 shadow";
        } else {
            document.getElementById("nextBtn").innerHTML = "Lanjutkan &rarr;";
            document.getElementById("nextBtn").className = "btn btn-primary rounded-pill px-5 shadow";
        }
        
        lucide.createIcons(); // Refresh icons
    }

    function validateForm() {
        // Bisa ditambahkan logika validasi input di sini jika perlu
        return true; 
    }

    function updateFileName(input, labelId) {
        if (input.files && input.files.length > 0) {
            document.getElementById(labelId).innerText = input.files[0].name;
            document.getElementById(labelId).classList.add('text-primary', 'fw-bold');
        }
    }

    // Jalankan icons saat load pertama kali
    document.addEventListener("DOMContentLoaded", function() {
        lucide.createIcons();
    });
</script>    
