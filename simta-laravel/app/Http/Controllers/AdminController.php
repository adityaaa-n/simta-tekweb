<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function dashboard()
    {
        $response = Http::get(
            'http://127.0.0.1:5000/api/admin/verifikasi'
        );

        $proposal = $response->json();

        return view(
            'admin.dashboard',
            compact('proposal')
        );
    }
}