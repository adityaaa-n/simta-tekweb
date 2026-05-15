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

    Route::get('/mahasiswa/seminar', function () {
        $seminars = \Illuminate\Support\Facades\DB::table('schedules')
            ->join('proposals', 'schedules.proposal_id', '=', 'proposals.id')
            ->select('schedules.tanggal', 'schedules.waktu', 'schedules.ruang', 'proposals.status')
            ->orderBy('schedules.tanggal', 'asc')
            ->get();
        return view('mahasiswa.jadwal_seminar', compact('seminars'));
    })->name('mahasiswa.seminar');

    Route::get('/mahasiswa/daftar-ujian', function () {
        return view('mahasiswa.daftar_ujian');
    })->name('mahasiswa.daftar_ujian');

    Route::post('/mahasiswa/daftar-ujian', [\App\Http\Controllers\UjianController::class, 'store'])->name('mahasiswa.daftar_ujian.store');

    Route::get('/mahasiswa/unggah-dokumen', function () {
        return view('mahasiswa.unggah_dokumen');
    })->name('mahasiswa.unggah_dokumen');

    Route::post('/mahasiswa/unggah-dokumen', [\App\Http\Controllers\DokumenController::class, 'store'])->name('mahasiswa.unggah_dokumen.store');

    Route::post('/mahasiswa/bimbingan', [\App\Http\Controllers\BimbinganController::class, 'store'])->name('mahasiswa.bimbingan.store');

    Route::get('/dashboard/not-ready', function (\Illuminate\Http\Request $request) {
        return view('dashboard_not_ready', ['role' => $request->query('role')]);
    })->name('dashboard.not_ready');
});

