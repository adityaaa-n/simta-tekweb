<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;

// Rute Default: Arahkan langsung ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Rute Login (Bisa diakses siapa saja / tanpa middleware role)
Route::get('/login', function () {
    return view('welcome'); // Nanti diganti dengan view login aslimu
})->name('login');

// --- CHEAT CODE LOGIN SEMENTARA (Agar gampang ngetes) ---
Route::get('/tes-login/{role}', function ($role) {
    // Tambahkan ID simulasi (Misal ID 2 untuk Dosen, 1 untuk Mahasiswa)
    $id = ($role == 'dsn') ? 2 : 1; 
    
    session(['user' => [
        'id' => $id, 
        'role' => $role
    ]]);
    
    if($role == 'mhs') return redirect('/mahasiswa/dashboard');
    if($role == 'dsn') return redirect('/dosen/dashboard');
    if($role == 'koor') return redirect('/koor/dashboard');
    if($role == 'admin') return redirect('/admin/dashboard');
    if($role == 'kaprodi') return redirect('/kaprodi/dashboard');
    return redirect('/login');
});

Route::get('/logout', function () {
    session()->forget('user');
    return redirect('/login');
});
// --------------------------------------------------------


// ==========================================
// 🛡️ ZONA TERPROTEKSI OLEH MIDDLEWARE 'role'
// ==========================================

// 1. ZONA MAHASISWA
Route::middleware(['role:mhs'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('dashboard');
    });
});

// 2. ZONA DOSEN 
Route::middleware(['role:dsn'])->group(function () {
    Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
    Route::get('/dosen/review', [DosenController::class, 'reviewProposal'])->name('dosen.review');
    Route::post('/dosen/review/{id}', [DosenController::class, 'updateStatusProposal'])->name('dosen.update_proposal');
    
    Route::get('/dosen/validasi', [DosenController::class, 'validasiBimbingan'])->name('dosen.validasi');
    Route::post('/dosen/validasi/{id}', [DosenController::class, 'accBimbingan'])->name('dosen.acc_bimbingan');
    
    // --- FITUR BARU: Daftar Mahasiswa Bimbingan ---
    Route::get('/dosen/mahasiswa', [DosenController::class, 'daftarBimbingan'])->name('dosen.mahasiswa');
    
    // --- PERBAIKAN: Form Penilaian menerima parameter {id} ---
    Route::get('/dosen/penilaian/{id}', [DosenController::class, 'formPenilaian'])->name('dosen.penilaian');
    Route::post('/dosen/penilaian', [DosenController::class, 'submitNilai'])->name('dosen.submit_nilai');
});

// 3. ZONA KOORDINATOR
Route::middleware(['role:koor'])->group(function () {
    Route::get('/koor/dashboard', function () {
        return view('dashboard');
    });
});

// 4. ZONA ADMIN
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    });
});

// 5. ZONA KAPRODI
Route::middleware(['role:kaprodi'])->group(function () {
    Route::get('/kaprodi/dashboard', function () {
        return view('dashboard');
    });
});