<?php

use App\Http\Controllers\KoperasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/test', [KoperasiController::class, 'syncProductAndGetNikop']);

Route::post('/daftar-koperasi', [KoperasiController::class,'daftarkanKoperasiMitra']);

Route::get('/daftar-anggota', [KoperasiController::class,'syncAnggota']);

Route::post('/syncTransaksi', [KoperasiController::class,'syncTransaksi']);


