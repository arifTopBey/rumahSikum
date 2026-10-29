@extends('admin.main.main')

@section('content')
    <div class="container-fluid px-5 bg-white">
        <div class="row py-5">
            <div style="background-color: rgba(168, 34, 130, 0.5);"
                class="col-md-12 mx-auto border-primary  rounded-2 py-3 mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="fw-bold fs-5 text-white mb-0">Kelola Kategori Pelatihan</p>
                    <p class="text-muted mb-0">Tambahkan atau ubah kategori pealtihan dengan cepat di sini.</p>
                </div>
                <button style="background-color: #a82282; color: white" class="btn rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#modalTambahKategori">
                    <i data-lucide="plus-circle" size="18" class="me-1"></i> Tambah Kategori Pelatihan
                </button>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover align-middle border">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 fw-semibold text-dark text-center" width="70">No</th>
                                <th class="py-3 fw-semibold text-dark">Nama Kategori</th>
                                <th class="py-3 fw-semibold text-dark">Slug (URL)</th>
                                <th class="py-3 fw-semibold text-dark text-center">Total Pelatihan</th>
                                <th class="py-3 fw-semibold text-dark text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="fw-bold">{{ $category->name }}</td>
                                    <td><code class="text-primary small">{{ $category->slug }}</code></td>
                                    <td class="text-center"><span class="badge bg-info-subtle text-info px-3">12 Artikel</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-light border rounded-pill px-3 me-1 btn-edit"
                                            data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                            data-slug="{{ $category->slug }}" data-bs-toggle="modal"
                                            data-bs-target="#modalTambahKategori">
                                            <i data-lucide="edit-2" size="14"></i>
                                    
                                    <form id="delete-form-{{ $category->id }}" action="{{ route('admin.kategori.berita.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirmDelete('{{ $category->id }}', '{{ $category->name }}')" type="button" class="btn btn-sm btn-light text-danger border rounded-pill px-3">
                                            <i data-lucide="trash-2" size="14"></i>
                                        </button>

                                    </form>
                                        <!-- </button> <button class="btn btn-sm btn-light text-danger border rounded-pill px-3"><i
                                                data-lucide="trash-2" size="14"></i></button> -->
                                    </td>
                                </tr>
                            @endforeach
                            {{-- Contoh Data Statis --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 style="color: #a82282;" class="fw-bold mb-0" id="modalTambahKategoriLabel">Buat Kategori Pelatihan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formKategori" action="{{ route('admin.kategori.pelatihan.store') }}" method="POST">
                    @csrf
                     <!-- <input type="hidden" name="_method" id="methodField" value="POST">
                    <input type="hidden" name="id" id="cat_id"> -->

                     <input type="hidden" name="_method" id="methodField" value="POST">
                    <input type="hidden" name="id" id="cat_id">
                    
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Kategori</label>
                            <input type="text" id="cat_name" name="name" class="form-control rounded-3"
                                placeholder="Contoh: Info Ekonomi" required autofocus>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold text-muted">Slug URL (Otomatis)</label>
                            <input type="text" id="cat_slug" name="slug" class="form-control rounded-3 bg-light"
                                placeholder="info-ekonomi" readonly>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold"
                            data-bs-dismiss="modal">Batal</button>
                        <button style="background-color: #a82282; color: white" type="submit" class="btn rounded-pill px-4 fw-bold">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const catName = document.getElementById("cat_name");
    const catSlug = document.getElementById("cat_slug");
    const catId = document.getElementById("cat_id");
    const form = document.getElementById("formKategori");
    const methodField = document.getElementById("methodField");
    const modalTitle = document.getElementById("modalTambahKategoriLabel");

    function generateSlug(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    // auto slug
    catName.addEventListener("input", function () {
        catSlug.value = generateSlug(this.value);
    });

    // klik tombol edit
    document.querySelectorAll(".btn-edit").forEach(btn => {

        btn.addEventListener("click", function(){

            const id = this.dataset.id;
            const name = this.dataset.name;
            const slug = this.dataset.slug;

            catId.value = id;
            catName.value = name;
            catSlug.value = slug;
            form.action = `/admin/kategori-pelatihan/${id}`;
            methodField.value = "PUT";

            modalTitle.innerText = "Edit Kategori";

        });

    });

    // reset modal saat ditutup
    const modal = document.getElementById('modalTambahKategori');

    modal.addEventListener('hidden.bs.modal', function () {

        form.action = "{{ route('admin.kategori.berita.store') }}";
        methodField.value = "POST";

        form.reset();

        modalTitle.innerText = "Buat Kategori Baru";
    });

});
</script>
@endsection