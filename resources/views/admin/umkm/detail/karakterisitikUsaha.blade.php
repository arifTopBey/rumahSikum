<div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
    <p class="fw-bold fs-5">Karakteristik Usaha </p>

    <div class="row ">
        <div class="col-md-4">
            <p class="text-muted">201. Kegiatan Utama Usaha/Perusahaan*</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">202. Produk Utama (Barang atau Jasa) yang dihasilkan / Dijual</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->produk_utama }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">Kategori KBLI</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kategori_kbli }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">Kode KBLI</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->kode_kbli }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">203. Status Badan Usaha*</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">
                @if($data->usahaKarakteristik->status_badan_usaha === 1)
                    <span>PT</span>
                
                @elseif($data->usahaKarakteristik->status_badan_usaha === 2)
                    <span>Yayasan</span>
                
                @elseif($data->usahaKarakteristik->status_badan_usaha === 3)
                    <span>CV</span>
                
                @elseif($data->usahaKarakteristik->status_badan_usaha === 4)
                    <span>FIrma</span>
                
                @elseif($data->usahaKarakteristik->status_badan_usaha === 5)
                    <span>NV</span>
                
                @elseif($data->usahaKarakteristik->status_badan_usaha === 6)
                    <span>Dana Pensiun</span>
                
                @elseif($data->usahaKarakteristik->status_badan_usaha === 7)
                    <span>Perorangan</span>
                
                @elseif($data->usahaKarakteristik->status_badan_usaha === 8)
                    <span>Lainnya</span>
                @else
                    <span>Tidak Tersedia</span>
                @endif

               
            </p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">204. Nomor Induk Usaha</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->status_badan_usaha }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">205. Modal Usaha Saat Pendirian</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">-</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">206. NPWP Usaha</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->usahaKarakteristik->npwp_usaha?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">207. Mulai Beroperasi</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold"> {{ \Carbon\Carbon::parse($data->usahaKarakteristik->bulan_mulai_operasi)->translatedFormat('F') }} {{ \Carbon\Carbon::parse($data->usahaKarakteristik->tahun_mulai_operasi)->translatedFormat('Y') }}</p>
        </div>
    </div>
</div>