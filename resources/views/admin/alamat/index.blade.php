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

            <div class="col-lg-10 mx-auto">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex">
                        <i class="bi bi-truck me-3 fs-3 fw-bold"></i>
                        <h4 class="fw-bold m-0">Alamat Pengiriman</h4>
                    </div>
                    <button style="background-color: #a82282; color: white" class="btn rounded-pill px-4 fw-bold shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#modalAlamat">
                        <i data-lucide="plus" size="18" class="me-1"></i> Tambah Alamat
                    </button>
                </div>

                <div class="row g-3">

                    @foreach ($addresses as $addres)
                        <div class="col-12">
                            <div class="address-card is-main shadow-sm">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <span class="fw-800 fs-5 d-block">{{ $addres->label_name }}</span>
                                        <span class="badge-main mt-2 d-inline-block">Utama</span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                            <i data-lucide="more-horizontal" size="18"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                            <li><a class="dropdown-item rounded-3" href="#">Jadikan Utama</a></li>
                                            <!-- <li><a class="dropdown-item rounded-3" href="#"><i data-lucide="edit" size="14"
                                                        class="me-2"></i> Ubah Alamat</a></li> -->
                                            <li>
                                                    <button 
                                                        class="dropdown-item rounded-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditAlamat"
                                                        onclick="setEditData({{ json_encode($addres) }})">
                                                        <i data-lucide="edit" size="14" class="me-2"></i> Ubah Alamat
                                                    </button>
                                            </li>
                                            <!-- <li><a class="dropdown-item rounded-3 text-danger" href="{{ route('user.address.delete', $addres->id) }}"><i data-lucide="trash-2" size="14" class="me-2"></i> Hapus</a></li> -->
                                            <li>
                                                <form id="delete-form-{{ $addres->id }}"
                                                    action="{{ route('user.address.delete', $addres->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="confirmDelete('{{ $addres->id }}', '{{ $addres->label_name }}')"
                                                        type="button" class="btn dropdown-item btn-sm btn-light text-danger px-3">
                                                        <i data-lucide="trash-2" size="14" class="me-3"></i>Hapus
                                                    </button>

                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    <p class="fw-bold text-dark mb-1">{{ $addres->name }} ({{ $addres->phone }}) Email:
                                        {{ $addres->email }}</p>
                                    <p class="small mb-0">{{ $addres->address }}</p>
                                    <p class="small mb-0">Kecamatan : {{ $addres->kecamatan }} Kode Pos : {{ $addres->zip }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

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
                    <form action="{{ route('user.address.store') }}" class="row g-3" method="post">
                        @csrf
                        <div class="col-md-6">
                            <label class="fw-bold small mb-2">Label Alamat</label>
                            <input  name="label_name" type="text" class="form-control form-control-custom"
                                placeholder="Contoh: Rumah, Kantor, Kos">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small mb-2">Nama Penerima</label>
                            <input  name="name" type="text" class="form-control form-control-custom"
                                placeholder="Nama Lengkap">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small mb-2">Nomor WhatsApp</label>
                            <input  name="phone" type="number" class="form-control form-control-custom"
                                placeholder="0812xxxx">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small mb-2">Email</label>
                            <input  name="email" type="email" class="form-control form-control-custom"
                                placeholder="contoh@gmail.com">
                        </div>
                        <div class="col-md-12">
                            <label class="fw-bold small mb-2">Alamat Lengkap</label>
                            <textarea  name="address" class="form-control form-control-custom" rows="3"
                                placeholder="Nama jalan, nomor rumah, RT/RW"></textarea>
                        </div>
                        <!-- <div class="col-md-6">
                            <label class="fw-bold small mb-2">Kecamatan</label>
                            <select class="form-select form-control-custom">
                                <option>Tigaraksa</option>
                                <option>Kelapa Dua</option>
                                <option>Cikupa</option>
                            </select>
                        </div> -->
                        <div class="col-md-6">
                            <label class="fw-bold small mb-2">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control form-control-custom"
                                placeholder="Kecamatan">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small mb-2">Kode Pos</label>
                            <input  name="zip" type="text" class="form-control form-control-custom">
                        </div>
                        <div class="col-12 mt-4">
                            <button style="background-color: #a82282; color: white" type="submit"
                                class="btn w-100 py-3 rounded-pill fw-bold shadow">Simpan Alamat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditAlamat" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header border-0 px-4">
                    <h5 class="fw-800 m-0">Edit Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body px-4">
                    <form id="formEditAlamat" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="edit_id">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold small mb-2">Label</label>
                                <input id="edit_label_name" name="label_name" type="text" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold small mb-2">Nama</label>
                                <input id="edit_name" name="name" type="text" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold small mb-2">Phone</label>
                                <input id="edit_phone" name="phone" type="text" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold small mb-2">Email</label>
                                <input id="edit_email" name="email" type="email" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-12">
                                <label class="fw-bold small mb-2">Alamat</label>
                                <textarea id="edit_address" name="address" class="form-control form-control-custom"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold small mb-2">Kecamatan</label>
                                <input id="edit_kecamatan" name="kecamatan" type="text" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold small mb-2">Kode Pos</label>
                                <input id="edit_zip" name="zip" type="text" class="form-control form-control-custom">
                            </div>

                            <div class="col-12 mt-4">
                                <button style="background-color: #a82282; color: white"
                                    class="btn w-100 py-3 rounded-pill fw-bold">
                                    Update Alamat
                                </button>
                            </div>
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

<script>
    function setEditData(data) {
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_label_name').value = data.label_name;
        document.getElementById('edit_name').value = data.name;
        document.getElementById('edit_phone').value = data.phone;
        document.getElementById('edit_email').value = data.email;
        document.getElementById('edit_address').value = data.address;
        document.getElementById('edit_kecamatan').value = data.kecamatan;
        document.getElementById('edit_zip').value = data.zip;

        // set action form dinamis
        document.getElementById('formEditAlamat').action = `/user/alamat/update/${data.id}`;
    }
</script>
@endsection