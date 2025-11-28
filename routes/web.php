<?php

use Illuminate\Support\Facades\Route;
use resources\views\managementelur\layout;

Route::get('/', function () {
    return view('login');
});

Route::get('register', function () {
    return view('register');
});

Route::get('resetpassword', function () {
    return view('resetpassword');
});

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('managemenkandang', function () {
    return view('managemenkandang');
});

Route::get('managementelur', function () {
    return view('managementelur');
});

Route::get('managemenpenjualan', function () {
    return view('managemenpenjualan');
});

// Route::get('penjualan', function () {
//     return view('penjualan');
// });
Route::get('managemenpengeluaran', function () {
    return view('managemenpengeluaran');
});
