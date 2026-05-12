<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/koordinator/dashboard', function () {
    return view('koordinator.dashboard');
});

Route::get('/koordinator/verifikasi', function () {
    return view('koordinator.verifikasi');
});