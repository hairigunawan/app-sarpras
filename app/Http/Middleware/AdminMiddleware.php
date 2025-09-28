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
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah user memiliki role DAN role-nya adalah 'admin'
        $user = Auth::user();

        // Debug: tambahkan ini untuk melihat data user
        // \Log::info('User Data:', [
        //     'user_id' => $user->id,
        //     'role_id' => $user->role_id,
        //     'role' => $user->role ? $user->role->name : 'null'
        // ]);

        if ($user->role && $user->role->name === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, tolak akses
        Auth::logout(); // Logout user non-admin
        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses admin.');
    }
}
