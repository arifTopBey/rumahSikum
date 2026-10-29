@extends('admin.main.main')

@section('content')
    <div class="container-fluid px-5 bg-white">
        <div class="row py-5">
            <div
                class="col-md-12 mx-auto border-primary bg-primary bg-opacity-10 rounded-2 py-3 mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="fw-bold fs-5 text-primary mb-0">Kelola Kategori E-Learning</p>
                    <p class="text-muted mb-0">Tambahkan atau ubah kategori E-learning beserta gambar icon-nya di sini.</p>
                </div>
                <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#modalTambahKategori">
                    <i data-lucide="plus-circle" size="18" class="me-1"></i> Tambah Kategori E-learning
                </button>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover align-middle border">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 fw-semibold text-dark text-center" width="70">No</th>
                                <th class="py-3 fw-semibold text-dark text-center" width="90">Icon</th>
                                <th class="py-3 fw-semibold text-dark">Nama Kategori E-Learning</th>
                                <th class="py-3 fw-semibold text-dark">Slug (URL)</th>
                                <th class="py-3 fw-semibold text-dark text-center">Total E-Learning</th>
                                <th class="py-3 fw-semibold text-dark text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <div class="p-1 bg-light border rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                            @if($category->icon)
                                                <img src="{{ route('show.thumbnail.produk.private', $category->icon) }}" alt="{{ $category->name }}" class="img-fluid rounded-2" style="max-height: 36px; max-width: 36px; object-fit: contain;">
                                            @else
                                                <i data-lucide="image" class="text-muted" size="20"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="fw-bold">{{ $category->name }}</td>
                                    <td><code class="text-primary small">{{ $category->slug }}</code></td>
                                    <td class="text-center">
                                        <span class="badge bg-info-subtle text-info px-3">{{ $category->elearning_count ?? 0 }} Materi</span>
                                    </td>
                                    <td class="text-center">
                                        <!-- PERBAIKAN: data-icon dikirim berupa string path murni ($category->icon) -->
                                        <button class="btn btn-sm btn-light border rounded-pill px-3 me-1 btn-edit"
                                            data-id="{{ $category->id }}" 
                                            data-name="{{ $category->name }}"
                                            data-slug="{{ $category->slug }}"
                                            data-icon="{{ $category->icon ?? '' }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalTambahKategori">
                                            <i data-lucide="edit-2" size="14"></i>
                                        </button>

                                        <form id="delete-form-{{ $category->id }}" action="{{ route('admin.kategori.elearning.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirmDelete('{{ $category->id }}', '{{ $category->name }}')" type="button" class="btn btn-sm btn-light text-danger border rounded-pill px-3">
                                                <i data-lucide="trash-2" size="14"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH / EDIT KATEGORI -->
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0" id="modalTambahKategoriLabel">Buat Kategori E-Learning Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formKategori" action="{{ route('admin.kategori.elearning.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">
                    <input type="hidden" name="id" id="cat_id">

                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Kategori E-Learning</label>
                            <input type="text" id="cat_name" name="name" class="form-control rounded-3"
                                placeholder="Contoh: Digital Marketing" required autofocus>
                        </div>

                        <!-- INPUT UPLOAD FILE GAMBAR ICON & LIVE PREVIEW -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Icon Gambar Kategori</label>
                            <div class="d-flex align-items-center gap-3">
                                <!-- Box Preview Gambar -->
                                <div id="previewBox" class="border rounded-3 d-flex align-items-center justify-content-center bg-light" style="width: 60px; height: 60px; flex-shrink: 0; overflow: hidden;">
                                    <i id="defaultPreviewIcon" data-lucide="image" class="text-muted" size="24"></i>
                                    <img id="imgPreview" src="" alt="Preview Icon" class="img-fluid d-none" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                
                                <div class="w-100">
                                    <input type="file" id="cat_icon" name="icon" class="form-control rounded-3" accept="image/png, image/jpeg, image/jpg, image/svg+xml, image/webp">
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.75rem;">
                                        Format: PNG, JPG, atau SVG (Maks. 2MB). Recommended: 128x128px.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label small fw-bold text-muted">Slug URL (Otomatis)</label>
                            <input type="text" id="cat_slug" name="slug" class="form-control rounded-3 bg-light"
                                placeholder="digital-marketing" readonly>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Kategori E-Learning</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const catName = document.getElementById("cat_name");
    const catSlug = document.getElementById("cat_slug");
    const catIconInput = document.getElementById("cat_icon");
    const catId = document.getElementById("cat_id");
    const form = document.getElementById("formKategori");
    const methodField = document.getElementById("methodField");
    const modalTitle = document.getElementById("modalTambahKategoriLabel");

    const imgPreview = document.getElementById("imgPreview");
    const defaultPreviewIcon = document.getElementById("defaultPreviewIcon");

    // Base URL Route Private
    const basePrivateRoute = "{{ route('show.thumbnail.produk.private', ':id') }}";

    function generateSlug(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    // Auto slug
    catName.addEventListener("input", function () {
        catSlug.value = generateSlug(this.value);
    });

    // Live Preview saat memilih file gambar baru dari local
    catIconInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imgPreview.src = e.target.result;
                imgPreview.classList.remove("d-none");
                defaultPreviewIcon.classList.add("d-none");
            };
            reader.readAsDataURL(file);
        }
    });

    // Klik tombol Edit
    document.querySelectorAll(".btn-edit").forEach(btn => {

        btn.addEventListener("click", function(){

            const id = this.dataset.id;
            const name = this.dataset.name;
            const slug = this.dataset.slug;
            const iconPath = this.dataset.icon; // Hanya berupa path file mentah (e.g. "kategori/abc.png")

            catId.value = id;
            catName.value = name;
            catSlug.value = slug;
            catIconInput.value = "";

            // Tampilkan preview gambar yang sudah ada
            if (iconPath && iconPath.trim() !== '') {
                // Gunakan encodeURIComponent agar slash '/' tidak memecah parameter route
                const imageUrl = basePrivateRoute.replace(':id', encodeURIComponent(iconPath));

                imgPreview.src = imageUrl;
                imgPreview.classList.remove("d-none");
                defaultPreviewIcon.classList.add("d-none");
            } else {
                imgPreview.src = "";
                imgPreview.classList.add("d-none");
                defaultPreviewIcon.classList.remove("d-none");
            }

            form.action = `/admin/kategori-elearning/${id}`;
            methodField.value = "PUT";

            modalTitle.innerText = "Edit Kategori E-Learning";

        });

    });

    // Reset modal saat ditutup
    const modal = document.getElementById('modalTambahKategori');

    modal.addEventListener('hidden.bs.modal', function () {

        form.action = "{{ route('admin.kategori.elearning.store') }}";
        methodField.value = "POST";

        form.reset();
        imgPreview.src = "";
        imgPreview.classList.add("d-none");
        defaultPreviewIcon.classList.remove("d-none");

        modalTitle.innerText = "Buat Kategori E-Learning Baru";
    });

});
</script>
@endsection