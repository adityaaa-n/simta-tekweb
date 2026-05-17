<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DokumenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file_dokumen' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            
            // Simpan file ke server Express
            $response = Http::attach(
                'dokumen_pdf', file_get_contents($file), $file->getClientOriginalName()
            )->post('http://localhost:5000/api/documents/upload');
            
            if ($response->successful()) {
                $mhs_id = session('user.id', 1);
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

                if ($proposal_id) {
                    $jsonRes = $response->json();
                    $file_path = $jsonRes['file_path'] ?? '/uploads/' . $file->getClientOriginalName();
                    
                    Http::post('http://localhost:5000/api/documents', [
                        'proposal_id' => $proposal_id,
                        'file_path' => $file_path
                    ]);
                }

                return redirect()->back()->with('success', 'Dokumen akhir berhasil diunggah dan disimpan di server API!');
            } else {
                return redirect()->back()->with('error', 'Gagal mengunggah dokumen fisik ke server API.');
            }
        }

        return redirect()->back()->withErrors('Gagal mengunggah dokumen.');
    }
}
