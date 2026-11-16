@extends('admin.main.main')

@section('content')
<div class="">
    <div class="container mt-4">
        <h4 class="mb-4">Data Koperasi Merah Putih</h4>
        <div class="card card-filter p-3 mb-4">
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Wilayah Keanggotaan</label>
                    <select class="form-select">
                        <option>Semua Wilayah Keanggotaan</option>
                        <option>Tangerang</option>
                        <option>Jakarta</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status Sertifikat</label>
                    <select class="form-select">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Expired</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-5">
                    <label class="form-label">Sertifikat</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Masukkan NIK, Nama Koperasi atau Nomor Badan Hukum">
                        <button class="btn btn-primary">Cari Koperasi</button>
                    </div>
                    <small class="text-muted">* Klik NIK untuk melihat Sertifikat</small>
                </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead  class="text-center text-white">
                        <tr  class="bg-primary">
                            <th style="background-color: #00997a; color: white;">No</th>
                            <th style="background-color: #00997a; color: white;">NIK</th>
                            <th style="background-color: #00997a; color: white;">Nomor Badan Hukum</th>
                            <th style="background-color: #00997a; color: white;">Tanggal Badan Hukum</th>
                            <th style="background-color: #00997a; color: white;">Nama Koperasi</th>
                            <th style="background-color: #00997a; color: white;">Desa/Kelurahan</th>
                            <th style="background-color: #00997a; color: white;">Kecamatan</th>
                            <th style="background-color: #00997a; color: white;">Kabupaten</th>
                            <th style="background-color: #00997a; color: white;">Provinsi</th>
                            <th style="background-color: #00997a; color: white;">Alamat</th>
                            <th style="background-color: #00997a; color: white;">Jenis Koperasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td><a href="#" class="text-decoration-none">3603001001003</a></td>
                            <td>154/BH/KWK.10/1998</td>
                            <td>1998-01-12</td>
                            <td>KOPERASI KONSUMEN KARYAWAN PEMI PASI</td>
                            <td class="text-center">Cangkudu</td>
                            <td>BALARAJA</td>
                            <td>KAB.TANGERANG</td>
                            <td>BANTEN</td>
                            <td class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, illum.</td>
                            <td class="text-center">
                                <span class="">Desa</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
                 </div>
        </div>
    </div>
</div>
@endsection
