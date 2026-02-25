@extends('admin.main.main')

@section('content')
<div class="">
    <div class="container mt-4">
        <h4 class="mb-4">Data Sertifikat Koperasi</h4>
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
                    <thead style="background: " class="text-center text-white">
                        <tr style="" class="bg-primary">
                            <th style="background-color: #00997a; color: white;">No</th>
                            <th style="background-color: #00997a; color: white;">NIK</th>
                            <th style="background-color: #00997a; color: white;">Nomor Badan Hukum</th>
                            <th style="background-color: #00997a; color: white;">Tanggal Badan Hukum</th>
                            <th style="background-color: #00997a; color: white;">Nama Koperasi</th>
                            <th style="background-color: #00997a; color: white;">Grade</th>
                            <th style="background-color: #00997a; color: white;">Tanggal Diterbitkan</th>
                            <th style="background-color: #00997a; color: white;">Tanggal Cetak</th>
                            <th style="background-color: #00997a; color: white;">Tanggal Expired</th>
                            <th style="background-color: #00997a; color: white;">Edisi Cetak</th>
                            <th style="background-color: #00997a; color: white;">Status Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td><a href="#" class="text-decoration-none">3603001001003</a></td>
                            <td>154/BH/KWK.10/1998</td>
                            <td>1998-01-12</td>
                            <td>KOPERASI KONSUMEN KARYAWAN PEMI PASI</td>
                            <td class="text-center">B</td>
                            <td>2016-04-28</td>
                            <td>2026-01-12</td>
                            <td>2028-01-12</td>
                            <td class="text-center">6</td>
                            <td class="text-center">
                                <span class="badge bg-success">Aktif</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center">2</td>
                            <td><a href="#" class="text-decoration-none">3603001001006</a></td>
                            <td>6103/BH/PAD/KDK.10.4/X/1998</td>
                            <td>1998-10-01</td>
                            <td>KOPERASI GURU-GURU BALARAJA UTARA KPRI REMAJA</td>
                            <td class="text-center">C2</td>
                            <td>2019-09-03</td>
                            <td>2025-10-01</td>
                            <td>2027-10-01</td>
                            <td class="text-center">4</td>
                            <td class="text-center">
                                <span class="badge bg-success">Aktif</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center">3</td>
                            <td><a href="#" class="text-decoration-none">3603001001009</a></td>
                            <td>219/BH/KDK.10.4/IV/1999</td>
                            <td>1999-05-25</td>
                            <td>KOPERASI KONSUMEN SERBA USAHA AL-HUSNA TANGERANG</td>
                            <td class="text-center">C2</td>
                            <td>2016-10-20</td>
                            <td>2024-05-26</td>
                            <td>2026-05-25</td>
                            <td class="text-center">4</td>
                            <td class="text-center">
                                <span class="badge bg-success">Aktif</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center">4</td>
                            <td><a href="#" class="text-decoration-none">3603001001042</a></td>
                            <td>9587/BH/KWK.10/4</td>
                            <td>1991-09-17</td>
                            <td>KOPERASI KONSUMEN KARYAWAN FT ADIS DIMENSION FOOTWEAR</td>
                            <td class="text-center">B</td>
                            <td>2017-10-30</td>
                            <td>2024-07-08</td>
                            <td>2026-07-07</td>
                            <td class="text-center">5</td>
                            <td class="text-center">
                                <span class="badge bg-success">Aktif</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                 </div>
            </div>
    </div>
</div>
@endsection
