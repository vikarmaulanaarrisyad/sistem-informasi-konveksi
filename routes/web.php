<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['role_or_permission:view-dashboard']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Route : Layanan
    Route::get('/layanan/data', [LayananController::class, 'data'])->name('layanan.data');
    Route::resource('/layanan', LayananController::class)->except('create', 'edit');

    // Route : Kateogri
    Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
    Route::get('kategori/search', [KategoriController::class, 'search'])->name('kategori.search');
    Route::resource('/kategori', KategoriController::class);

    // Route : Produk
    Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
    Route::resource('/produk', ProdukController::class);

    // Route : Pesanan
    Route::get('/pesanan/data', [PesananController::class, 'data'])->name('pesanan.data');
    Route::post('/pesanan/update-status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::get('/pesanan/{id}/detail', [PesananController::class, 'detail'])->name('pesanan.detail');
    Route::resource('/pesanan', PesananController::class);
});
