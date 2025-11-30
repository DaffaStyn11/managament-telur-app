<?php

use Illuminate\Support\Facades\Route;
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

Route::get('managemenkandang', function () {
    return view('pages/kandang/index');
});

Route::get('managementelur', function () {
    return view('pages/telur/index');
});

Route::get('managemenpenjualan', function () {
    return view('pages/penjualan/index');
});

Route::get('managemenpengeluaran', function () {
    return view('pages/pengeluaran/index');
});

Route::get('pembukuan', function () {
    return view('pages/pembukuan/index');
});
