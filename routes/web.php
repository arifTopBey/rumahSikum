<?php

use App\Http\Controllers\DataUMKMController;
use App\Http\Controllers\KoperasiController;
use App\Http\Controllers\SertifikatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.koperasi');
});

Route::get('/koperasi', [KoperasiController::class, 'index'])->name('admin.koperasi');
Route::get('/koperasi/detail', [KoperasiController::class, 'show'])->name('admin.koperasi.detail');
Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('admin.sertifikat');
Route::get('/sebaran-data-umkm', [DataUMKMController::class, 'index'])->name('admin.sebaran.data.umkm');
Route::get('/list-umkm', [DataUMKMController::class, 'list_umkm'])->name('admin.ukmkm.list');
Route::get('/list-umkm/detail/{id}', [DataUMKMController::class, 'show'])->name('admin.umkm.detail');


