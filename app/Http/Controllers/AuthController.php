<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\SentResetLink;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;


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

        if (Auth::attempt($credentials,$request->filled('remember'))) {
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

    public function sendEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token]
        );

        $url = url(env('FRONTEND_URL') . '/reset-password/' . $token . '?email=' . $user->email);

        Mail::to($user->email)->send(new SentResetLink($user,$url));

        return back()->with(['status' => 'Un lien de réinitialisation été envoyé à votre mail' ]);
    }

    public function showResetForm(string $token){
        return view('reset-password',['token' => $token]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function (User $user, string $password){
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }

        );

        return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status',__($status))
        : back()->withErrors((['email' => [__($status)]]));
    }
}
