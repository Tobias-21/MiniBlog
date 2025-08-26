<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    //
    public function login() : View
    {
        return view('login');
    }

    public function doLogin(Request $request) : RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $credentials = session()->regenerate();
            return redirect()->intended('/')->with('success', 'Vous êtes connecté avec succès.');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }
    
        
    public function logout() : RedirectResponse
    {
        Auth::logout();
        return redirect()->route('publications.index')->with('success', 'Vous êtes déconnecté avec succès.');
    }

    public function showForgotForm(): View
    {
        return view('forgot_password');
    }

    public function sendnewPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $user->password = \bcrypt($request->new_password);
        $user->save();

        return redirect()->route('login')->with('success', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.');
    }
}
