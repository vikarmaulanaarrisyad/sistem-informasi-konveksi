<?php

use App\Http\Controllers\Frontend\{
    IndexController
};

use App\Http\Controllers\{
    DashboardController,
    KategoriController,
    LayananController,
    PembelianController,
    PesananController,
    ProdukController
};

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile/edit', [IndexController::class, 'userProfileEdit'])->name('user.profile.edit');
Route::post('/user/profile/update', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');
Route::get('/user/change/password', [IndexController::class, 'changePassword'])->name('change.password');
Route::post('/user/update/password', [IndexController::class, 'userUpdatePassword'])->name('user.update.password');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

    // Route : Pembelian
    Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
    Route::get('/pembelian/{id}/detail', [PembelianController::class, 'detail'])->name('pembelian.detail');
    Route::resource('pembelian', PembelianController::class);
});
