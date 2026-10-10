<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    public function show()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    return view('profile.show', compact('user'));
}

public function update(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user = Auth::user();
    $user->name = $request->name;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('profile.show')->with('success', 'Profil başarıyla güncellendi.');
}

}
