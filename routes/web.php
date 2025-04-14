<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;



// Halaman utama
Route::get('/', function () {
    // return view('auth.login');
    return view('welcome');

});

// Rute untuk dashboard (hanya bisa diakses jika login)
Route::get('/dashboards', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Resource routes untuk CRUD (otomatis mencakup index, create, store, show, edit, update, destroy)
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('pelanggans', PelangganController::class);
    Route::resource('penjualans', PenjualanController::class);
    Route::resource('detail-penjualans', DetailPenjualanController::class);
});

// Rute autentikasi Laravel
Auth::routes();

// Rute home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Logout harus menggunakan POST
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak-pdf', [LaporanController::class, 'cetakPDF'])->name('laporan.cetak_pdf');
Route::post('/transaksi/process', [TransaksiController::class, 'process'])->name('transaksi.process');
