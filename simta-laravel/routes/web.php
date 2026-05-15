<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaprodiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kaprodi/dashboard',
    [KaprodiController::class, 'dashboard']
);

Route::get('/kaprodi/statistik',
    [KaprodiController::class, 'statistik']
);