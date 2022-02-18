<?php

use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\LokasiSuratController;
use App\Http\Controllers\LaporanSuratController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::resource('golongan', GolonganController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('unit_kerja', UnitKerjaController::class);
    Route::prefix('user')->group(function(){
        Route::resource('user', UserController::class);
        Route::get('change-password', [UserController::class, 'changePassword'])->name('change_password');
        Route::put('change-password/{id}', [UserController::class, 'updatePassword'])->name('update_password');
    });
    Route::resource('user', UserController::class);
    Route::resource('jenis_surat', JenisSuratController::class);
    Route::resource('surat_masuk', SuratMasukController::class);
    Route::resource('surat_keluar', SuratKeluarController::class);
    Route::prefix('disposisi')->group(function(){
        Route::resource('disposisi', DisposisiController::class);        
        Route::get('get_disposisi/{id}', [DisposisiController::class, 'getDisposisi']);        
    });
    Route::resource('disposisi', DisposisiController::class);
    Route::resource('lokasi-surat', LokasiSuratController::class);
    Route::resource('arsip', ArsipSuratController::class);
    Route::get('get-surat-masuk', [SuratMasukController::class, 'getSuratMasukJson'])->name('get_surat_masuk');
    Route::get('get-surat-keluar', [SuratKeluarController::class, 'getSuratKeluarJson'])->name('get_surat_keluar');
    Route::prefix('laporan_surat')->group(function () {
        Route::resource('laporan_surat', LaporanSuratController::class);
        Route::get('get_laporan', [LaporanSuratController::class, 'getLaporan']);
    });
    Route::resource('laporan_surat', LaporanSuratController::class);
});

require __DIR__.'/auth.php';
