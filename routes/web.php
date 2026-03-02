<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataUMKMController;
// use App\Http\Controllers\DataUMKMController;
// use App\Http\Controllers\KoperasiController;
// use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


// route login dengan auth dari api sidt
// Route::middleware(['api.guest'])->group(function () {
//     Route::get('/login', [AuthController::class, 'index'])->name('login');
//     Route::post('/login', [AuthController::class, 'login'])->name('login.store');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});



Route::middleware(['auth'])->group(function () {
    
    Route::get('/sebaran-data-umkm', [DataUMKMController::class, 'index'])->name('admin.sebaran.data.umkm');  
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/list-umkm', [UmkmController::class, 'index'])->name('admin.ukmkm.list');

});


// Route::middleware(['api.auth'])->group(function () {
//     // Route::get('/koperasi', [KoperasiController::class, 'index'])->name('admin.koperasi');
//     // Route::get('/koperasi/detail', [KoperasiController::class, 'show'])->name('admin.koperasi.detail');
//     // Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('admin.sertifikat');
//     Route::get('/sebaran-data-umkm', [UmkmController::class, 'sebaranDataUmkm'])->name('admin.sebaran.data.umkm');
//     Route::get('/list-umkm', [UmkmController::class, 'index'])->name('admin.ukmkm.list');
//     // Route::get('/list-umkm/detail/{id}', [DataUMKMController::class, 'show'])->name('admin.umkm.detail');
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });


