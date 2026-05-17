<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UjianController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_harapan' => 'required|date',
        ]);

        $mhs_id = session('user.id', 1);
        
        // Cari proposal_id mahasiswa ini dari API
        $proposalsRes = Http::get('http://localhost:5000/api/proposals');
        $proposal_id = null;
        if ($proposalsRes->successful()) {
            foreach($proposalsRes->json() as $p) {
                if(isset($p['mhs_id']) && $p['mhs_id'] == $mhs_id) {
                    $proposal_id = $p['id'];
                    break;
                }
            }
        }

        if (!$proposal_id) {
            return redirect()->back()->with('error', 'Anda belum memiliki proposal TA yang aktif.');
        }

        $response = Http::post('http://localhost:5000/api/exam-registration', [
            'proposal_id' => $proposal_id,
            'tanggal_harapan' => $request->tanggal_harapan,
            'keterangan' => 'Pengajuan ujian dari sistem.' 
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pendaftaran ujian TA berhasil diajukan!');
        } else {
            return redirect()->back()->with('error', 'Gagal mendaftar ujian ke server API.');
        }
    }
}
