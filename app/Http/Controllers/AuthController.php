<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


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
            return redirect()->intended('articles')->with('success', 'Vous êtes connecté avec succès.');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }
    
        
    public function logout() : RedirectResponse
    {
        Auth::logout();
        return redirect('articles')->with('success', 'Vous êtes déconnecté avec succès.');
    }
}
