<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;

class DokumenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file_dokumen' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $path = $file->store('dokumen_akhir', 'public');
            
            Dokumen::create([
                'file_path' => $path
            ]);

            return redirect()->back()->with('success', 'Dokumen akhir berhasil diunggah dan disimpan!');
        }

        return redirect()->back()->withErrors('Gagal mengunggah dokumen.');
    }
}
