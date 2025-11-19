<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProdukController,
    PenjualController,
    KonsumenController,
    PesananController,
    PembayaranController,
    LaporanController,
    AuthController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Tambahan: Login & Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// ==== LOGIN ADMIN ====
Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin.process');

// ==== LOGIN PENJUAL ====
Route::get('/login/penjual', [AuthController::class, 'showPenjualLoginForm'])->name('login.penjual');
Route::post('/login/penjual', [AuthController::class, 'penjualLogin'])->name('login.penjual.process');

// ==== LOGIN KONSUMEN ====
Route::get('/login/konsumen', [AuthController::class, 'showKonsumenLoginForm'])->name('login.konsumen');
Route::post('/login/konsumen', [AuthController::class, 'konsumenLogin'])->name('login.konsumen.process');

// ==== LOGOUT UNTUK SEMUA ROLE ====
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// DASHBOARD ADMIN
Route::get('/dashboard/admin', function () {
    return view('dashboard.admin');
})->name('admin.dashboard');

// DASHBOARD PENJUAL
Route::get('/dashboard/penjual', function () {
    return view('dashboard.penjual');
})->name('penjual.dashboard');

// DASHBOARD KONSUMEN
Route::get('/dashboard/konsumen', function () {
    return view('dashboard.konsumen');
})->name('konsumen.dashboard');


// Halaman utama
Route::get('/', function () {
    return redirect('/login');
});

// ============ Protected Routes (wajib login) ============ //
Route::middleware('auth')->group(function () {

    // PRODUK
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // PENJUAL
    Route::get('/penjual', [PenjualController::class, 'index'])->name('penjual.index');
    Route::get('/penjual/{id}', [PenjualController::class, 'show'])->name('penjual.show');
    Route::post('/penjual', [PenjualController::class, 'store'])->name('penjual.store');
    Route::put('/penjual/{id}', [PenjualController::class, 'update'])->name('penjual.update');
    Route::delete('/penjual/{id}', [PenjualController::class, 'destroy'])->name('penjual.destroy');

    // KONSUMEN
    Route::get('/konsumen', [KonsumenController::class, 'index'])->name('konsumen.index');
    Route::get('/konsumen/{id}', [KonsumenController::class, 'show'])->name('konsumen.show');
    Route::post('/konsumen', [KonsumenController::class, 'store'])->name('konsumen.store');
    Route::put('/konsumen/{id}', [KonsumenController::class, 'update'])->name('konsumen.update');
    Route::delete('/konsumen/{id}', [KonsumenController::class, 'destroy'])->name('konsumen.destroy');

    // PESANAN
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

    // PEMBAYARAN
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/penjualan', [LaporanController::class, 'laporanPenjualan'])->name('laporan.penjualan');
    Route::get('/laporan/pembayaran', [LaporanController::class, 'laporanPembayaran'])->name('laporan.pembayaran');
});

// ============ Fallback ============ //
Route::fallback(function () {
    return response()->json([
        'message' => 'Halaman tidak ditemukan (404)',
        'status' => false,
    ], 404);
});
