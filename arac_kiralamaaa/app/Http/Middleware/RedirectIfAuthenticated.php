<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->role === 'yonetici') {
                    return redirect('/admin-dashboard');
                } elseif ($user->role === 'kullanici') {
                    return redirect('/kullanici-anasayfa');
                } else {
                    return redirect('/'); // Diğer durumlar için
                }
            }
        }

        return $next($request);
    }
}
