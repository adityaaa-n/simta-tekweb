<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosen_pembimbing' => 'required|string',
        ]);

        Pengajuan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'dosen_pembimbing' => $request->dosen_pembimbing,
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil disubmit!');
    }
}
