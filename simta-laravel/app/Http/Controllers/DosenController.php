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
}