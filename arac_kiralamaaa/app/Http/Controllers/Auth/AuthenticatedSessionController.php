<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KullaniciController;


class AuthenticatedSessionController extends Controller
{
    public function create()
{
    return view('auth.login');
}

    public function store(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        // Kullanıcının rolünü veritabanından alıyoruz
        $role = Auth::user()->role;

        // Rolüne göre yönlendirme
        if ($role === 'kullanici') {
            return redirect()->route('user.home');
        } elseif ($role === 'yonetici') {
            return redirect()->route('admin.dashboard');
        }
    }

    return back()->withErrors(['login' => 'Verilen bilgiler hatalı.']);
}


    /**
     * Oturumu kapat.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
