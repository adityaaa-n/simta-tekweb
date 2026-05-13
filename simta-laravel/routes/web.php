<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KoordinatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/koordinator/dashboard', function () {
    return view('koordinator.dashboard');
});

Route::get('/koordinator/verifikasi',
    [KoordinatorController::class, 'verifikasi']
);

Route::get('/koordinator/penjadwalan',
    [KoordinatorController::class, 'penjadwalan']
);

Route::post('/koordinator/penjadwalan/simpan',
    [KoordinatorController::class, 'simpanJadwal']
);

Route::get('/koordinator/manajemen-dosen', function () {
    return view('koordinator.manajemen-dosen');
});

Route::get(
    '/koordinator/verifikasi/setujui/{id}',
    [KoordinatorController::class, 'setujui']
);

Route::get(
    '/koordinator/verifikasi/tolak/{id}',
    [KoordinatorController::class, 'tolak']
);