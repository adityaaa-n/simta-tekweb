<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function verifikasi()
    {
        $response = Http::get(
            'http://127.0.0.1:5000/api/admin/verifikasi'
        );

        $proposal = $response->json();

        return view(
            'admin.verifikasi',
            compact('proposal')
        );
    }

    public function setujui($id)
    {
        Http::put(
            "http://127.0.0.1:5000/api/admin/verifikasi/setujui/$id"
        );

        return redirect('/admin/verifikasi');
    }

    public function tolak($id)
    {
        Http::put(
            "http://127.0.0.1:5000/api/admin/verifikasi/tolak/$id"
        );

        return redirect('/admin/verifikasi');
    }
}