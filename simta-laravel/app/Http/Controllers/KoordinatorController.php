<?php

namespace App\Http\Controllers;

use App\Models\Proposal;

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
}