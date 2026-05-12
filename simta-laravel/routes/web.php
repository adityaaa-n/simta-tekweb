<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kaprodi/dashboard', function () {
    return view('kaprodi.dashboard');
});