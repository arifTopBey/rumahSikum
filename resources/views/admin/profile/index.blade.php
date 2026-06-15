@extends('admin.main.main')

@section('content')

<style>
    body {
        background-color: #f4f7fe;
    }

    .account-wrapper {
        margin-top: 120px;
        margin-bottom: 100px;
    }

    /* Sidebar Menu */
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

    .nav-link-account:hover,
    .nav-link-account.active {
        background: rgba(67, 97, 238, 0.08);
        color: #4361ee;
    }

    /* Content Card */
    .profile-card {
        background: white;
        border-radius: 25px;
        padding: 40px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
    }

    .avatar-upload {
        position: relative;
        width: 120px;
        margin-bottom: 30px;
    }

    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 30px;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-edit-avatar {
        position: absolute;
        bottom: -5px;
        right: -5px;
        background: #4361ee;
        color: white;
        border-radius: 10px;
        padding: 5px;
        border: 2px solid white;
    }

    .form-label-custom {
        font-weight: 700;
        font-size: 0.9rem;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .form-control-custom {
        border-radius: 15px;
        padding: 12px 18px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .form-control-custom:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        background: white;
    }
</style>

<div class="container">
     @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif -->

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>

        @endif

    <div class="row g-4">
        <div class="col-lg-12 px-3 ">
            <div class="profile-card">
                <h4 class="fw-800 mb-4">Pengaturan Profil  test </h4>

                <form action="{{ route('user.profile.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="avatar-upload">

                        @if (auth()->user()->image_profile != null)
                        <img src="{{ route('showFoto.fotoProfile.private', auth()->user()->image_profile) }}"
                            class="avatar-preview" id="preview">
                        @else
                        <img src="{{ asset('image/icon.png') }}"
                            class="avatar-preview" id="preview">
                        @endif

                        <!-- tombol -->
                        <button type="button" id="btn-upload" class="btn-edit-avatar shadow-sm">
                            <i data-lucide="camera" size="16"></i>
                        </button>

                        <!-- input hidden -->
                        <input type="file" id="input-avatar" name="image_profile" accept="image/*" class="d-none">
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control form-control-custom" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Email</label>
                            <input type="email" name="email" class="form-control form-control-custom" value="{{ auth()->user()->email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Nomor WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light rounded-start-3">62</span>
                                <input type="number" name="phone" class="form-control form-control-custom rounded-start-0" value="{{ auth()->user()->phone }}" placeholder="-">
                                <!-- <input type="number" class="form-control form-control-custom rounded-start-0" value="8123456789"> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- <label class="form-label-custom">Tanggal Lahir</label> -->
                            <label class="form-label-custom">Status</label>
                            <input type="text" class="form-control form-control-custom" value="{{ auth()->user()->status }}" readonly>
                        </div>
                        <div class="col-12 mt-5">
                            <hr class="opacity-50">
                            <h5 class="fw-bold mb-4">Keamanan Akun</h5>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Password Baru (Kosongkan jika tidak ganti)</label>
                            <input type="password" name="password" class="form-control form-control-custom" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Konfirmasi Password Baru</label>
                            <input type="password" name="password" class="form-control form-control-custom" placeholder="">
                        </div>
                    </div>

                    <div class="mt-5 d-flex gap-2">
                        <button type="submit" style="background-color: #a82282; color: white" class="btn rounded-pill px-5 py-2 fw-bold shadow">Simpan Perubahan</button>
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
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('input-avatar');
    const preview = document.getElementById('preview');
    const button = document.getElementById('btn-upload');

    // klik icon kamera → buka file
    button.addEventListener('click', function () {
        input.click();
    });

    // preview gambar
    input.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {

            // validasi ukuran (optional 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 2MB');
                input.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    });
});
</script>

@endsection