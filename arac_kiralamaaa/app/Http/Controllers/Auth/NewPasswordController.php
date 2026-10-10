<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    // Şifre sıfırlama formunu göster
    public function create(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->route('token'),
           
            'email' => $request->email,
        ]);
    }

    // Şifreyi sıfırlama işlemi
    public function store(Request $request)
    {
        // Şifre sıfırlama için gerekli validasyon
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Şifre sıfırlama işlemi
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Şifreniz başarıyla sıfırlandı!');
        } else {
            return back()->withErrors(['email' => [trans($status)]]);
        }
    }
}
