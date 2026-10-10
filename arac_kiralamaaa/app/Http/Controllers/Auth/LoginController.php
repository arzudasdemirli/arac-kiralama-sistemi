<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Giriş formunu gösterir
     */
    public function showLoginForm()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    /**
     * Giriş işlemini yapar
     */
    public function login(Request $request)
    {
        // Giriş bilgilerini doğrula
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Giriş başarılıysa
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Rol kontrolü yap ve yönlendir
            if ($user->role === 'yonetici') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'kullanici') {
                return redirect()->route('user.home');
            }

            // Tanımlı olmayan bir role sahipse çıkış yap
            Auth::logout();
            return redirect('/login')->withErrors([
                'email' => 'Rol tanımsız. Lütfen yöneticiye başvurun.',
            ]);
        }

        // Giriş başarısızsa
        throw ValidationException::withMessages([
            'email' => 'Girdiğiniz bilgiler hatalı.',
        ]);
    }

    /**
     * Çıkış işlemi
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
