<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Schedule;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function verifikasi()
    {
        $proposal = Proposal::with('mahasiswa')->get();

        return view('koordinator.verifikasi', compact('proposal'));
    }

    public function setujui($id)
    {
        $proposal = Proposal::findOrFail($id);

        $proposal->status = 'approved_koor';

        $proposal->save();

        return redirect('/koordinator/verifikasi');
    }

    public function tolak($id)
    {
        $proposal = Proposal::findOrFail($id);

        $proposal->status = 'rejected';

        $proposal->save();

        return redirect('/koordinator/verifikasi');
    }

    public function penjadwalan()
    {
        $proposal = Proposal::all();

        return view('koordinator.penjadwalan', compact('proposal'));
    }

    public function simpanJadwal(Request $request)
    {
        Schedule::create([
            'proposal_id' => $request->proposal_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'ruang' => $request->ruang
        ]);

        return redirect('/koordinator/penjadwalan');
    }
}