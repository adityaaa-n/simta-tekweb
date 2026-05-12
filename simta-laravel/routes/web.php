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

Route::get('/koordinator/penjadwalan', function () {
    return view('koordinator.penjadwalan');
});

Route::get('/koordinator/manajemen-dosen', function () {
    return view('koordinator.manajemen-dosen');
});