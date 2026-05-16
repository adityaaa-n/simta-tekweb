<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\AdminController;


// Route Default
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/admin/dashboard',
    [AdminController::class, 'dashboard']
);

Route::get(
    '/admin/verifikasi/setujui/{id}',
    [AdminController::class, 'setujui']
);

Route::get(
    '/admin/verifikasi/tolak/{id}',
    [AdminController::class, 'tolak']
);

Route::get('/admin/verifikasi',
    [AdminController::class, 'verifikasi']
);
Route::get('/kaprodi/dashboard',
    [KaprodiController::class, 'dashboard']
);

Route::get('/kaprodi/statistik',
    [KaprodiController::class, 'statistik']
);