<?php

use App\Exports\UmkmNibExport;
use App\Exports\UmkmWilayahExport;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataUMKMController;
use App\Http\Controllers\FrontendController;
// use App\Http\Controllers\DataUMKMController;
// use App\Http\Controllers\KoperasiController;
// use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\IndikatorUsahaLainnyaController;
use App\Http\Controllers\PesananController;
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

Route::middleware(['guest'])->group(function () {
   
    Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/list-panel', [FrontendController::class, 'listPanel'])->name('frontend.list.panel');
    Route::get('/e-learning', [FrontendController::class, 'eLearning'])->name('frontend.e-learning');
    Route::get('/e-commerce', [FrontendController::class, 'eCommerce'])->name('frontend.eCommerce');
    Route::get('/e-commerce/produk', [FrontendController::class, 'eCommerceDetail'])->name('frontend.eCommerce.detail');
    Route::get('/koperasi', [FrontendController::class, 'koperasi'])->name('frontend.koperasi');
    Route::get('/tambah-umkm', [FrontendController::class, 'tambahUmkm'])->name('frontend.tambah.umkm');
    Route::get('/register', [AuthController::class, 'register'])->name('frontend.register');
    Route::post('/register', [AuthController::class, 'store'])->name('frontend.register.store');

    // nanti pake setelah login bisa akses halaman ini
    Route::get('/cart-list', [FrontendController::class, 'cartList'])->name('frontend.cart.list');
    Route::get('/toko', [FrontendController::class, 'toko'])->name('frontend.toko');

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
