<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;
            
            // Simpan data di session agar bisa dipakai secara universal
            session(['user' => [
                'id' => Auth::id(), 
                'role' => $role
            ]]);

            if ($role === 'mahasiswa' || $role === 'mhs') {
                return redirect()->route('mahasiswa.dashboard');
            } elseif ($role === 'dosen' || $role === 'dsn') {
                return redirect()->route('dosen.dashboard');
            } elseif ($role === 'koordinator' || $role === 'koor') {
                return redirect('/koordinator/dashboard');
            } elseif ($role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($role === 'kaprodi') {
                return redirect('/kaprodi/dashboard');
            }

            // Jika role tidak dikenali
            return redirect()->route('dashboard.not_ready', ['role' => $role]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
