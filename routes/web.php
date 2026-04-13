<?php

use App\Exports\UmkmNibExport;
use App\Exports\UmkmWilayahExport;
use App\Http\Controllers\Admin\BeritaController;
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
Route::get('/e-commerce', [FrontendController::class, 'eCommerce'])->name('frontend.eCommerce');
Route::get('/e-commerce/produk', [FrontendController::class, 'eCommerceDetail'])->name('frontend.eCommerce.detail');
Route::get('/koperasi', [FrontendController::class, 'koperasi'])->name('frontend.koperasi');
Route::get('/tambah-umkm', [FrontendController::class, 'tambahUmkm'])->name('frontend.tambah.umkm');
Route::get('/acara', [FrontendController::class, 'acara'])->name('frontend.acara');
Route::get('/acara/detail-acara', [FrontendController::class, 'detailAcara'])->name('frontend.acara.detail');
Route::get('/toko', [FrontendController::class, 'toko'])->name('frontend.toko');
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

Route::get('/storage/private/{path}', [BeritaController::class, 'showFotoBerita'])->where('path', '.*')->name('showFoto.berita.private');

// web.php


Route::middleware(['guest'])->group(function () {
    
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    
    Route::get('/register', [AuthController::class, 'register'])->name('frontend.register');
    Route::post('/register', [AuthController::class, 'store'])->name('frontend.register.store');

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

   

    Route::get('/pelatihan', [FrontendController::class, 'pelatihan'])->name('frontend.pelatihan');
    Route::get('/pelatihan/detail-pelatihan', [FrontendController::class, 'detailPelatihan'])->name('frontend.pelatihan.detail');

    Route::get('/informasi-bpom', [FrontendController::class, 'informasiBPOM'])->name('frontend.informasi.bpom');

    Route::get('edukasi-keuangan', [FrontendController::class, 'edukasiKeuangan'])->name('frontend.edukasi.keuangan');
    Route::get('edukasi-keuangan/detail-edukasi', [FrontendController::class, 'detailEdukasiKeuangan'])->name('frontend.edukasi.keuangan.detail');

    
    Route::get('/pelatihan/daftar-pelatihan', [FrontendController::class, 'daftarPelatihan'])->name('frontend.daftar.pelatihan');
    
    Route::get('/berita', [FrontendController::class, 'berita'])->name('frontend.berita');
    Route::get('/berita/detail-berita', [FrontendController::class, 'detailBerita'])->name('frontend.berita.detail');
    
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
    Route::get('/usaha-berdasarkan-cluster-prioritas', [UsahaBerdasarkanPrioritasController::class, 'index'])->name('admin.cluster.prioritas');
    Route::get('/usaha-berdasarkan-desil', [UsahaBerdasarkanDesilController::class, 'index'])->name('admin.usaha.desil');
    Route::get('/usaha-berdasarkan-kbli', [UsahaBerdasarkanKbliController::class, 'index'])->name('admin.usaha.kbli');
    Route::get('/indikator-usaha-lainnya', [IndikatorUsahaLainnyaController::class, 'index'])->name('admin.usaha.lainnya');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/list-umkm', [UmkmController::class, 'index'])->name('admin.ukmkm.list');
    Route::get('/list-umkm/detail/{id_badan_usaha}', [UmkmController::class, 'show'])->name('admin.umkm.detail');

    Route::get('/filter-skala', [DataUMKMController::class, 'filterSkala'])->name('admin.filter.skala');
    Route::get('/filter-wilayah', [DataUMKMController::class, 'filterWilayah'])->name('admin.filter.wilayah');
    Route::get('/filter-nib', [DataUMKMController::class, 'filterNIB'])->name('admin.filter.nib');
    Route::get('/filter-gender', [DataUMKMController::class, 'filterGender'])->name('admin.filter.gender');
    Route::get('/filter-tenaga-kerja', [DataUMKMController::class, 'filterTenagaKerja'])->name('admin.filter.tenaga.kerja');
    Route::get('/filter-cluster', [DataUMKMController::class, 'getClusterData'])->name('admin.cluster.data');

    Route::get('/sebaran-data-umkm/kbli/{kategori}', [DataUMKMController::class, 'dataKbriKategori']);

    Route::get('/admin/kategori-berita', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'index'])->name('admin.kategori.berita.index');
    Route::get('/admin/kategori-berita/create', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'create'])->name('admin.kategori.berita.create');
    Route::post('/admin/kategori-berita', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'store'])->name('admin.kategori.berita.store');
    Route::put('/admin/kategori-berita/{id}', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'update'])->name('admin.kategori.berita.update');
    Route::delete('/admin/kategori-berita/{id}', [\App\Http\Controllers\Admin\KategoriBeritaController::class, 'destroy'])->name('admin.kategori.berita.destroy');

    Route::get('/admin/berita', [\App\Http\Controllers\Admin\BeritaController::class, 'index'])->name('admin.berita.index');
    Route::get('/admin/berita/create', [\App\Http\Controllers\Admin\BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/admin/berita', [\App\Http\Controllers\Admin\BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/admin/berita/{id}', [\App\Http\Controllers\Admin\BeritaController::class, 'show'])->name('admin.berita.show');
    Route::delete('/admin/berita/{id}', [\App\Http\Controllers\Admin\BeritaController::class, 'destroy'])->name('admin.berita.destroy');


    // kategori acara admin
    Route::get('/admin/kategori-acara', [\App\Http\Controllers\Admin\KategoriAcaraController::class, 'index'])->name('admin.kategori.acara.index');
    Route::get('/admin/kategori-acara/create', [\App\Http\Controllers\Admin\KategoriAcaraController::class, 'create'])->name('admin.kategori.acara.create');
    Route::post('/admin/kategori-acara', [\App\Http\Controllers\Admin\KategoriAcaraController::class, 'store'])->name('admin.kategori.acara.store');
    Route::put('/admin/kategori-acara/{id}', [\App\Http\Controllers\Admin\KategoriAcaraController::class, 'update'])->name('admin.kategori.acara.update');
    Route::delete('/admin/kategori-acara/{id}', [\App\Http\Controllers\Admin\KategoriAcaraController::class, 'destroy'])->name('admin.kategori.acara.destroy');

    
    // acara admin
    Route::get('/admin/acara', [\App\Http\Controllers\Admin\AcaraController::class, 'index'])->name('admin.acara.index');
    Route::get('/admin/acara/create', [\App\Http\Controllers\Admin\AcaraController::class, 'create'])->name('admin.acara.create');
    Route::post('/admin/acara', [\App\Http\Controllers\Admin\AcaraController::class, 'store'])->name('admin.acara.store');
    Route::get('/admin/acara/{id}', [\App\Http\Controllers\Admin\AcaraController::class, 'show'])->name('admin.acara.show');
    Route::get('/admin/acara/{id}/edit', [\App\Http\Controllers\Admin\AcaraController::class, 'edit'])->name('admin.acara.edit');
    Route::put('/admin/acara/{id}', [\App\Http\Controllers\Admin\AcaraController::class, 'update'])->name('admin.acara.update');
    Route::delete('/admin/acara/{id}', [\App\Http\Controllers\Admin\AcaraController::class, 'destroy'])->name('admin.acara.destroy');

    // pelatihan admin
    Route::get('/admin/pelatihan', [\App\Http\Controllers\Admin\PelatihanController::class, 'index'])->name('admin.pelatihan.index');
    Route::get('/admin/pelatihan/create', [\App\Http\Controllers\Admin\PelatihanController::class, 'create'])->name('admin.pelatihan.create');
    Route::post('/admin/pelatihan', [\App\Http\Controllers\Admin\PelatihanController::class, 'store'])->name('admin.pelatihan.store');
    Route::get('/admin/pelatihan/{id}', [\App\Http\Controllers\Admin\PelatihanController::class, 'show'])->name('admin.pelatihan.show');
    Route::get('/admin/pelatihan/{id}/edit', [\App\Http\Controllers\Admin\PelatihanController::class, 'edit'])->name('admin.pelatihan.edit');
    Route::put('/admin/pelatihan/{id}', [\App\Http\Controllers\Admin\PelatihanController::class, 'update'])->name('admin.pelatihan.update');
    Route::delete('/admin/pelatihan/{id}', [\App\Http\Controllers\Admin\PelatihanController::class, 'destroy'])->name('admin.pelatihan.destroy');



    Route::get('/export-skala/{skala}', [UMKMEksportController::class, 'exportBySkala'])->name('admin.export.skala');
    // Route::get('/export-wilayah/{kecamatan}', [UMKMEksportController::class, 'exportByWilayah'])->name('admin.export.wilayah');
    Route::get('/export-wilayah/{kecamatan}', function ($kecamatan) {
        return Excel::download(
            new UmkmWilayahExport($kecamatan),
            "UMKM_Wilayah_$kecamatan.xlsx",
            // \Maatwebsite\Excel\Excel::CSV
        );
    })->name('admin.export.wilayah');

   Route::get('/export-nib/{status}', function ($status) {
        return Excel::download(
            new UmkmNibExport($status),
            "UMKM_NIB_$status.csv",
            \Maatwebsite\Excel\Excel::CSV
        );
    })->name('admin.export.nib');

// Route::get('/export-gender/{gender}', function ($gender) {
//     ini_set('memory_limit', '1024M');
//     set_time_limit(0);

//     return Excel::download(
//         new \App\Exports\UmkmGenderExport($gender),
//         "UMKM_Gender_$gender.csv",
//         \Maatwebsite\Excel\Excel::CSV
//     );
// })->name('admin.export.gender');
Route::get('/export-gender/{gender}', [UMKMEksportController::class, 'exportByGender'])
    ->name('admin.export.gender');
});




// test