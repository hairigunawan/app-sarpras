<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            // PENTING: Cek apakah pengguna adalah admin
            if (Auth::user()->role !== 'admin') {
                Auth::logout(); // Jika bukan admin, paksa logout
                return back()->withErrors([
                    'email' => 'Hanya admin yang dapat login melalui halaman ini.',
                ]);
            }

            $request->session()->regenerate();
            // ===== UBAH BAGIAN INI =====
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

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    // 'role' tidak diatur di sini, default-nya akan 'free_user'
                ]
            );

            Auth::login($user);

            // ===== UBAH BAGIAN INI =====
            return redirect('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }

    // --- Metode untuk Logout ---

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/dashboard');
    }
}

