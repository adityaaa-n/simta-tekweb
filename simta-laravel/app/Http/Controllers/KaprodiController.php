<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KaprodiController extends Controller
{
    public function dashboard()
    {
        $response = Http::get(
            'http://127.0.0.1:5000/api/kaprodi/stats'
        );

        $stats = $response->json();

        return view('kaprodi.dashboard', compact('stats'));
    }
    public function statistik()
    {
        $response = Http::get(
            'http://127.0.0.1:5000/api/kaprodi/stats'
        );
    
        $stats = $response->json();
    
        return view('kaprodi.statistik',
            compact('stats')
        );
    }
}
