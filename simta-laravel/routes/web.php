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
        $dosens = \App\Models\User::where('role', 'dsn')->get();
        return view('mahasiswa.pengajuan', compact('dosens'));
    })->name('mahasiswa.pengajuan');

    Route::post('/mahasiswa/pengajuan', [\App\Http\Controllers\PengajuanController::class, 'store'])->name('mahasiswa.pengajuan.store');

    Route::get('/mahasiswa/monitoring', function () {
        return view('mahasiswa.monitoring');
    })->name('mahasiswa.monitoring');

    Route::get('/mahasiswa/bimbingan', function () {
        $bimbingans = \App\Models\Bimbingan::orderBy('tanggal', 'desc')->get();
        return view('mahasiswa.bimbingan', compact('bimbingans'));
    })->name('mahasiswa.bimbingan');

    Route::post('/mahasiswa/bimbingan', [\App\Http\Controllers\BimbinganController::class, 'store'])->name('mahasiswa.bimbingan.store');

    Route::get('/dashboard/not-ready', function (\Illuminate\Http\Request $request) {
        return view('dashboard_not_ready', ['role' => $request->query('role')]);
    })->name('dashboard.not_ready');
});

