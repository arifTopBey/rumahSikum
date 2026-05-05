@extends('admin.main.main')

@section('content')

<style>
    body {
        background-color: #f4f7fe;
    }

    .address-wrapper {
        margin-top: 120px;
        margin-bottom: 100px;
    }

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

    .nav-link-account:hover,
    .nav-link-account.active {
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
    .modal-content {
        border-radius: 30px;
        border: none;
        padding: 15px;
    }

    .form-control-custom {
        border-radius: 15px;
        padding: 12px 18px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    #drop-area {
        transition: 0.2s;
        cursor: pointer;
    }

    #drop-area:hover {
        background-color: #f8f9fa;
        border-color: #a82282 !important;
    }
</style>


<div class="container py-5">


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

        <div class="col-lg-11 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex">
                    <i class="bi bi-plus-square-fill me-3 fs-3 fw-bold"></i>
                    <h4 class="fw-bold m-0 mt-1">Kategori Produk</h4>
                </div>
                <button style="background-color: #a82282; color: white" class="btn rounded-pill px-4 fw-bold shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#modalAlamat">
                    <i data-lucide="plus" size="18" class="me-1"></i> Tambah Kategori Produk
                </button>
            </div>

            <div class="row g-3">

                <div class="col-lg-12" style="min-height: 100vh;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle border" style="min-height: 30vh;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 fw-semibold text-dark text-center" width="50">No</th>
                                    <th class="py-3 fw-semibold text-dark">Nama Kategori</th>
                                    <th class="py-3 fw-semibold text-dark">Icon</th>
                                    <th class="py-3 fw-semibold text-dark text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <div>
                                                <p class="fw-bold mb-0">{{ $category->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                 <img src="{{ route('show.icon.produk.private', $category->icon) }}" alt="" width="30" height="30">
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                                <i data-lucide="more-horizontal" size="18"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                                <!-- <li><a class="dropdown-item py-2" href=""><i data-lucide="edit-3" size="14" class="me-2"></i> Edit</a></li> -->
                                                 <a href="javascript:void(0)"
                                                        class="dropdown-item py-2 btn-edit"
                                                        data-id="{{ $category->id }}"
                                                        data-name="{{ $category->name }}"
                                                        data-icon="{{ route('show.icon.produk.private', $category->icon) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditKategori">
                                                            
                                                        <i data-lucide="edit-3" size="14" class="me-2"></i> Edit
                                                </a>
                                                <form id="delete-form-{{ $category->id }}" method="POST" action="{{ route('admin.kategori.produk.delete', $category->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="confirmDelete('{{ $category->id }}', '{{ $category->name }}')" type="button" class="btn btn-sm btn-light text-danger px-3">
                                                        <i data-lucide="trash-2" size="14" class="me-3"></i>Hapus
                                                    </button>

                                                </form>
                                                <!-- <li><hr class="dropdown-divider"></li> -->
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAlamat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 px-4">
                <h5 class="fw-bold text-muted m-0">Tambah Kategori Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="{{ route('admin.kategori.produk.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center">

                            <h6 class="fw-bold text-start mb-3">Icon Kategori Produk</h6>

                            <!-- Drop Area -->
                            <div class="border border-2 border-dashed rounded-4 p-4 position-relative cursor-pointer"
                                id="drop-area" onclick="document.getElementById('iconInput').click()">

                                <!-- Preview -->
                                <img id="preview-icon"
                                    src=""
                                    class="img-fluid rounded-3 mb-3"
                                    style="max-height:120px; object-fit:contain;" />

                                <!-- Default State -->
                                <div id="placeholder">
                                    <i data-lucide="image" size="48" class="text-muted mb-2 mx-auto"></i>
                                    <p class="small text-muted mb-0">Klik atau seret gambar ke sini</p>
                                </div>

                                <!-- Hidden Input -->
                                <input type="file"
                                    name="icon"
                                    id="iconInput"
                                    class="d-none"
                                    accept="image/*">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="fw-bold small mb-2">Nama Kategori</label>
                        <input name="name" type="text" class="form-control form-control-custom"
                            placeholder="Contoh: Elektronik, Baju Pria,...">
                    </div>
                    <div class="col-12 mt-4">
                        <button style="background-color: #a82282; color: white" type="submit"
                            class="btn w-100 py-3 rounded-pill fw-bold shadow">Simpan Kategori Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditKategori" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 px-4">
                <h5 class="fw-bold text-muted m-0">Edit Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4">
                <form id="formEditKategori" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- ICON -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-3">

                        <h6 class="fw-bold text-start mb-3">Icon Kategori</h6>

                        <div class="border border-2 border-dashed rounded-4 p-4 cursor-pointer"
                            onclick="document.getElementById('editIconInput').click()">

                            <!-- Preview -->
                            <img id="edit-preview-icon"
                                class="img-fluid rounded-3 mb-3"
                                style="max-height:120px; object-fit:contain;" />

                            <!-- Placeholder -->
                            <div id="edit-placeholder" class="d-none">
                                <i data-lucide="image" size="48" class="text-muted mb-2"></i>
                                <p class="small text-muted mb-0">Klik untuk ganti icon</p>
                            </div>

                            <input type="file"
                                name="icon"
                                id="editIconInput"
                                class="d-none"
                                accept="image/*">
                        </div>
                    </div>

                    <!-- NAME -->
                    <div class="mb-3">
                        <label class="fw-bold small mb-2">Nama Kategori</label>
                        <input type="text" name="name" id="edit-name"
                            class="form-control"
                            placeholder="Nama kategori">
                    </div>

                    <button class="btn w-100 py-3 rounded-pill fw-bold"
                        style="background:#a82282; color:white">
                        Update Kategori
                    </button>
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

<script>
    lucide.createIcons();

    const input = document.getElementById('iconInput');
    const preview = document.getElementById('preview-icon');
    const placeholder = document.getElementById('placeholder');

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            }

            reader.readAsDataURL(file);
        }
    });
</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const editButtons = document.querySelectorAll('.btn-edit');
    const form = document.getElementById('formEditKategori');
    const nameInput = document.getElementById('edit-name');
    const preview = document.getElementById('edit-preview-icon');
    const fileInput = document.getElementById('editIconInput');

    // Klik tombol edit
    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {

            const id = this.dataset.id;
            const name = this.dataset.name;
            const icon = this.dataset.icon;

            // set value
            nameInput.value = name;
            preview.src = icon;

            // set form action
            form.action = `/admin/kategori-produk/update/${id}`;
        });
    });

    // preview gambar baru
    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    });

});
</script>


@endsection