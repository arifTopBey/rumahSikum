<div class="col-md-10 mx-auto rounded-2 mt-2 px-2 py-2 border mb-3">

    <h5 class="fs-4 fw-bold">1101. Apakah memiliki laporan keuangan usaha per 31 Desember?</h5>
    <p class="mt-3">{{ $data->laporanKeuangan->status_pencatatan_keuangan === 1 ? 'Mempunyai' : 'Tidak Mempunyai' }}</p>


    <h5 class="fs-4 fw-bold mt-5 mb-2">1103. Pajak Penghasilan Badan</h5>


    <table class="table table-bordered mt-3">
        <thead>
            <tr class="table-header text-center">
                <th style="background-color: #2c5aa0; color: white;">No</th>
                <th style="background-color: #2c5aa0; color: white;">Uraian</th>
                <th style="background-color: #2c5aa0; color: white;">Nilai Rupiah Setahun yang lalu</th>
               
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>PPh Badan Pasal 25</td>
                <td class="text-center">Rp0</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>PPh Final 0.5% atas Omzet</td>
                <td class="text-center">Rp0</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="col-md-10 mx-auto rounded-2 mt-2 px-2 py-2 border mb-3">

    <h5 class="fs-4 fw-bold mt-5 mb-2">1104-A. Pengeluaran Umum</h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr class="table-header text-center">
                <th style="background-color: #2c5aa0; color: white;">No</th>
                <th style="background-color: #2c5aa0; color: white;">Uraian</th>
                <th style="background-color: #2c5aa0; color: white;">Satuan Standart</th>
                <th style="background-color: #2c5aa0; color: white;">Banyak/Volume</th>
                <th style="background-color: #2c5aa0; color: white;">Nilai (Rupiah) Sebulan yang lalu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>Bahan Bakar Pelumas</td>
                <td class="text-center" colspan="3"></td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>1. BBM(Bensin, Solar, Minyak Tanah, Minyak Bakar)</td>
                <td class="text-center">Liter</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>2. Batubara/Bricket/Kokas</td>
                <td class="text-center">Kg</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>3. LPG/BBG</td>
                <td class="text-center">Kg</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>4. Biomass(Kayu Bakar, Arang, dan Sekam)</td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td>5. Bahan Bakar Lainnya</td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center">RP0</td>
            </tr>
             <tr>
                <td class="text-center"></td>
                <td>6. Pelumas</td>
                <td class="text-center">Liter</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center fw-bold">Total</td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center fw-bold">RP0</td>
            </tr>
             <tr>
                <td class="text-center">b</td>
                <td>Listrik</td>
                <td class="text-center">KWh</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
             <tr>
                <td class="text-center">c</td>
                <td>Gas Kota / Gas Alam</td>
                <td class="text-center">m3</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
             <tr>
                <td class="text-center">d</td>
                <td>Air</td>
                <td class="text-center">m3</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
             <tr>
                <td class="text-center">e</td>
                <td>Telpon, Internet, dan Komunikasi lainnya</td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center">RP0</td>
            </tr>
             <tr>
                <td class="text-center">f</td>
                <td>Alat Tulis Kantor</td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center">RP0</td>
            </tr>
             <tr>
                <td class="text-center">g</td>
                <td>Kemasan, Bahan Pembungkus, dan pengepakan</td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center">RP0</td>
            </tr>
             <tr>
                <td class="text-center">h</td>
                <td>Administrasi Bank dan Perantara Keuangan</td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center">RP0</td>
            </tr>
             <tr>
                <td class="text-center">i</td>
                <td>Nilai Pekerja yang Disubkontrakan</td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center">RP0</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="col-md-10 mx-auto rounded-2 mt-2 px-2 py-2 border mb-3">

    <h5 class="fs-4 fw-bold mt-5 mb-2">1104-B. Pengeluaran Umum (Lanjutan)</h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr class="table-header text-center">
                <th style="background-color: #2c5aa0; color: white;" rowspan="2" class="text-center">No</th>
                <th style="background-color: #2c5aa0; color: white;" rowspan="2" class="text-center">Uraian</th>
                <th style="background-color: #2c5aa0; color: white;" colspan="2">Nilai Rupiah</th>
            </tr>
            <tr class="table-header text-center">
                <th style="background-color: #2c5aa0; color: white;">Setahun Yang lalu Standart</th>
                <th style="background-color: #2c5aa0; color: white;">Sebulan Yang Lalu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">j</td>
                <td>Angkutan, Pengiriman/Ekspedisi, Pergudangan, Pos, dan Jasa Kurir</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">k</td>
                <td>Pembelian Suku Cadang dan Pemeliharaan/Perbaikan Kecil Barang Modal</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">l</td>
                <td>Perjalanan Dinas Pekerja</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">m</td>
                <td>Penelitian dan Pengembangan (Research and Development)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">n</td>
                <td>Biaya Penggunaan Jasa Pihak Lain(Tenaga Ahli/Profesi, Promosi/Iklan, Sewa Kendaraan dan Mesin dengan Operator, dll)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">o</td>
                <td>Beban Bunga Atas Pinjaman</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">p</td>
                <td>Beban Bunga Atas Mobilisasi Dana(Khusus Lembaga Keuangan)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">q</td>
                <td>Sewa</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">r</td>
                <td>Pendidikan dan Pelatihan</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">s</td>
                <td>Pajak Pertambahan Nilai Barang dan Jasa, PBB, Bea dan Cukai, Pajak Ekspor/Import, Pajak Penjualan, dan Pajak Lainnya</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">t</td>
                <td>Penyusutan dan Amortasi</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">u</td>
                <td>Biaya Eksplorasi Kegiatan Pertambangan(misal: Bahan Peledak)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">v</td>
                <td>Pembiayaan Sosial (misal: CSR)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center">w</td>
                <td>Biaya Lainnya (misal: Retribusi, Iuran Organisasi, Pengeluaran Pakaian Kerja, Makanan, dll)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td class="text-center">Total</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="col-md-10 mx-auto rounded-2 mt-2 px-2 py-2 border mb-3">

    <h5 class="fs-4 fw-bold mt-5 mb-2">Laporan Usaha dan Keuangan Lanjutan</h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr class="table-header text-center">
                <th style="background-color: #2c5aa0; color: white;" rowspan="2" class="text-center">Uraian</th>
                <th style="background-color: #2c5aa0; color: white;" colspan="2">Nilai Rupiah</th>
            </tr>
            <tr class="table-header text-center">
                <th style="background-color: #2c5aa0; color: white;">Setahun Yang lalu Standart</th>
                <th style="background-color: #2c5aa0; color: white;">Sebulan Yang Lalu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1105. Asset</td>
                <td class="text-center" colspan="2"></td>
            </tr>
            <tr>
                <td>1. Lancar (Kas, Setara Kas, Persediaan, dan Lain-lain)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td>2. Tetap</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td>3. Investasi</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center fw-bold">Total</td>
                <td class="text-center fw-bold">RP0</td>
                <td class="text-center fw-bold">RP0</td>
            </tr>
            <tr>
                <td class="text-center">1106. Modal Pinjaman / Luar</td>
                <td class="text-center" colspan="2"></td>
            </tr>
            <tr>
                <td>1. Lancar/Pinjaman Jangka Pendek(Kurang dari Satu Tahun)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td>2. Tidak Lancar/Pinjaman Jangka Panjang(Lebih dari Satu Tahun)</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
            <tr>
                <td class="text-center fw-bold">Total</td>
                <td class="text-center fw-bold">RP0</td>
                <td class="text-center fw-bold">RP0</td>
            </tr>

             <tr>
                <td>1107. Modal/Ekuitas</td>
                <td class="text-center">RP0</td>
                <td class="text-center">RP0</td>
            </tr>
        </tbody>
    </table>

    <div class="d-flex gap-5">
        <h5 class="fs-4 fw-bold mt-5 mb-2">1108. Berapa nilai Penambahan aset tetap?</h5>
        <p class="ms-5 mt-5">Rp0</p>
    </div>
</div>