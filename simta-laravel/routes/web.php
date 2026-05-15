<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
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