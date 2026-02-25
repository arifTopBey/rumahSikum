@extends('admin.main.main')


  {{-- 0 => array:10 [▼
      "id_badan_usaha" => 311659
      101 => 311659
      102 => "36 BANTEN"
      103 => "36.03 KAB. TANGERANG"
      104 => "36.03.03 TIGARAKSA"
      105 => "36.03.03.2010 MARGASARI"
      106 => "BUBUR AYAM CIANJUR DEUDEUIEUN"
      108 => 3
      "109a" => "Pasr Ciung Perum PWS Tigaraksa RT.4 RW.2"
      "109e" => "08128752181" --}}

@section('content')
    <div class="">
        <div class="container px-5 bg-white ">
            <div class="row py-5">
                <div class="col-md-12 mx-auto  border-warning bg-warning bg-opacity-10 rounded-2  py-2 mb-3">
                    <p class="fw-bold fs-5 text-primary">Data UMKM By Name By Address</p>
                    <p class="text-muted">Ringkasan data berisikan informasi data umkm yang bersifat umum</p>
                </div>
                <div class="col-lg-12 px-2">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-center text-white">
                                <tr style="" class="">
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Aksi</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">No</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Nama Usaha</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Skala Usaha</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Provinsi</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Kab/Kot</th>
                                    <th style="background-color: rgba(108, 117, 125, 0.1);" class="fw-semibold text-dark ">Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $umkm )
                            {{-- @dd($umkm) --}}
                                <tr>
                                    <td class="text-center"><a href="{{ route('admin.umkm.detail', $umkm['id_badan_usaha']) }}" class="fs-3 text-dark text-decoration-none">:</a></td>
                                    <td class="">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $umkm[106] ?? $umkm['106'] ?? '-' }}</td>
                                    <td class="text-center">
                                        <div
                                            class="d-flex mb-3 px-3 py-2 bg-warning bg-opacity-10 border border-warning rounded-2">
                                            <p class="text-warning my-auto">Usaha Mikro</p>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm['102'] ?? '') }}</td>
                                    <td class="text-center">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm['103'] ?? '') }}</td>
                                    <td class="text-center">{{ preg_replace('/^[0-9.]+\s+/', '', $umkm['104'] ?? '') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
