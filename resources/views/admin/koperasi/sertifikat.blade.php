@extends('admin.main.main')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">
    <div class="container mt-2">
        <h4 class="fw-bold mb-4" style="color: #2b3a61;">Data Sertifikat Koperasi</h4>
        
        <div class="card border-0 p-4 mb-4 shadow-sm" style="border-radius: 12px; background: white;">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-muted">Wilayah Keanggotaan</label>
                    <select id="filterWilayah" class="form-select" style="border-radius: 8px;">
                        <option value="">Semua Wilayah Keanggotaan</option>
                        <option value="KAB. TANGERANG">Kabupaten Tangerang</option>
                        <!-- <option value="KOTA TANGERANG">Kota Tangerang</option>
                        <option value="JAKARTA">Jakarta</option> -->
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-muted">Status Sertifikat</label>
                    <select id="filterStatus" class="form-select" style="border-radius: 8px;">
                        <option value="">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Expired">Expired</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-5">
                <label class="form-label fw-semibold text-muted">Sertifikat</label>
                <div class="input-group">
                    <input type="text" id="customSearchInput" class="form-control" placeholder="Masukkan NIK, Nama Koperasi..." style="border-radius: 8px 0 0 8px;">
                    <button id="btnCariKoperasi" class="btn btn-primary px-3" style="border-radius: 0 8px 8px 0; background-color: #00997a; border-color: #00997a;">Cari Koperasi</button>
                </div>
                <small class="text-muted d-block mt-1">* Klik NIK untuk melihat Sertifikat</small>
            </div>
        </div>

        <div class="card border-0 p-3 shadow-sm" style="border-radius: 12px;">
            <div class="table-responsive">
                <table id="tableSertifikat" class="table table-striped table-hover align-middle" style="width:100%">
                    <thead>
                        <tr style="background-color: #00997a; color: white;">
                            <th style="background-color: #00997a; color: white; width: 5%" class="text-center">No</th>
                            <th style="background-color: #00997a; color: white; width: 12%">NIK</th>
                            <th style="background-color: #00997a; color: white; width: 15%">Nomor Badan Hukum</th>
                            <th style="background-color: #00997a; color: white; width: 10%">Tanggal Badan Hukum</th>
                            <th style="background-color: #00997a; color: white; width: 20%">Nama Koperasi</th>
                            <th style="background-color: #00997a; color: white; width: 8%" class="text-center">Grade</th>
                            <th style="background-color: #00997a; color: white; width: 12%">Tanggal Diterbitkan</th>
                            <th style="background-color: #00997a; color: white; width: 12%">Tanggal Cetak</th>
                            <th style="background-color: #00997a; color: white; width: 12%">Tanggal Expired</th>
                            <th style="background-color: #00997a; color: white; width: 10%" class="text-center">Edisi Cetak</th>
                            <th style="background-color: #00997a; color: white; width: 12%" class="text-center">Status Sertifikat</th>
                            <th class="d-none">Hidden Wilayah</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($koperasiList as $index => $kop)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <a href="/admin/sertifikat/view/{{ $kop['nik'] }}" class="fw-semibold text-decoration-none" style="color: #00997a;">
                                    {{ $kop['nik'] }}
                                </a>
                            </td>
                            <td>{{ $kop['no_bh'] }}</td>
                            <td>{{ $kop['tgl_bh'] }}</td>
                            <td class="fw-bold" style="color: #334155;">{{ $kop['nama'] }}</td>
                            <td class="text-center"><span class="badge bg-secondary px-2 py-1">{{ $kop['grade'] }}</span></td>
                            <td>{{ $kop['tgl_terbit'] }}</td>
                            <td>{{ $kop['tgl_cetak'] }}</td>
                            <td>{{ $kop['tgl_expired'] }}</td>
                            <td class="text-center">{{ $kop['edisi'] }}</td>
                            <td class="text-center">
                                @if($kop['status_sertifikat'] === 'Aktif')
                                    <span class="badge bg-success px-2 py-1">Aktif</span>
                                @else
                                    <span class="badge bg-danger px-2 py-1">Expired</span>
                                @endif
                            </td>
                            <td class="d-none">{{ strtoupper($kop['wilayah']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables Client Side
        var table = $('#tableSertifikat').DataTable({
            "dom": "lrtip", 
            "pageLength": 10,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
            }
        });

        $('#btnCariKoperasi').on('click', function() {
            var searchVal = $('#customSearchInput').val();
            table.search(searchVal).draw();
        });

        
        $('#customSearchInput').on('keyup', function(e) {
            if (e.key === 'Enter') {
                table.search(this.value).draw();
            }
        });

        // Logic Filter Wilayah Keanggotaan (Kolom 11 / index ke-11 tersembunyi)
        $('#filterWilayah').on('change', function() {
            var wilayahVal = $(this).val();
            table.column(11).search(wilayahVal).draw();
        });

        // Logic Filter Status Sertifikat (Kolom 10 / index ke-10)
        $('#filterStatus').on('change', function() {
            var statusVal = $(this).val();
            table.column(10).search(statusVal ? '^' + statusVal + '$' : '', true, false).draw();
        });
    });
</script>
@endsection