<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\TelurController;
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

Route::get('dashboard', function () {
    return view('pages/dashboard/index');
});

// Kandang CRUD Routes
Route::resource('kandang', KandangController::class);
Route::get('kandang/export/excel', [KandangController::class, 'exportExcel'])->name('kandang.export.excel');
Route::get('kandang/export/pdf', [KandangController::class, 'exportPdf'])->name('kandang.export.pdf');

// Telur CRUD Routes
Route::resource('telur', TelurController::class);

Route::get('managemenpenjualan', function () {
    return view('pages/penjualan/index');
});

Route::get('managemenpengeluaran', function () {
    return view('pages/pengeluaran/index');
});

Route::get('pembukuan', function () {
    return view('pages/pembukuan/index');
});
