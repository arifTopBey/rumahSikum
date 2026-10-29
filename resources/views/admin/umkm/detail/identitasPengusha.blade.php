<div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                        <p class="fw-bold fs-5">Identitas Pengusaha </p>
    
                        <div class="row ">
                            <div class="col-md-4">
                                <p class="text-muted">301. Nama Pengusaha*</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->identitasPengusaha->nama_pengusaha }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">302.A Jenis Kelamin</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Laki-laki</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">302.B Disabilitas </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Tidak</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">303. Tanggal Lahir </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">15 Maret 1985</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">304. Status Pengusaha* </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">
                                   {{ $data->identitasPengusaha->status_pengusaha === 1 ? 'Pemilik' : 'Pemilik dan Penanggung Jawab' }}
                                </p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">305. NIK Pengusaha* </p>
                            </div>
                            @php
                                $nik = $data->identitasPengusaha->nik_pengusaha;
                                $masked = substr($nik, 0, 4) . str_repeat('*', strlen($nik) - 4);
                            @endphp
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $masked }}</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">306. NPWP Pengusaha* </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->npwp_usaha }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                        <p class="fw-bold fs-5">Alamat Pengusaha</p>
    
                        <div class="row ">
                            <div class="col-md-4">
                                <p class="text-muted">308. Provisi</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->provinsi }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Kabupaten/Kota</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->kabupaten }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Kecamatan</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->kecamatan }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Desa/Kelurahan</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->kelurahan }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Jalan/Kawasan Nomor</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->alamat_lengkap }}</p>
                            </div>
                              @php
                                    preg_match('/RT[^0-9]*([0-9]+)/i', $data->alamat_lengkap, $matches);
                                    $rt = $matches[1] ?? '-';
                                    preg_match('/RW[^0-9]*([0-9]+)/i', $data->alamat_lengkap, $rwMatch);
                                    $data->rw = $rwMatch[1] ?? null;
                             @endphp
                            <div class="col-md-4">
                                <p class="text-muted">RT</p>
                            </div>
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
    
                        </div>
                    </div>
                    <div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                        <p class="fw-bold fs-5">Informasi Lainnya</p>
    
                        <div class="row ">
                            <div class="col-md-4">
                                <p class="text-muted">Email</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">-</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">309. Telpon/HP</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold ">{{ $data->telpon }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Whatsapp Aktif</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold ">{{ $data->telpon }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">310. Tingkat Pendidikan Pengusaha*</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold"></p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">311. Apakah Menjadi Anggota Koperasi*
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Tidak</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">312. Selain usaha yang dijalankan saat ini, apakah memiliki pekerjaan lain*</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Tidak</p>
                            </div>
    
                        </div>
                    </div>