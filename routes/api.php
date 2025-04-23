<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\InstansiTerhubungController;
use App\Http\Controllers\LacakPengaduanController;
use App\Http\Controllers\WhatsappController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/pengaduan', [PengaduanController::class, 'index']); // Ambil semua pengaduan
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show']); // Ambil pengaduan berdasarkan ID
Route::get('/pengaduan-harian', [HalamanUtamaController::class, 'pengaduanHarian']);
Route::get('/instansi', [HalamanUtamaController::class, 'getInstansi']); // Hitung Instansi
Route::get('/cari-instansi', [HalamanUtamaController::class, 'cariInstansi']); // Cari Instansi
Route::get('/daftar-instansi', [InstansiTerhubungController::class, 'getInstansi']); // Instansi Terhubung
Route::get('/cari', [LacakPengaduanController::class, 'cari']); // Cari pengaduan berdasarkan kode formulir
Route::post('/webhook-wa', [WhatsappController::class, 'webhook']);
Route::middleware('throttle:5,1')->post('/pengaduan', [PengaduanController::class, 'store']); // ✅ Pastikan metode POST
