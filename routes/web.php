<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\TentangLaporController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\InstansiTerhubungController;
use App\Http\Controllers\LacakPengaduanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EditMediaSosialController;
use App\Http\Controllers\EditFooterController;
use App\Http\Controllers\EditTentangLaporController;
use App\Http\Controllers\LogSistemController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Halaman Untuk Depan/Penduduk
|--------------------------------------------------------------------------
*/
Route::get('/', [HalamanUtamaController::class, 'index']);
Route::get('/tentangLapor', [TentangLaporController::class, 'index']);
Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/statistik', [StatistikController::class, 'index']);
Route::get('/instansiTerhubung', [InstansiTerhubungController::class, 'index']);
Route::get('/lacakPengaduan', [LacakPengaduanController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Halaman Login
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Halaman Beranda (Bisa Diakses Semua User yang Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');
    Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/updateProfile', [UserController::class, 'updateProfile'])->name('users.updateProfile');
    Route::get('/beranda/count', [BerandaController::class, 'getCount']);
});

/*
|--------------------------------------------------------------------------
| Super User (Memiliki Akses Penuh)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Super user'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/editMediaSosial', EditMediaSosialController::class);
    Route::resource('/editFooter', EditFooterController::class);
    Route::resource('/editTentangLapor', EditTentangLaporController::class);
	Route::resource('/logSistem', LogSistemController::class);
    Route::post('/users/check-nip', [UserController::class, 'checkNip'])->name('users.check-nip');
	Route::get('/log-monitoring', [logSistemController::class, 'getLog'])->name('log.monitoring');
	Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});

/*
|--------------------------------------------------------------------------
| (Akses Tertentu)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Super user,Admin,Kepala'])->group(function () {
    Route::resource('/pengaduan', PengaduanController::class);
    Route::resource('/report', ReportController::class);
    Route::resource('/instansi', InstansiController::class);
    Route::get('/export-pdf', [ReportController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/export-excel', [ReportController::class, 'exportExcel'])->name('export.excel');
});

Route::middleware(['auth', 'role:Super user,Admin'])->group(function () {
    Route::resource('/tanggapan', TanggapanController::class);
});



