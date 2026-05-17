<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dsn_id' => 'required|integer',
        ]);

        $mhs_id = session('user.id', 1);

        $response = Http::post('http://localhost:5000/api/proposals', [
            'mhs_id' => $mhs_id,
            'dsn_id' => $request->dsn_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pengajuan berhasil disubmit!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim pengajuan ke server API.');
        }
    }
}
