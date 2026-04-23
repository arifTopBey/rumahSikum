<div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
    <p class="fw-bold fs-5">Identitas Usaha </p>

    <div class="row ">
        <div class="col-md-4">
            <p class="text-muted">102. Provinsi*</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->provinsi }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">103. Kabupaten/Kota</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->kabupaten }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">104. Kecamatan</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->kecamatan }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">105. Desa/Kelurahan*</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->kelurahan }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">106. Nama Lengkap Usaha/Perusahaan*</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->nama_lengkap_usaha }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">107. Nama Usaha Komersial/Populer</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->nama_lengkap_usaha }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">108. Tempat Usaha</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">
                @if($data->tempat_usaha === 1)
                    <span>Bangunan Tempat Usaha</span>
                @elseif($data->tempat_usaha === 2)
                    <span>Bangunan Campuran</span>
                @elseif($data->tempat_usaha === 3)
                    <span>Kaki Lima</span>
                @elseif($data->tempat_usaha === 4)
                    <span>Keliling</span>
                @elseif($data->tempat_usaha === 5)
                    <span>Lainnya</span>
                @endif
            </p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">109. Alamat Lengkap Usaha/Perusahaan</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->alamat_lengkap }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">RT</p>
        </div>
         @php
            preg_match('/RT[^0-9]*([0-9]+)/i', $data->alamat_lengkap, $matches);
            $rt = $matches[1] ?? '-';
             preg_match('/RW[^0-9]*([0-9]+)/i', $data->alamat_lengkap, $rwMatch);
            $data->rw = $rwMatch[1] ?? null;
        @endphp
        <div class="col-md-8">
            <p class="fw-bold">{{ $rt }}</p>
        </div>
      
        <div class="col-md-4">
            <p class="text-muted">RW</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->rw }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">Kode Pos</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">-</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">Nomor Telepon (WhatsApp)</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">{{ $data->telpon }}</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">Nomor Telepon Ext</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">-</p>
        </div>
        <div class="col-md-4">
            <p class="text-muted">Email</p>
        </div>
        <div class="col-md-8">
            <p class="fw-bold">-</p>
        </div>
    </div>
</div>