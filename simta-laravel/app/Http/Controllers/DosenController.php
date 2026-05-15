<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DosenController extends Controller
{
    /**
     * 1. Dashboard Dosen
     */
    public function index()
    {
        $dsn_id = session('user.id', 2); 
        $response = Http::get("http://localhost:5000/api/stats/dosen/{$dsn_id}");
        
        $stats = $response->successful() 
            ? $response->json() 
            : ['proposal_baru' => 0, 'mahasiswa_bimbingan' => 0, 'jadwal_sidang' => 0];

        return view('dosen.dashboard', compact('stats'));
    }

    /**
     * 2. Daftar Mahasiswa Bimbingan (Halaman Penilaian TA)
     */
    public function daftarBimbingan()
    {
        $dsn_id = session('user.id', 2);
        $response = Http::get("http://localhost:5000/api/proposals/dosen/{$dsn_id}");
        
        $mahasiswa = $response->successful() ? $response->json() : [];

        return view('dosen.daftar-bimbingan', compact('mahasiswa'));
    }

    /**
     * 3. Review Proposal
     * (SEKARANG SUDAH DINAMIS PER DOSEN)
     */
    public function reviewProposal()
    {
        $dsn_id = session('user.id', 2);
        
        // Tembak API baru yang sudah di filter berdasarkan dsn_id
        $response = Http::get("http://localhost:5000/api/proposals/review/dosen/{$dsn_id}");
        
        $proposals = $response->successful() ? $response->json() : [];
        
        return view('dosen.review', compact('proposals'));
    }

    /**
     * 4. Update Status Proposal
     */
    public function updateStatusProposal(Request $request, $id)
    {
        $response = Http::patch("http://localhost:5000/api/proposals/{$id}/status", [
            'status' => $request->status
        ]);
        
        return redirect()->back()->with(
            $response->successful() ? 'success' : 'error', 
            'Pembaruan status proposal berhasil diproses.'
        );
    }

    /**
     * 5. Validasi Bimbingan
     */
    public function validasiBimbingan()
    {
        $dsn_id = session('user.id', 2); 
        $response = Http::get("http://localhost:5000/api/guidance-logs/dosen/{$dsn_id}");
        
        $logs = $response->successful() ? $response->json() : [];

        return view('dosen.validasi', compact('logs'));
    }

    /**
     * 6. ACC Log Bimbingan
     */
    public function accBimbingan($id)
    {
        $response = Http::patch("http://localhost:5000/api/guidance-logs/{$id}/validate");
        
        return redirect()->back()->with(
            $response->successful() ? 'success' : 'error', 
            'Validasi log bimbingan berhasil diperbarui.'
        );
    }

    /**
     * 7. Form Penilaian TA
     */
    public function formPenilaian($id)
    {
        $response = Http::get('http://localhost:5000/api/proposals');
        $proposal_id = $id;
        $nama_mahasiswa = "Mahasiswa #" . $id;

        if ($response->successful()) {
            foreach ($response->json() as $p) {
                if ($p['id'] == $id) {
                    $nama_mahasiswa = "MHS ID: " . $p['mhs_id'] . " - " . Str::limit($p['judul'], 40);
                    break;
                }
            }
        }
        
        return view('dosen.penilaian', compact('proposal_id', 'nama_mahasiswa'));
    }

    /**
     * 8. Submit Nilai Akhir
     */
    public function submitNilai(Request $request)
    {
        $nilai_angka = ($request->nilai_seminar + $request->nilai_ujian) / 2;
        
        if ($nilai_angka >= 80) $huruf = 'A';
        elseif ($nilai_angka >= 70) $huruf = 'B';
        elseif ($nilai_angka >= 60) $huruf = 'C';
        else $huruf = 'D';

        $response = Http::post("http://localhost:5000/api/grades", [
            'proposal_id' => $request->proposal_id,
            'nilai_angka' => $nilai_angka,
            'nilai_huruf' => $huruf,
            'komentar' => $request->komentar
        ]);

        return $response->successful() 
            ? redirect()->route('dosen.mahasiswa')->with('success', "Penilaian berhasil disimpan! Rata-rata: $nilai_angka")
            : redirect()->back()->with('error', 'Gagal menyimpan penilaian ke sistem.');
    }
}