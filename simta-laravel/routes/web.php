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