<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute default, arahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// --- RUTE UNTUK TAMU (YANG BELUM LOGIN) ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);


// --- RUTE YANG MEMERLUKAN LOGIN ---
Route::middleware('auth')->group(function () {

    // Rute Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // --- RUTE KHUSUS UNTUK ADMIN ---
    Route::middleware('admin')->group(function () {

        // Rute untuk Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chartData');

        // Rute untuk Sarpras
        Route::resource('sarpras', SarprasController::class);

        // Rute untuk Peminjaman
        Route::resource('peminjaman', PeminjamanController::class)->except(['update']);
        Route::patch('peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('peminjaman.update');

        // Rute untuk Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'downloadPDF'])->name('laporan.downloadPDF');

        // Rute untuk Manajemen Akun
        Route::resource('users', UserController::class);
    });
});

