<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function verifikasi()
    {
        $proposal = Proposal::with('mahasiswa')->get();

        return view('koordinator.verifikasi', compact('proposal'));
    }

    public function setujui(int $id)
    {
        $proposal = Proposal::findOrFail($id);

        $proposal->status = 'approved_koor';

        $proposal->save();

        return redirect('/koordinator/verifikasi');
    }

    public function tolak(int $id)
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

    public function manajemenDosen()
    {
        $proposal = Proposal::with('mahasiswa')->get();

        $dosen = User::where('role', 'dsn')->get();

        return view(
            'koordinator.manajemen-dosen',
            compact('proposal', 'dosen')
        );
    }

    public function assignDosen(Request $request, int $id)
    {
        $proposal = Proposal::findOrFail($id);

        $proposal->dsn_id = $request->dsn_id;

        $proposal->save();

        return redirect('/koordinator/manajemen-dosen');
    }
}