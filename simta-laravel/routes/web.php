<?php

use Illuminate\Support\Facades\Route;

// Rute Default: Arahkan langsung ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Rute Login (Bisa diakses siapa saja / tanpa middleware role)
Route::get('/login', function () {
    return view('welcome'); // Nanti diganti dengan view login aslimu
})->name('login');

// ==========================================
// 🛡️ ZONA TERPROTEKSI OLEH MIDDLEWARE 'role'
// ==========================================

// 1. ZONA MAHASISWA
Route::middleware(['role:mhs'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return "Ini halaman Dashboard Mahasiswa";
    });
    // Nanti rute mahasiswa lainnya taruh di dalam sini...
});

// 2. ZONA DOSEN
Route::middleware(['role:dsn'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return "Ini halaman Dashboard Dosen";
    });
});

// 3. ZONA KOORDINATOR
Route::middleware(['role:koor'])->group(function () {
    Route::get('/koor/dashboard', function () {
        return "Ini halaman Dashboard Koordinator";
    });
});

// 4. ZONA ADMIN
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "Ini halaman Dashboard Admin";
    });
});

// 5. ZONA KAPRODI
Route::middleware(['role:kaprodi'])->group(function () {
    Route::get('/kaprodi/dashboard', function () {
        return "Ini halaman Dashboard Kaprodi";
    });
});