<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    //
    public function index() : View
    {
        return view('registers');
    }

    public function show($id)
    {
        // Logic to display a specific user
    }

   

    public function store(Request $request) : RedirectResponse{
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('login')->with('success', 'Vos informations sont enregistrées avec succès.');

    }

}
