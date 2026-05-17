<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login (datanya ada di session)
        // Kita asumsikan saat login, data user disimpan di session dengan key 'user'
        if (!session()->has('user')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $user = session('user');

        // 2. Cek apakah role user ada di dalam daftar role yang diizinkan
        // Parameter ...$roles akan menangkap semua input role dari route
        if (!in_array($user['role'], $roles)) {
            // Jika user mencoba akses yang bukan porsinya, kembalikan ke dashboard masing-masing
            return redirect('/' . $user['role'] . '/dashboard')
                ->with('error', 'Kamu tidak punya akses ke halaman tersebut!');
        }

        return $next($request);
    }
}