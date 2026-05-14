<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/mahasiswa/pengajuan', function () {
        return view('mahasiswa.pengajuan');
    })->name('mahasiswa.pengajuan');

    Route::get('/mahasiswa/monitoring', function () {
        return view('mahasiswa.monitoring');
    })->name('mahasiswa.monitoring');

    Route::get('/mahasiswa/bimbingan', function () {
        return view('mahasiswa.bimbingan');
    })->name('mahasiswa.bimbingan');

    Route::get('/mahasiswa/seminar', function () {
        return view('mahasiswa.jadwal_seminar');
    })->name('mahasiswa.seminar');

    Route::get('/mahasiswa/daftar-ujian', function () {
        return view('mahasiswa.daftar_ujian');
    })->name('mahasiswa.daftar_ujian');

    Route::get('/mahasiswa/unggah-dokumen', function () {
        return view('mahasiswa.unggah_dokumen');
    })->name('mahasiswa.unggah_dokumen');

    Route::get('/dashboard/not-ready', function (\Illuminate\Http\Request $request) {
        return view('dashboard_not_ready', ['role' => $request->query('role')]);
    })->name('dashboard.not_ready');
});

