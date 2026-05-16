<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KoordinatorController extends Controller
{
    public function verifikasi()
    {
        $response = Http::get(
            'http://127.0.0.1:5000/api/proposals'
        );
            
        $proposal = $response->json();

        return view('koordinator.verifikasi', compact('proposal'));
    }

    public function setujui(int $id)
    {
        Http::put(
            "http://127.0.0.1:5000/api/proposals/$id",
            [
                'status' => 'approved_koor'
            ]
        );

        return redirect('/koordinator/verifikasi');
    }

    public function tolak(int $id)
    {
        Http::put(
            "http://127.0.0.1:5000/api/proposals/$id",
            [
                'status' => 'rejected'
            ]
        );

        return redirect('/koordinator/verifikasi');
    }

    public function penjadwalan()
    {
        $response = Http::get(
            'http://127.0.0.1:5000/api/proposals'
        );

        $proposal = $response->json();

        return view(
            'koordinator.penjadwalan',
            compact('proposal')
        );
    }

    public function simpanJadwal(Request $request)
    {
        Http::post(
            'http://127.0.0.1:5000/api/penjadwalan',
            [
                'proposal_id' => $request->proposal_id,
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'ruang' => $request->ruang
            ]
        );

        return redirect('/koordinator/penjadwalan');
    }

    public function manajemenDosen()
    {
        $proposalResponse = Http::get(
            'http://127.0.0.1:5000/api/proposals'
        );

        $dosenResponse = Http::get(
            'http://127.0.0.1:5000/api/dosen'
        );

        $proposal = $proposalResponse->json();

        $dosen = $dosenResponse->json();

        return view(
            'koordinator.manajemen-dosen',
            compact('proposal', 'dosen')
        );
    }

    public function assignDosen(Request $request, int $id)
    {
        Http::post(
            "http://127.0.0.1:5000/api/manajemen-dosen/$id",
            [
                'dsn_id' => $request->dsn_id
            ]
        );

        return redirect('/koordinator/manajemen-dosen');
    }
}