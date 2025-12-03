<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    RegisterController,
    ProdukController,
    PenjualController,
    KonsumenController,
    PesananController,
    PembayaranController,
    LaporanController,
    CartController
};

/*
|--------------------------------------------------------------------------
| Web Routes (FINAL VERSION - WITH CHECKOUT FLOW)
|--------------------------------------------------------------------------
*/

// ========================================================================
// 1. PUBLIC ROUTES (Bisa Diakses Siapa Saja)
// ========================================================================

Route::get('/', function () {
    return redirect()->route('login');
});

// --- Auth Pages ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::get('/login/penjual', [AuthController::class, 'showPenjualLoginForm'])->name('login.penjual');
Route::get('/login/konsumen', [AuthController::class, 'showKonsumenLoginForm'])->name('login.konsumen');

// --- Auth Process ---
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin.process');
Route::post('/login/penjual', [AuthController::class, 'penjualLogin'])->name('login.penjual.process');
Route::post('/login/konsumen', [AuthController::class, 'konsumenLogin'])->name('login.konsumen.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Register ---
Route::get('/register', [RegisterController::class, 'showKonsumenRegisterForm'])->name('register.konsumen');
Route::post('/register', [RegisterController::class, 'registerKonsumen'])->name('register.konsumen.process');
Route::get('/register-mitra', [RegisterController::class, 'showPenjualRegisterForm'])->name('register.penjual');
Route::post('/register-mitra', [RegisterController::class, 'registerPenjual'])->name('register.penjual.process');

// --- KATALOG & DETAIL PRODUK (PUBLIC) ---
Route::get('/katalog', [ProdukController::class, 'katalog'])->name('produk.katalog');
// Tambahkan ->where('id', '[0-9]+') agar hanya menerima angka
Route::get('/produk/{id}', [ProdukController::class, 'show'])
    ->name('produk.show')
    ->where('id', '[0-9]+');


// ========================================================================
// 2. ADMIN ROUTES
// ========================================================================
Route::middleware(['auth:web'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard/admin', function () {
        $totalPenjual = App\Models\Penjual::count();
        $totalKonsumen = App\Models\Konsumen::count();
        $pendingBayar = App\Models\Pembayaran::where('status_pembayaran', 'Menunggu Verifikasi')->count();
        return view('dashboard.admin', compact('totalPenjual', 'totalKonsumen', 'pendingBayar'));
    })->name('admin.dashboard');
    
    // Settings
    Route::get('/admin/settings', [AuthController::class, 'showAdminSettings'])->name('admin.settings');
    Route::put('/admin/settings', [AuthController::class, 'updateAdminSettings'])->name('admin.settings.update');

    // Manajemen
    Route::resource('penjual', PenjualController::class);
    Route::resource('konsumen', KonsumenController::class);
    Route::get('/pembayaran/admin', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{id}/verify', [PembayaranController::class, 'verify'])->name('pembayaran.verify');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/penjualan', [LaporanController::class, 'laporanPenjualan'])->name('laporan.penjualan');
    Route::get('/laporan/pembayaran', [LaporanController::class, 'laporanPembayaran'])->name('laporan.pembayaran');
});


// ========================================================================
// 3. PENJUAL ROUTES
// ========================================================================
Route::middleware(['auth:penjual'])->group(function () {
    Route::get('/dashboard/penjual', [PenjualController::class, 'dashboard'])->name('penjual.dashboard');
    Route::resource('produk', ProdukController::class);
    Route::get('/pesanan-masuk', [PesananController::class, 'indexPenjual'])->name('pesanan.penjual');
    Route::get('/pesanan-masuk/{id}', [PesananController::class, 'show'])->name('pesanan.penjual.show');
    Route::get('/laporan/penjual', [LaporanController::class, 'laporanPenjualan'])->name('laporan.penjualan.penjual');
});


// ========================================================================
// 4. KONSUMEN ROUTES
// ========================================================================
Route::middleware(['auth:konsumen'])->group(function () {
    Route::get('/dashboard/konsumen', [KonsumenController::class, 'dashboard'])->name('konsumen.dashboard');

    // Cart System
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');

    // --- CHECKOUT FLOW (BARU) ---
    // 1. Halaman Konfirmasi (Form Alamat & Bayar)
    Route::get('/checkout-confirmation', [PesananController::class, 'checkoutPage'])->name('checkout.page');
    // 2. Proses Simpan ke Database
    Route::post('/checkout-process', [PesananController::class, 'store'])->name('pesanan.store');
    // 3. Halaman Sukses
    Route::get('/order-success/{id}', [PesananController::class, 'successPage'])->name('pesanan.success');

    // Riwayat & Pembayaran
    Route::get('/riwayat-pesanan', [PesananController::class, 'indexKonsumen'])->name('pesanan.konsumen');
    Route::get('/riwayat-pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.konsumen.show');
    Route::get('/pembayaran/bayar/{id_pesanan}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran/upload', [PembayaranController::class, 'store'])->name('pembayaran.store');
});

// Fallback
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});