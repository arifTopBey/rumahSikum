<?php

use App\Exports\UmkmNibExport;
use App\Exports\UmkmWilayahExport;
use App\Http\Controllers\Admin\AcaraController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\BannerSliderController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DaftarPesananController;
use App\Http\Controllers\Admin\DaftarUmkmController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ElearningController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\KategoriAcaraController;
use App\Http\Controllers\Admin\KategoriElearningController;
use App\Http\Controllers\Admin\KategoriPelatihanController;
use App\Http\Controllers\Admin\KategoriProdukController;
use App\Http\Controllers\Admin\KuponController;
use App\Http\Controllers\Admin\PelatihanController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\TokoController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\WhatappController;
use App\Http\Controllers\Admin\WishlistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUMKMController;
use App\Http\Controllers\FrontendController;
// use App\Http\Controllers\DataUMKMController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\IndikatorUsahaLainnyaController;
use App\Http\Controllers\KoperasiController;
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
use App\Http\Controllers\Vendor\ProdukController as VendorProdukController;
use App\Http\Controllers\Vendor\ProfileVendorController;
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
Route::get('/e-commerce/kategori-produk', [FrontendController::class, 'kategoriProduk'])->name('frontend.produk.kategori');

// withlist
Route::get('/e-commerce/wishlist-produk', [WishlistController::class, 'wishListProduk'])->name('frontend.wishlist.produk');
Route::post('/e-commerce/wishlist-produk/store', [WishlistController::class, 'store'])->name('frontend.wishlist.produk.store');
Route::delete('/e-commerce/wishlist-produk/delete/{id}', [WishlistController::class, 'delete'])->name('frontend.wishlist.produk.delete');

Route::get('/koperasi', [FrontendController::class, 'koperasi'])->name('frontend.koperasi');
Route::get('/tambah-umkm', [FrontendController::class, 'tambahUmkm'])->name('frontend.tambah.umkm');
Route::get('/acara', [FrontendController::class, 'acara'])->name('frontend.acara');
Route::get('/acara/detail-acara/{id}', [FrontendController::class, 'detailAcara'])->name('frontend.acara.detail');
Route::get('/toko', [FrontendController::class, 'toko'])->name('frontend.toko');
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/pelatihan', [FrontendController::class, 'pelatihan'])->name('frontend.pelatihan');
Route::get('/pelatihan/detail-pelatihan/{id}', [FrontendController::class, 'detailPelatihan'])->name('frontend.pelatihan.detail');
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
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


// akses media private
Route::get('/storage/private/acara/{path}', [AcaraController::class, 'showFotoAcara'])->where('path', '.*')->name('showFoto.acara.private');
Route::get('/storage/private/pelatihan/{path}', [PelatihanController::class, 'showFotoPelatihan'])->where('path', '.*')->name('showFoto.pelatihan.private');
Route::get('/storage/private/elearning/thumbnail/{path}', [ElearningController::class, 'showFotoThumbnail'])->where('path', '.*')->name('showFoto.elearning.thumnail.private');
Route::get('/storage/private/elearning/mentor/{path}', [ElearningController::class, 'showFotoMentor'])->where('path', '.*')->name('showFoto.elearning.mentor.private');
Route::get('/storage/private/profile/user/{path}', [UserProfileController::class, 'showFotoProfil'])->where('path', '.*')->name('showFoto.fotoProfile.private');
Route::get('/storage/private/{path}', [BeritaController::class, 'showFotoBerita'])->where('path', '.*')->name('showFoto.berita.private');
Route::get('/storage/app/private/{path}', [ElearningController::class, 'showPdfElearning'])->where('path', '.*')->name('showPdf.elearning.private');
Route::get('/storage/app/icon/{path}', [KategoriProdukController::class, 'showIconKategori'])->where('path', '.*')->name('show.icon.produk.private');
Route::get('/storage/app/ktp/{path}', [DaftarUmkmController::class, 'showFotoKtp'])->where('path', '.*')->name('show.ktp.private');
Route::get('/storage/app/{path}', [\App\Http\Controllers\Vendor\ProdukController::class, 'showThumbnailProduk'])->where('path', '.*')->name('show.thumbnail.produk.private');


Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'register'])->name('frontend.register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('frontend.register.store');


    // dashboard umkm
    Route::get('/produk', [ProdukController::class, 'index'])->name('dashboard.produk.index');
    Route::get('/umkm/pesanan', [\App\Http\Controllers\Dashboard\PesananController::class, 'index'])->name('dashboard.pesanan.index');
    Route::get('/saldo-penarikan', [\App\Http\Controllers\Dashboard\SaldoPenarikanController::class, 'index'])->name('dashboard.saldo.penarikan.index');
    Route::get('/promosi', [\App\Http\Controllers\Dashboard\PromosiController::class, 'index'])->name('dashboard.promosi.index');
    Route::get('/pengaturan', [\App\Http\Controllers\Dashboard\PengaturanController::class, 'index'])->name('dashboard.pengaturan.index');

});


Route::middleware(['auth'])->group(function () {



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // alamat
    Route::get('/user/alamat', [AddressController::class, 'index'])->name('user.address');
    Route::post('/user/alamat/create', [AddressController::class, 'store'])->name('user.address.store');
    Route::put('/user/alamat/update/{id}', [AddressController::class, 'update'])->name('user.address.update');
    Route::delete('/user/alamat/delete/{id}', [AddressController::class, 'destroy'])->name('user.address.delete');


    // profile
    Route::get('/user/profile/{id}', [UserProfileController::class, 'index'])->name('user.prfile.index');
    Route::put('/user/profile/{id}/update', [UserProfileController::class, 'update'])->name('user.profile.update');


    // order list 
    Route::get('/user/daftar-pesanan/{id}', [DaftarPesananController::class, 'index'])->name('user.list.pesanan');


    // daftar umkm
    Route::get('/user/daftar-umkm', [DaftarUmkmController::class, 'index'])->name('user.daftar.umkm');
    Route::post('/user/daftar-umkm/store', [ProdukController::class, 'vendorStore'])->name('user.daftar.umkm.store');
    // Route::get('/admin/list-daftar-umkm', [DaftarUmkmController::class, 'list_daftar_umkm'])->name('admin.daftar.umkm');
    // Route::get('/admin/daftar-umkm/{id}', [DaftarUmkmController::class, 'detail_pengajuan_umkm'])->name('daftar.pengajuan.detail');
    // Route::put('/admin/update-status-umkm/{id}', [DaftarUmkmController::class, 'updateStatusUmkm'])->name('admin.update.status.pengajuan');


    // dashboard user dan seller
    Route::get('/user/dashboard', [AdminDashboardController::class, 'index'])->name('user.dashboard');


    Route::middleware(['check_role:vendor'])->group(function () {

        // vendor produks
        Route::get('/vendor/produks/create', [VendorProdukController::class, 'create'])->name('vendor.produk.create');
        Route::get('/vendor/produks', [VendorProdukController::class, 'index'])->name('vendor.produk.index');
        Route::post('/vendor/produk/store', [VendorProdukController::class, 'store'])->name('vendor.produk.store');
        Route::get('/vendor/produks/{id}', [VendorProdukController::class, 'show'])->name('vendor.produk.show');
        Route::get('/vendor/produks/edit/{id}', [VendorProdukController::class, 'edit'])->name('vendor.produk.edit');
        Route::put('/vendor/produks/update/{id}', [VendorProdukController::class, 'update'])->name('vendor.produk.update');

        Route::get('/vendor/profile', [ProfileVendorController::class, 'index'])->name('vendor.profile.index');
        
    });


    Route::middleware(['check_role:admin'])->group(function () {


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

        // kategori berita
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
        Route::get('/admin/elearning/create', [ElearningController::class, 'create'])->name('admin.elearning.create');
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


        // sebaran data umkm
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

        // daftar umkm
        Route::get('/admin/list-daftar-umkm', [DaftarUmkmController::class, 'list_daftar_umkm'])->name('admin.daftar.umkm');
        Route::get('/admin/daftar-umkm/{id}', [DaftarUmkmController::class, 'detail_pengajuan_umkm'])->name('daftar.pengajuan.detail');
        Route::put('/admin/update-status-umkm/{id}', [DaftarUmkmController::class, 'updateStatusUmkm'])->name('admin.update.status.pengajuan');

        // whatApp
        Route::get('/admin/whatapps', [WhatappController::class, 'index'])->name('admin.whatapp.index');
        Route::get('/admin/whatapps/create', [WhatappController::class, 'create'])->name('admin.whatapp.create');
        Route::post('/whatsapp/send', [WhatappController::class, 'send'])->name('whatsapp.send');
        Route::post('/whatsapp/resend/{id}', [WhatappController::class, 'resend'])->name('admin.whatapp.resend');

        // koperasi
        Route::get('/admin/koperasi/list', [KoperasiController::class, 'index'])->name('admin.koperasi');
        Route::get('/admin/koperasi/detail/{nik}', [KoperasiController::class, 'showDetail'])->name('admin.koperasi.detail');
        Route::get('/admin/koperasi/sertifikat-koperasi', [KoperasiController::class, 'indexSertifikatKoperasi'])->name('admin.sertifikat.koperasi');
        Route::get('/admin/koperasi/statistik-koperasi', [KoperasiController::class, 'indexStatistikKoperasi'])->name('admin.statistik.koperasi');
        Route::get('/admin/koperasi/jenis-koperasi', [KoperasiController::class, 'indexJenisKoperasi'])->name('admin.jenis.koperasi');
        Route::get('/admin/koperasi/kuk-koperasi', [KoperasiController::class, 'indexKuk'])->name('admin.kuk.koperasi');
        Route::get('/admin/koperasi/grade-koperasi', [KoperasiController::class, 'indexGrade'])->name('admin.grade.koperasi');
        Route::get('/admin/koperasi/dashboard-koperasi', [KoperasiController::class, 'getDashboardData'])->name('admin.dashboard.koperasi');
        Route::get('/admin/koperasi/grafik-koperasi', [KoperasiController::class, 'indexGrafikKoperasi'])->name('admin.grafik.koperasi');
        Route::get('/admin/koperasi/pendirian-koperasi', [KoperasiController::class, 'indexPendirianKoperasi'])->name('admin.pendirian.koperasi');

        // Kupon 
        Route::get('/admin/kupon', [KuponController::class, 'index'])->name('admin.kupon.index');
        Route::get('/admin/kupon/create', [KuponController::class, 'create'])->name('admin.kupon.create');
        Route::post('/admin/kupon/store', [KuponController::class, 'store'])->name('admin.kupon.store');
        Route::get('/admin/kupon/edit/{id}', [KuponController::class, 'edit'])->name('admin.kupon.edit');
        Route::put('/admin/kupon/update/{id}', [KuponController::class, 'update'])->name('admin.kupon.update');
        Route::delete('/admin/kupon/delete/{id}', [KuponController::class, 'delete'])->name('admin.kupon.delete');

        // kategori Produk
        Route::get('/admin/kategori-produk', [KategoriProdukController::class, 'index'])->name('admin.kategori.produk');
        Route::post('/admin/kategori-produk/store', [KategoriProdukController::class, 'store'])->name('admin.kategori.produk.store');
        Route::put('/admin/kategori-produk/update/{id}', [KategoriProdukController::class, 'update'])->name('admin.kategori.produk.update');
        Route::delete('/admin/kategori-produk/delete/{id}', [KategoriProdukController::class, 'delete'])->name('admin.kategori.produk.delete');

        // banner
        Route::get('/admin/banner-ecommerce', [BannerSliderController::class, 'index'])->name('admin.slider.index');
        Route::post('/admin/banner-ecommerce/create', [BannerSliderController::class, 'store'])->name('admin.slider.store');
        Route::delete('/admin/banner-ecommerce/delete/{id}', [BannerSliderController::class, 'destroy'])->name('admin.slider.delete');
        Route::put('/admin/banner-ecommerce/update/{id}', [BannerSliderController::class, 'update'])->name('admin.slider.update');

        // list toko vendor
        Route::get('/admin/list-toko', [TokoController::class, 'index'])->name('admin.list.toko.index');
        Route::get('/admin/list-toko/{id}',  [TokoController::class, 'show'])->name('admin.list.toko.detail'); 

        // list produk semua toko
        Route::get('/admin/list-produk', [TokoController::class, 'listProduk'])->name('admin.list.produk.index');
        Route::get('/admin/list-produk/{id}', [TokoController::class, 'listProdukDetail'])->name('admin.list.produk.detail');

        // daftar pengguna
        Route::get('/admin/daftar-pengguna', [PenggunaController::class, 'index'])->name('admin.daftar.pengguna.index');
        Route::get('/admin/daftar-pengguna/{id}', [PenggunaController::class, 'show'])->name('admin.daftar.pengguna.detail');


    });

});




