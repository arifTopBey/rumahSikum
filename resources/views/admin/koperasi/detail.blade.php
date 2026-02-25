@extends('admin.main.main')

@section('content')

<div class="container mt-4">

    <a href="{{ route('admin.koperasi') }}" class="btn btn-primary text-white">Kembali</a>

    <div class="d-flex px-2">
        <img width="40" height="40" src="{{ asset('image/Koperasi.png') }}" alt="" class="my-auto me-2">
        <h5 class="my-5">KOPERASI</h5>
    </div>
        <style>
            .data-container .row:nth-child(even) {
                background-color: #dadddd;
            }
        </style>
    <div  class="card-detail px-3">
        <div style="background: #00997a" class="row  text-white py-2">
            <div class="col-md-4">
                <span>NIK</span>
            </div>
            <div class="col-md-8">
                <span>102010020010</span>
            </div>
        </div>
        <div class="data-container">

            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Koperasi</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Nomor Badan Hukum Pendirian</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Tanggal Badan Hukum Pendirian</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Nomor Perubahan Anggaran Dasar (Terbaru)  </p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Tanggal Perubahan Anggaran Dasar (Terbaru)</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Tanggal Rat Terakhir</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>NPWP</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>.......</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Alamat</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, animi!</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Desa / Kelurahan</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Kecamatan</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Kabupaten</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Provinsi</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Bentuk Koperasi</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Jenis Koperasi</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Sektor Usaha</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Kelompok Koperasi</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Pola Pengelolaan</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Grade</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Kuk</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Kesehatan Koperasi</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-4 label-title">
                    <p>Status</p>
                </div>
                <div class="col-md-8 value-text">
                    <p>Koperasi Merah Putih Jaya</p>
                </div>
            </div>
        </div>

    </div>

    <div class="container mt-5">
        <h5>Perubahan Anggaran Dasar</h5>
        @include('admin.partial.perubahan_anggaran_dasar')
    </div>

    {{-- koperasi --}}
    <div class="container mt-5">

        <h5>Sertifikat</h5>

        @include('admin.partial.sertifikat')
    </div>
    {{-- batas koperasi --}}

    <div class="container mt-5">
        <h5>SEKTOR USAHA UTAMA</h5>
        @include('admin.partial.sektor_usaha_pertama')
    </div>

    <div class="container mt-5">
        <h5 class="mb-3">SEKTOR USAHA TAMBAHAN</h5>
        @include('admin.partial.sektor_usaha_tambahan')
    </div>
    <div class="container mt-5">
        <h5 class="mb-3">PENGAWASAN - PENGURUSAN</h5>
        @include('admin.partial.pengurus_pengawas')
    </div>
    <div class="container mt-5">
        <h5 class="mb-3">MODAL KOPERASI</h5>
        @include('admin.partial.modal_koperasi')
    </div>
    <div class="container mt-5">
        <h5 class="mb-3">RAPAT ANGGOTA TAHUNAN</h5>
        @include('admin.partial.rapat_anggota_tahunan')
    </div>
    <div class="container mt-5">
        <h5 class="mb-3">KELEMBAGAAN</h5>
        @include('admin.partial.rapat_anggota_tahunan')
    </div>
    <div class="container mt-5">
        <h5 class="mb-3">USAHA</h5>
        @include('admin.partial.usaha')
    </div>
    <div class="container mt-5">
        <h5 class="mb-3">PERIZINAN</h5>
        @include('admin.partial.perizinan')
    </div>

</div>


@endsection
