<div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
    <p class="fw-bold fs-5">Identitas Usaha </p>

    <div class="row ">
        <div class="col-md-4">
            <p class="text-muted">201. Kegiatan Utama Usaha/Perusahaan*</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->id_badan_usaha }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">202. Produk Utama (Barang atau Jasa) yang dihasilkan / Dijual</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->produk_utama ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">Kategori KBLI</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">Kode KBLI</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">203. Status Badan Usaha*</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">204. Nomor Induk Usaha</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">205. Modal Usaha Saat Pendirian</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">206. NPWP Usaha</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">207. Mulai Beroperasi</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
        </div>
    </div>
</div>