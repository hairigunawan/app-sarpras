<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // --- Metode untuk Login Admin (Password) ---

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
            $user = Auth::user();

            // PENTING: Cek apakah pengguna memiliki role admin
            if (!$user->role || $user->role->name !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Hanya admin yang dapat login melalui halaman ini.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang diberikan salah.',
        ])->onlyInput('email');
    }

    // --- Metode untuk Login Pengguna (SSO Google) ---

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari atau buat user
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Jika user baru, buat dengan role default (free_user)
                $freeUserRole = Role::where('name', 'free_user')->first();

                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role_id' => $freeUserRole ? $freeUserRole->id : null,
                    'password' => null, // Password null untuk user Google
                ]);
            } else {
                // Update user yang sudah ada
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'name' => $googleUser->getName(),
                ]);
            }

            Auth::login($user);

            // Redirect berdasarkan role
            if ($user->role && $user->role->name === 'admin') {
                return redirect('/dashboard');
            } else {
                // Untuk user biasa, redirect ke halaman yang sesuai
                return redirect('/user/dashboard'); // Ganti dengan route user biasa
            }

        } catch (\Exception $e) {
            Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }

    // --- Metode untuk Logout ---

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
