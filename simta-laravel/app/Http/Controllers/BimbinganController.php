<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bimbingan;

class BimbinganController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
        ]);

        Bimbingan::create([
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Log bimbingan berhasil disimpan!');
    }
}
