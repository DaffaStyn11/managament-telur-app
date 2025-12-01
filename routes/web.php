<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\TelurController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PembukuanController;
use resources\views\managementelur\layout;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('register', function () {
    return view('auth/register');
});

Route::get('resetpassword', function () {
    return view('auth/resetpassword');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

// Pengeluaran CRUD Routes
Route::resource('pengeluaran', PengeluaranController::class);

// Pembukuan Routes
Route::get('pembukuan', [PembukuanController::class, 'index'])->name('pembukuan.index');
