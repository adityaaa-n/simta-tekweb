<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoordinatorController;


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

Route::get('/koordinator/manajemen-dosen',
    [KoordinatorController::class, 'manajemenDosen']
);

Route::post('/koordinator/manajemen-dosen/assign/{id}',
    [KoordinatorController::class, 'assignDosen']
);

Route::get('/koordinator/verifikasi/setujui/{id}',
    [KoordinatorController::class, 'setujui']
);

Route::get('/koordinator/verifikasi/tolak/{id}',
    [KoordinatorController::class, 'tolak']
);

Route::get('/koordinator/manajemen-dosen',
    [KoordinatorController::class, 'manajemenDosen']
);

Route::post('/koordinator/manajemen-dosen/{id}',
    [KoordinatorController::class, 'assignDosen']
);
