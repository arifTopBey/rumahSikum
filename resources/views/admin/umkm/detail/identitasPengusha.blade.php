<div class="col-md-10 mx-auto rounded-2 shadow-lg mt-2 px-2 py-2 border mb-3">
                        <p class="fw-bold fs-5">Identittas Pengusaha </p>
    
                        <div class="row ">
                            <div class="col-md-4">
                                <p class="text-muted">301. Nama Pengusaha*</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->id_badan_usaha }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">302.A Jenis Kelamin</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->usahaKarakteristik->produk_utama ?? '-' }}</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">302.B Disabilitas </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">303. Tanggal Lahir </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">304. Status Pengusaha* </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">305. NIK Pengusaha* </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
                            </div>
                            <div class="col-md-4" >
                                <p class="text-muted">306. NPWP Pengusaha* </p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">{{ $data->usahaKarakteristik->kegiatan_utama ?? '-' }}</p>
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
                                <p class="fw-bold">Banten</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Kabupaten/Kota</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Rp {{ number_format((float)($data->laporanKeuangan->omzet_usaha ?? 0), 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Kecamatan</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Rp {{ number_format((float)($data->laporanKeuangan->omzet_usaha ?? 0), 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Desa/Kelurahan</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Rp {{ number_format((float)($data->laporanKeuangan->omzet_usaha ?? 0), 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Jalan/Kawasan Nomor</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Rp {{ number_format((float)($data->laporanKeuangan->omzet_usaha ?? 0), 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">RT</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Rp {{ number_format((float)($data->laporanKeuangan->omzet_usaha ?? 0), 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">RW</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Rp {{ number_format((float)($data->laporanKeuangan->omzet_usaha ?? 0), 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Kode Pos</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold">Rp {{ number_format((float)($data->laporanKeuangan->omzet_usaha ?? 0), 0, ',', '.') }}</p>
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
                                <p class="fw-bold badge rounded-pill text-bg-secondary">{{ $data->{'401c'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">309. Telpon/HP</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold badge rounded-pill text-bg-secondary">{{ $data->{'401b'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Whatsapp Aktif</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold badge rounded-pill text-bg-secondary"> {{ $data->{'401j'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">310. Tingkat Pendidikan Pengusaha*</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold badge rounded-pill text-bg-secondary">{{ $data->{'401j'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">311. Apakah Menjadi Anggota Koperasi*
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold badge rounded-pill text-bg-secondary">{{ $data->{'401j'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">312. Selain usaha yang dijalankan saat ini, apakah memiliki pekerjaan lain*</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fw-bold badge rounded-pill text-bg-secondary">{{ $data->{'401j'} === 2 ? 'Tidak Ada' : 'Ada' }}</p>
                            </div>
    
                        </div>
                    </div>