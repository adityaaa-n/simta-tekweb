<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_harapan' => 'required|date',
        ]);

        DB::table('ujians')->insert([
            'tanggal_diinginkan' => $request->tanggal_harapan,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return redirect()->back()->with('success', 'Pendaftaran ujian TA berhasil diajukan!');
    }
}
