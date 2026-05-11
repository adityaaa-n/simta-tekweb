<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Untuk tembak API Node.js

class DosenController extends Controller
{
    // 1. Menampilkan halaman Dashboard
    public function index()
    {
        return view('dosen.dashboard');
    }

    // 2. Menampilkan halaman Review Proposal
    public function reviewProposal()
    {
        // Tembak API Node.js untuk ambil semua proposal
        $response = Http::get('http://localhost:5000/api/proposals');
        
        $proposals = [];
        if ($response->successful()) {
            $proposals = $response->json();
        }

        return view('dosen.review', compact('proposals'));
    }

    // 3. Fungsi untuk Setujui / Tolak Proposal
    public function updateStatusProposal(Request $request, $id)
    {
        $status = $request->input('status'); // 'approved_koor' atau 'ditolak'

        // Tembak API Node.js (PATCH)
        $response = Http::patch("http://localhost:5000/api/proposals/{$id}/status", [
            'status' => $status
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Status proposal berhasil diupdate!');
        }

        return redirect()->back()->with('error', 'Gagal mengupdate status proposal.');
    }

    // 4. Menampilkan halaman Validasi Bimbingan
    public function validasiBimbingan()
    {
        // Catatan: Di API Node.js kita, endpoint ini butuh parameter proposal_id.
        // Untuk keperluan testing UI ini, kita *hardcode* tarik data dari proposal_id = 1.
        $response = Http::get('http://localhost:5000/api/guidance-logs/1');
        
        $logs = [];
        if ($response->successful()) {
            $logs = $response->json();
        }

        return view('dosen.validasi', compact('logs'));
    }

    // 5. Fungsi untuk ACC/Validasi Bimbingan
    public function accBimbingan($id)
    {
        // Tembak API Node.js (PATCH)
        $response = Http::patch("http://localhost:5000/api/guidance-logs/{$id}/validate");

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Log bimbingan berhasil divalidasi!');
        }

        return redirect()->back()->with('error', 'Gagal memvalidasi bimbingan.');
    }

    // 6. Menampilkan Form Penilaian TA
    public function formPenilaian()
    {
        // Hardcode ID Proposal dan Nama Mahasiswa untuk keperluan testing UI
        $proposal_id = 1;
        $nama_mahasiswa = "Nabil Fauzi Seff"; 

        return view('dosen.penilaian', compact('proposal_id', 'nama_mahasiswa'));
    }

    // 7. Submit Nilai ke Node.js API
    public function submitNilai(Request $request)
    {
        $proposal_id = $request->input('proposal_id');
        $nilai_seminar = $request->input('nilai_seminar');
        $nilai_ujian = $request->input('nilai_ujian');
        $komentar = $request->input('komentar');

        // Hitung rata-rata untuk mendapatkan nilai akhir (angka)
        $nilai_angka = ($nilai_seminar + $nilai_ujian) / 2;

        // Konversi nilai angka menjadi huruf
        if ($nilai_angka >= 80) $nilai_huruf = 'A';
        elseif ($nilai_angka >= 70) $nilai_huruf = 'B';
        elseif ($nilai_angka >= 60) $nilai_huruf = 'C';
        elseif ($nilai_angka >= 50) $nilai_huruf = 'D';
        else $nilai_huruf = 'E';

        // Tembak API Node.js (Metode POST)
        $response = Http::post("http://localhost:5000/api/grades", [
            'proposal_id' => $proposal_id,
            'nilai_angka' => $nilai_angka,
            'nilai_huruf' => $nilai_huruf,
            'komentar' => $komentar
        ]);

        if ($response->successful()) {
            return redirect()->route('dosen.dashboard')->with('success', "Nilai berhasil disimpan! Rata-rata: $nilai_angka (Kategori: $nilai_huruf)");
        }

        return redirect()->back()->with('error', 'Gagal menyimpan nilai ke sistem.');
    }
}