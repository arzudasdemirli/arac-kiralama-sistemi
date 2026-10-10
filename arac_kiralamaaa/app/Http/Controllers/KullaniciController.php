<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class KullaniciController extends Controller
{
    public function home()
    {
        return view('kullanici.anasayfa'); // view: resources/views/kullanici/anasayfa.blade.php
    }
    public function profil()
{
    $user = auth()->user();
    return view('profile.show', compact('user'));
}

public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
    ]);

    $user->update($request->only('name', 'email', 'phone'));

    return back()->with('success', 'Profil bilgileri güncellendi.');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = auth()->user();
    $user->password = bcrypt($request->password);
    $user->save();

    return back()->with('success', 'Şifre başarıyla güncellendi.');
}


}
