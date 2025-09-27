<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login DAN
        // 2. Cek apakah role pengguna adalah 'admin'
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin') {
            // Jika ya, lanjutkan ke halaman yang dituju
            return $next($request);
        }

        // Jika tidak, tolak akses
        abort(403, 'ANDA TIDAK MEMILIKI AKSES ADMIN.');
    }
}

