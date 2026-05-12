<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/koordinator', function () {
    return view('koordinator.dashboard');
});

Route::get('/koordinator/penjadwalan', function () {
    return view('koordinator.penjadwalan');
});

Route::get('/koordinator/manajemen-dosen', function () {
    return view('koordinator.manajemen-dosen');
});

Route::get('/koordinator/verifikasi', function () {
    return 'Halaman Verifikasi Proposal';
});