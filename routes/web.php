<?php

use Illuminate\Support\Facades\Route;

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
