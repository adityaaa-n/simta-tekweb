<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DosenController;

// ==========================================
// RUTE AUTENTIKASI
// ==========================================
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- CHEAT CODE LOGIN SEMENTARA (Agar gampang ngetes) ---
Route::get('/tes-login/{role}', function ($role) {
    // Tambahkan ID simulasi (Misal ID 2 untuk Dosen, 1 untuk Mahasiswa)
    $id = ($role == 'dsn') ? 2 : 1; 
    
    session(['user' => [
        'id' => $id, 
        'role' => $role
    ]]);
    
    // Auto login auth Laravel untuk mahasiswa jika diperlukan
    if ($role == 'mhs') {
        $user = \App\Models\User::where('role', 'mhs')->first();
        if($user) \Illuminate\Support\Facades\Auth::login($user);
    }
    
    if($role == 'mhs') return redirect('/mahasiswa/dashboard');
    if($role == 'dsn') return redirect('/dosen/dashboard');
    if($role == 'koor') return redirect('/koordinator/dashboard');
    if($role == 'admin') return redirect('/admin/dashboard');
    if($role == 'kaprodi') return redirect('/kaprodi/dashboard');
    return redirect('/login');
});
// --------------------------------------------------------

Route::get('/dashboard/not-ready', function (\Illuminate\Http\Request $request) {
    return view('dashboard_not_ready', ['role' => $request->query('role')]);
})->name('dashboard.not_ready');


// ==========================================
// 1. ZONA MAHASISWA
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/mahasiswa/pengajuan', function () {
        $dosens = [];
        $dosenRes = \Illuminate\Support\Facades\Http::get('http://localhost:5000/api/dosen');
        if ($dosenRes->successful()) {
            $dosens = json_decode(json_encode($dosenRes->json()));
        }
        return view('mahasiswa.pengajuan', compact('dosens'));
    })->name('mahasiswa.pengajuan');

    Route::post('/mahasiswa/pengajuan', [\App\Http\Controllers\PengajuanController::class, 'store'])->name('mahasiswa.pengajuan.store');

    Route::get('/mahasiswa/monitoring', function () {
        $mhs_id = session('user.id', 1);
        $proposalsRes = \Illuminate\Support\Facades\Http::get('http://localhost:5000/api/proposals');
        $proposal = null;
        if ($proposalsRes->successful()) {
            foreach($proposalsRes->json() as $p) {
                if(isset($p['mhs_id']) && $p['mhs_id'] == $mhs_id) {
                    $proposal = $p; break;
                }
            }
        }

        $bimbinganCount = 0;
        $schedule = null;

        if ($proposal) {
            $logsRes = \Illuminate\Support\Facades\Http::get("http://localhost:5000/api/guidance-logs/{$proposal['id']}");
            if ($logsRes->successful()) {
                $bimbinganCount = count($logsRes->json());
            }

            $schRes = \Illuminate\Support\Facades\Http::get("http://localhost:5000/api/schedules/{$proposal['id']}");
            if ($schRes->successful() && count($schRes->json()) > 0) {
                $schedule = $schRes->json()[0];
            }
        }

        return view('mahasiswa.monitoring', compact('proposal', 'bimbinganCount', 'schedule'));
    })->name('mahasiswa.monitoring');

    Route::get('/mahasiswa/bimbingan', function () {
        $mhs_id = session('user.id', 1);
        $proposalsRes = \Illuminate\Support\Facades\Http::get('http://localhost:5000/api/proposals');
        $proposal_id = null;
        if ($proposalsRes->successful()) {
            foreach($proposalsRes->json() as $p) {
                if(isset($p['mhs_id']) && $p['mhs_id'] == $mhs_id) {
                    $proposal_id = $p['id']; break;
                }
            }
        }
        
        $bimbingans = [];
        if ($proposal_id) {
            $res = \Illuminate\Support\Facades\Http::get("http://localhost:5000/api/guidance-logs/{$proposal_id}");
            if ($res->successful()) {
                $bimbingans = $res->json();
            }
        }
        $bimbingans = json_decode(json_encode($bimbingans));
        return view('mahasiswa.bimbingan', compact('bimbingans'));
    })->name('mahasiswa.bimbingan');

    Route::post('/mahasiswa/bimbingan', [\App\Http\Controllers\BimbinganController::class, 'store'])->name('mahasiswa.bimbingan.store');

    Route::get('/mahasiswa/seminar', function () {
        $mhs_id = session('user.id', 1);
        $proposalsRes = \Illuminate\Support\Facades\Http::get('http://localhost:5000/api/proposals');
        $proposal_id = null;
        if ($proposalsRes->successful()) {
            foreach($proposalsRes->json() as $p) {
                if(isset($p['mhs_id']) && $p['mhs_id'] == $mhs_id) {
                    $proposal_id = $p['id']; break;
                }
            }
        }

        $seminars = [];
        if ($proposal_id) {
            $schRes = \Illuminate\Support\Facades\Http::get("http://localhost:5000/api/schedules/{$proposal_id}");
            if ($schRes->successful()) {
                $seminars = json_decode(json_encode($schRes->json()));
            }
        }
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
});

// ==========================================
// 2. ZONA DOSEN 
// ==========================================
Route::middleware(['role:dsn'])->group(function () {
    Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
    Route::get('/dosen/review', [DosenController::class, 'reviewProposal'])->name('dosen.review');
    Route::post('/dosen/review/{id}', [DosenController::class, 'updateStatusProposal'])->name('dosen.update_proposal');
    Route::get('/dosen/validasi', [DosenController::class, 'validasiBimbingan'])->name('dosen.validasi');
    Route::post('/dosen/validasi/{id}', [DosenController::class, 'accBimbingan'])->name('dosen.acc_bimbingan');
    Route::get('/dosen/mahasiswa', [DosenController::class, 'daftarBimbingan'])->name('dosen.mahasiswa');
    Route::get('/dosen/penilaian/{id}', [DosenController::class, 'formPenilaian'])->name('dosen.penilaian');
    Route::post('/dosen/penilaian', [DosenController::class, 'submitNilai'])->name('dosen.submit_nilai');
});

// ==========================================
// 3. ZONA ADMIN
// ==========================================
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/verifikasi', [AdminController::class, 'verifikasi']);
Route::get('/admin/verifikasi/setujui/{id}', [AdminController::class, 'setujui']);
Route::get('/admin/verifikasi/tolak/{id}', [AdminController::class, 'tolak']);


// ==========================================
// 4. ZONA KAPRODI
// ==========================================
Route::get('/kaprodi/dashboard', [KaprodiController::class, 'dashboard']);
Route::get('/kaprodi/statistik', [KaprodiController::class, 'statistik']);


// ==========================================
// 5. ZONA KOORDINATOR
// ==========================================
Route::get('/koordinator/dashboard', function () {
    return view('koordinator.dashboard');
});
Route::get('/koordinator/verifikasi', [KoordinatorController::class, 'verifikasi']);
Route::get('/koordinator/verifikasi/setujui/{id}', [KoordinatorController::class, 'setujui']);
Route::get('/koordinator/verifikasi/tolak/{id}', [KoordinatorController::class, 'tolak']);
Route::get('/koordinator/penjadwalan', [KoordinatorController::class, 'penjadwalan']);
Route::post('/koordinator/penjadwalan/simpan', [KoordinatorController::class, 'simpanJadwal']);
Route::get('/koordinator/manajemen-dosen', [KoordinatorController::class, 'manajemenDosen']);
Route::post('/koordinator/manajemen-dosen/assign/{id}', [KoordinatorController::class, 'assignDosen']);

