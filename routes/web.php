<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\TelurController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PembukuanController;

// Guest Routes (tidak perlu login)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/resetpassword', function () {
        return view('auth/resetpassword');
    })->name('password.request');
});

// Protected Routes (perlu login)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kandang CRUD Routes
    Route::resource('kandang', KandangController::class);
    Route::get('kandang/export/excel', [KandangController::class, 'exportExcel'])->name('kandang.export.excel');
    Route::get('kandang/export/pdf', [KandangController::class, 'exportPdf'])->name('kandang.export.pdf');

    // Telur CRUD Routes
    Route::resource('telur', TelurController::class);
    Route::get('telur/export/excel', [TelurController::class, 'exportExcel'])->name('telur.export.excel');
    Route::get('telur/export/pdf', [TelurController::class, 'exportPdf'])->name('telur.export.pdf');

    // Penjualan CRUD Routes
    Route::resource('penjualan', PenjualanController::class);
    Route::get('penjualan/export/excel', [PenjualanController::class, 'exportExcel'])->name('penjualan.export.excel');
    Route::get('penjualan/export/pdf', [PenjualanController::class, 'exportPdf'])->name('penjualan.export.pdf');

    // Pengeluaran CRUD Routes
    Route::resource('pengeluaran', PengeluaranController::class);

    // Pembukuan Routes
    Route::get('pembukuan', [PembukuanController::class, 'index'])->name('pembukuan.index');
});
