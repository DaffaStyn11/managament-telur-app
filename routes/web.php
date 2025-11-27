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

Route::get('create-kandang', function () {
    return view('managementtelur.createkandang', [
        'title' => 'Tambah Kandang Baru'
    ]);
});


Route::get('dashboard', function () {
    return view('dashboard');
});
