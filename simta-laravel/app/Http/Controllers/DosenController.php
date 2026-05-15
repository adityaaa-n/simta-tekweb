<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DosenController extends Controller
{
    // 1. Dashboard Dosen
    public function index()
    {
        $dsn_id = session('user.id', 2); 
        $response = Http::get("http://localhost:5000/api/stats/dosen/{$dsn_id}");
        
        $stats = ['proposal_baru' => 0, 'mahasiswa_bimbingan' => 0, 'jadwal_sidang' => 0];
        if ($response->successful()) {
            $stats = $response->json();
        }

        return view('dosen.dashboard', compact('stats'));
    }

    // 2. Daftar Mahasiswa Bimbingan (HALAMAN BARU)
    public function daftarBimbingan()
    {
        $dsn_id = session('user.id', 2);
        // Memanggil endpoint baru yang sudah menyertakan 'grade_id'
        $response = Http::get("http://localhost:5000/api/proposals/dosen/{$dsn_id}");
        
        $mahasiswa = [];
        if ($response->successful()) {
            $mahasiswa = $response->json();
        }

        return view('dosen.daftar-bimbingan', compact('mahasiswa'));
    }

    // 3. Review Proposal
    public function reviewProposal()
    {
        $response = Http::get('http://localhost:5000/api/proposals');
        $proposals = $response->successful() ? $response->json() : [];
        return view('dosen.review', compact('proposals'));
    }

    // 4. Update Status Proposal
    public function updateStatusProposal(Request $request, $id)
    {
        $status = $request->input('status');
        $response = Http::patch("http://localhost:5000/api/proposals/{$id}/status", ['status' => $status]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Status berhasil diperbarui!');
        }
        return redirect()->back()->with('error', 'Gagal memperbarui status.');
    }

    // 5. Validasi Bimbingan (Hardcode ID 1 untuk testing UI)
    public function validasiBimbingan()
    {
        $response = Http::get('http://localhost:5000/api/guidance-logs/1');
        $logs = $response->successful() ? $response->json() : [];
        return view('dosen.validasi', compact('logs'));
    }

    // 6. ACC Bimbingan
    public function accBimbingan($id)
    {
        $response = Http::patch("http://localhost:5000/api/guidance-logs/{$id}/validate");
        return $response->successful() 
            ? redirect()->back()->with('success', 'Divalidasi!') 
            : redirect()->back()->with('error', 'Gagal!');
    }

    // 7. Form Penilaian TA (Dinamis berdasarkan ID Mahasiswa)
    public function formPenilaian($id)
    {
        // Ambil data spesifik dari daftar proposal
        $response = Http::get('http://localhost:5000/api/proposals');
        $proposal_id = $id;
        $nama_mahasiswa = "Mahasiswa #".$id; // Fallback jika data nama belum join

        if ($response->successful()) {
            foreach ($response->json() as $p) {
                if ($p['id'] == $id) {
                    $nama_mahasiswa = "MHS ID: " . $p['mhs_id'] . " - " . Str::limit($p['judul'], 30);
                    break;
                }
            }
        }

        return view('dosen.penilaian', compact('proposal_id', 'nama_mahasiswa'));
    }

    // 8. Submit Nilai Akhir
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
            ? redirect()->route('dosen.mahasiswa')->with('success', "Nilai tersimpan! Rata-rata: $nilai_angka")
            : redirect()->back()->with('error', 'Gagal simpan nilai.');
    }
}