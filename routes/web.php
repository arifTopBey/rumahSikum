<?php

use App\Exports\UmkmNibExport;
use App\Exports\UmkmWilayahExport;
use App\Http\Controllers\Admin\AcaraController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\ElearningController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\KategoriAcaraController;
use App\Http\Controllers\Admin\KategoriElearningController;
use App\Http\Controllers\Admin\KategoriPelatihanController;
use App\Http\Controllers\Admin\PelatihanController;
use App\Http\Controllers\Admin\WhatappController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUMKMController;
use App\Http\Controllers\FrontendController;
// use App\Http\Controllers\DataUMKMController;
// use App\Http\Controllers\KoperasiController;
// use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\IndikatorUsahaLainnyaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UsahaBerdasarkanPrioritasController;
use Illuminate\Support\Facades\Route;
// use App\Exports\UmkmSkalaExport;
// use App\Exports\UmkmWilayahExport;
use App\Http\Controllers\UMKMEksportController;
use App\Http\Controllers\UsahaBerdasarkanDesilController;
use App\Http\Controllers\UsahaBerdasarkanKbliController;
use App\Http\Controllers\UsahaWilayahController;
use Maatwebsite\Excel\Facades\Excel;




// route login dengan auth dari api sidt
// Route::middleware(['api.guest'])->group(function () {
//     Route::get('/login', [AuthController::class, 'index'])->name('login');
//     Route::post('/login', [AuthController::class, 'login'])->name('login.store');
// });

Route::get('/list-panel', [FrontendController::class, 'listPanel'])->name('frontend.list.panel');
Route::get('/e-learning', [FrontendController::class, 'eLearning'])->name('frontend.e-learning');
Route::get('/e-learning/detail/{id}', [FrontendController::class, 'detailElearning'])->name('frontend.e-learning.detail');
Route::get('/e-commerce', [FrontendController::class, 'eCommerce'])->name('frontend.eCommerce');
Route::get('/e-commerce/produk', [FrontendController::class, 'eCommerceDetail'])->name('frontend.eCommerce.detail');
Route::get('/koperasi', [FrontendController::class, 'koperasi'])->name('frontend.koperasi');
Route::get('/tambah-umkm', [FrontendController::class, 'tambahUmkm'])->name('frontend.tambah.umkm');
Route::get('/acara', [FrontendController::class, 'acara'])->name('frontend.acara');
Route::get('/acara/detail-acara/{id}', [FrontendController::class, 'detailAcara'])->name('frontend.acara.detail');
Route::get('/toko', [FrontendController::class, 'toko'])->name('frontend.toko');
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/pelatihan', [FrontendController::class, 'pelatihan'])->name('frontend.pelatihan');
Route::get('/pelatihan/detail-pelatihan', [FrontendController::class, 'detailPelatihan'])->name('frontend.pelatihan.detail');
Route::get('/informasi-bpom', [FrontendController::class, 'informasiBPOM'])->name('frontend.informasi.bpom');
Route::get('edukasi-keuangan', [FrontendController::class, 'edukasiKeuangan'])->name('frontend.edukasi.keuangan');
Route::get('edukasi-keuangan/detail-edukasi', [FrontendController::class, 'detailEdukasiKeuangan'])->name('frontend.edukasi.keuangan.detail');    
Route::get('/pelatihan/daftar-pelatihan', [FrontendController::class, 'daftarPelatihan'])->name('frontend.daftar.pelatihan');
// nanti pake setelah login bisa akses halaman ini
Route::get('/cart-list', [FrontendController::class, 'cartList'])->name('frontend.cart.list');
    // nanti memakai id user untuk profile
Route::get('/profile', [ProfileController::class, 'index'])->name('frontend.profile.index');
    // nanti memakai id user untuk pesanan
Route::get('/pesanan', [PesananController::class, 'index'])->name('frontend.pesanan.index');

Route::get('/alamat-saya', [FrontendController::class, 'alamatSaya'])->name('frontend.alamat.saya');
    // nanti pakai id user untuk checkout
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout'); 
    // ulasan nanti pakai id 
Route::get('/ulasan', [FrontendController::class, 'ulasan'])->name('frontend.ulasan');
    // nanti memakai id transaksi untuk detail transaksi
Route::get('/transaksi-detail', [FrontendController::class, 'transaksiDetail'])->name('frontend.transaksi.detail');

Route::get('/berita', [FrontendController::class, 'berita'])->name('frontend.berita');
Route::get('/berita/detail-berita/{id}', [FrontendController::class, 'detailBerita'])->name('frontend.berita.detail');

// akses media private
Route::get('/storage/private/acara/{path}', [AcaraController::class, 'showFotoAcara'])->where('path', '.*')->name('showFoto.acara.private');
Route::get('/storage/private/pelatihan/{path}', [PelatihanController::class, 'showFotoPelatihan'])->where('path', '.*')->name('showFoto.pelatihan.private');
Route::get('/storage/private/elearning/thumbnail/{path}', [ElearningController::class, 'showFotoThumbnail'])->where('path', '.*')->name('showFoto.elearning.thumnail.private');
Route::get('/storage/private/elearning/mentor/{path}', [ElearningController::class, 'showFotoMentor'])->where('path', '.*')->name('showFoto.elearning.mentor.private');
Route::get('/storage/private/{path}', [BeritaController::class, 'showFotoBerita'])->where('path', '.*')->name('showFoto.berita.private');
Route::get('/storage/app/private/{path}', [ElearningController::class, 'showPdfElearning'])->where('path', '.*')->name('showPdf.elearning.private');


Route::middleware(['guest'])->group(function () {
    
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    
    Route::get('/register', [AuthController::class, 'register'])->name('frontend.register');
    Route::post('/register', [AuthController::class, 'store'])->name('frontend.register.store');

    
    
    
    
    // dashboard umkm
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/produk', [ProdukController::class, 'index'])->name('dashboard.produk.index');
    Route::get('/umkm/pesanan', [\App\Http\Controllers\Dashboard\PesananController::class, 'index'])->name('dashboard.pesanan.index');
    Route::get('/saldo-penarikan', [\App\Http\Controllers\Dashboard\SaldoPenarikanController::class, 'index'])->name('dashboard.saldo.penarikan.index');
    Route::get('/promosi', [\App\Http\Controllers\Dashboard\PromosiController::class, 'index'])->name('dashboard.promosi.index');
    Route::get('/pengaturan', [\App\Http\Controllers\Dashboard\PengaturanController::class, 'index'])->name('dashboard.pengaturan.index');

});


Route::middleware(['auth'])->group(function () {

    Route::get('/sebaran-data-umkm', [DataUMKMController::class, 'index'])->name('admin.sebaran.data.umkm');
    Route::get('/usaha-berdasarkan-wilayah', [UsahaWilayahController::class, 'index'])->name('admin.wilayah');
    Route::get('/usaha-berdasarkan-wilayah-desa', [UsahaWilayahController::class, 'wilayahDesa'])->name('admin.wilayah.desa');
    Route::get('/usaha-berdasarkan-cluster-prioritas', [UsahaBerdasarkanPrioritasController::class, 'index'])->name('admin.cluster.prioritas');
    Route::get('/usaha-berdasarkan-desil', [UsahaBerdasarkanDesilController::class, 'index'])->name('admin.usaha.desil');
    Route::get('/usaha-berdasarkan-kbli', [UsahaBerdasarkanKbliController::class, 'index'])->name('admin.usaha.kbli');
    Route::get('/usaha-berdasarkan-perizinan', [DataUMKMController::class, 'dataPerizinanUMKM'])->name('admin.usaha.perizinan');
    Route::get('/usaha-berdasarkan-pemasaran', [DataUMKMController::class, 'dataPemasaranUMKM'])->name('admin.usaha.pemasaran');
    Route::get('/usaha-berdasarkan-status-badan-usaha', [DataUMKMController::class, 'dataStatusBadanUsaha'])->name('admin.status.badan.usaha');
    Route::get('/usaha-berdasarkan-omset', [DataUMKMController::class, 'dataOmzetUsaha'])->name('admin.usaha.berdasarkan.omzet');
    Route::get('/pertumbuhan-usaha-mikro', [DataUMKMController::class, 'dataPertumbuhanUmkm'])->name('admin.data.pertumbuhan.umkm');
    Route::get('/indikator-usaha-lainnya', [IndikatorUsahaLainnyaController::class, 'index'])->name('admin.usaha.lainnya');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/list-umkm', [UmkmController::class, 'index'])->name('admin.ukmkm.list');
    Route::get('/list-umkm/detail/{id_badan_usaha}', [UmkmController::class, 'show'])->name('admin.umkm.detail');


    // filter data tabel umkm
    Route::get('/filter-skala', [DataUMKMController::class, 'filterSkala'])->name('admin.filter.skala');
    Route::get('/filter-wilayah', [DataUMKMController::class, 'filterWilayah'])->name('admin.filter.wilayah');
    Route::get('/filter-wilayah-desa', [DataUMKMController::class, 'filterWilayahDesa'])->name('admin.filter.wilayah.desa');
    Route::get('/filtel-keuangan', [DataUMKMController::class, 'filterLaporanKeuanagan'])->name('admin.filter.laporan.keuangan');
    Route::get('/filtel-digital', [DataUMKMController::class, 'filterDigital'])->name('admin.filter.pemasaran.digital');
    Route::get('/filtel-non-digital', [DataUMKMController::class, 'filterNonDigital'])->name('admin.filter.pemasaran.non.digital');
    Route::get('/filter-nib', [DataUMKMController::class, 'filterNIB'])->name('admin.filter.nib');
    Route::get('/filter-gender', [DataUMKMController::class, 'filterGender'])->name('admin.filter.gender');
    Route::get('/filter-tenaga-kerja', [DataUMKMController::class, 'filterTenagaKerja'])->name('admin.filter.tenaga.kerja');
    Route::get('/filter-cluster', [DataUMKMController::class, 'filterClusterData'])->name('admin.cluster.data');
    Route::get('/filter-status-badan-usaha', [DataUMKMController::class, 'filterStatusUsaha'])->name('admin.filter.status.usaha');
    Route::get('/filter-pertumbuhan-usaha', [DataUMKMController::class, 'filterPertumbuhanUsaha'])->name('admin.filter.pertumbuhan.usaha');
    Route::get('/filter-perizinan-usaha', [DataUMKMController::class, 'filterPerizinan'])->name('admin.filter.perizinan.usaha');
    Route::get('/filter-omzet-usaha', [DataUMKMController::class, 'filterOmzet'])->name('admin.filter.omzet.usaha');
    Route::get('/filter-metode-pemasaran-usaha', [DataUMKMController::class, 'filterMetodeUsahaPemasaran'])->name('admin.filter.metode.pemasaran.usaha');
    
    // filter data tabel umkm

    Route::get('/sebaran-data-umkm/kbli/{kategori}', [DataUMKMController::class, 'dataKbriKategori']);

    Route::get('/admin/kategori-berita', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'index'])->name('admin.kategori.berita.index');
    Route::get('/admin/kategori-berita/create', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'create'])->name('admin.kategori.berita.create');
    Route::post('/admin/kategori-berita', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'store'])->name('admin.kategori.berita.store');
    Route::put('/admin/kategori-berita/{id}', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'update'])->name('admin.kategori.berita.update');
    Route::delete('/admin/kategori-berita/{id}', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'destroy'])->name('admin.kategori.berita.destroy');

    // berita admin
    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
    Route::get('/admin/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/admin/berita/{id}', [BeritaController::class, 'show'])->name('admin.berita.show');
    Route::get('/admin/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');


    // kategori acara admin
    Route::get('/admin/kategori-acara', [KategoriAcaraController::class, 'index'])->name('admin.kategori.acara.index');
    Route::get('/admin/kategori-acara/create', [KategoriAcaraController::class, 'create'])->name('admin.kategori.acara.create');
    Route::post('/admin/kategori-acara', [KategoriAcaraController::class, 'store'])->name('admin.kategori.acara.store');
    Route::put('/admin/kategori-acara/{id}', [KategoriAcaraController::class, 'update'])->name('admin.kategori.acara.update');
    Route::delete('/admin/kategori-acara/{id}', [KategoriAcaraController::class, 'destroy'])->name('admin.kategori.acara.destroy');

    
    // acara admin
    Route::get('/admin/acara', [AcaraController::class, 'index'])->name('admin.acara.index');
    Route::get('/admin/acara/create', [AcaraController::class, 'create'])->name('admin.acara.create');
    Route::post('/admin/acara', [AcaraController::class, 'store'])->name('admin.acara.store');
    Route::get('/admin/acara/{id}', [AcaraController::class, 'show'])->name('admin.acara.show');
    Route::get('/admin/acara/{id}/edit', [AcaraController::class, 'edit'])->name('admin.acara.edit');
    Route::put('/admin/acara/{id}', [AcaraController::class, 'update'])->name('admin.acara.update');
    Route::delete('/admin/acara/{id}', [AcaraController::class, 'destroy'])->name('admin.acara.destroy');

    // kategori pelatihan
    Route::get('/admin/kategori-pelatihan', [KategoriPelatihanController::class, 'index'])->name('admin.kategori.pelatihan.index');
    Route::get('/admin/kategori-pelatihan/create', [KategoriPelatihanController::class, 'create'])->name('admin.kategori.pelatihan.create');
    Route::post('/admin/kategori-pelatihan', [KategoriPelatihanController::class, 'store'])->name('admin.kategori.pelatihan.store');
    Route::put('/admin/kategori-pelatihan/{id}', [KategoriPelatihanController::class, 'update'])->name('admin.kategori.pelatihan.update');
    Route::delete('/admin/kategori-pelatihan/{id}', [KategoriPelatihanController::class, 'destroy'])->name('admin.kategori.pelatihan.destroy');

    // pelatihan admin
    Route::get('/admin/pelatihan', [PelatihanController::class, 'index'])->name('admin.pelatihan.index');
    Route::get('/admin/pelatihan/create', [PelatihanController::class, 'create'])->name('admin.pelatihan.create');
    Route::post('/admin/pelatihan', [PelatihanController::class, 'store'])->name('admin.pelatihan.store');
    Route::get('/admin/pelatihan/{id}', [PelatihanController::class, 'show'])->name('admin.pelatihan.show');
    Route::get('/admin/pelatihan/{id}/edit', [PelatihanController::class, 'edit'])->name('admin.pelatihan.edit');
    Route::put('/admin/pelatihan/{id}', [PelatihanController::class, 'update'])->name('admin.pelatihan.update');
    Route::delete('/admin/pelatihan/{id}', [PelatihanController::class, 'destroy'])->name('admin.pelatihan.destroy');


    // kategori e-learning admin
    Route::get('/admin/kategori-elearning', [KategoriElearningController::class, 'index'])->name('admin.kategori.elearning.index');
    Route::get('/admin/kategori-elearning/create', [KategoriElearningController::class, 'create'])->name('admin.kategori.elearning.create');
    Route::post('/admin/kategori-elearning', [KategoriElearningController::class, 'store'])->name('admin.kategori.elearning.store');
    Route::put('/admin/kategori-elearning/{id}', [KategoriElearningController::class, 'update'])->name('admin.kategori.elearning.update');
    Route::delete('/admin/kategori-elearning/{id}', [KategoriElearningController::class, 'destroy'])->name('admin.kategori.elearning.destroy');

    // admin elearning
    Route::get('/admin/elearning', [ElearningController::class, 'index'])->name('admin.elearning.index');
    Route::get('/admin/elearning/create',[ElearningController::class, 'create'])->name('admin.elearning.create');
    Route::post('/admin/elearning/store', [ElearningController::class, 'store'])->name('admin.elearning.store');
    Route::get('/admin/elearning/{id}', [ElearningController::class, 'show'])->name('admin.elearning.show');
    Route::get('/admin/elearning/edit/{id}', [ElearningController::class, 'edit'])->name('admin.elearning.edit');
    Route::put('/admin/elearning/update/{id}', [ElearningController::class, 'update'])->name('admin.elearning.update');
    Route::delete('/admin/elearning/delete/{id}', [ElearningController::class, 'destroy'])->name('admin.elearning.delete');

    // Route Export Excel
    Route::get('/export-pertumbuhan-usaha', [ExportController::class, 'exportPertumbuhan'])->name('admin.export.pertumbuhan.usaha');   
    Route::get('/export-usaha-berdasarkan-omset', [ExportController::class, 'exportBerdasarkanOmset'])->name('admin.export.usaha.berdasarkan.omset');
    Route::get('/export-wilayah/{kecamatan}', [ExportController::class, 'exportWilayah'])->name('admin.export.wilayah');
    Route::get('/export-wilayah-kelurahan/{kelurahan}', [ExportController::class, 'exportWilayahKelurahan'])->name('admin.export.wilayah.kelurahan');
    Route::get('/export-cluster-prioritas/{cluster}', [ExportController::class, 'exportBerdasarkanCluster'])->name('admin.export.cluster.prioritas');
    Route::get('/export-laporan-keuangan', [ExportController::class, 'exportLaporanKeuangan'])->name('admin.export.laporan.keuangan');
    Route::get('/export-pemasaran-digital', [ExportController::class, 'exportPemasaranDigital'])->name('admin.export.pemasaran.digital');
    Route::get('/export-pemasaran-nondigital', [ExportController::class, 'exportPemasaranNonDigital'])->name('admin.export.pemasaran.non.digital');
    Route::get('/export-status-usaha', [ExportController::class, 'exportStatusUsaha'])->name('admin.export.status.usaha');
    Route::get('/export-perizinan', [ExportController::class, 'exportPerizinan'])->name('admin.export.perizinan');
    Route::get('/export-nib', [ExportController::class, 'exportNIB'])->name('admin.export.nib');
    Route::get('/export-gender', [ExportController::class, 'exportGender'])->name('admin.export.gender');
    Route::get('/export-skala/{skala}', [UMKMEksportController::class, 'exportBySkala'])->name('admin.export.skala');
    Route::get('/export-tenaga-kerja', [ExportController::class, 'exportTenagaKerja'])->name('admin.export.tenaga-kerja');
    Route::get('/export-metode-pemasaran', [ExportController::class, 'exportMetodePemasaran'])->name('admin.export.metode-pemasaran');
    // whatsups
    Route::get('/admin/whatapps', [WhatappController::class, 'index'])->name('admin.whatapp.index');
    Route::get('/admin/whatapps/create', [WhatappController::class, 'create'])->name('admin.whatapp.create');

});




// test