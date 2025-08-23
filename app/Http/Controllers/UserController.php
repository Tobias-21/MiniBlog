<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

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

   

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|email|max:255|unique:users',
            'password' => 'bail|required|string|min:8|confirmed',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        User::Create($validator->validated());
        
         return redirect()->route('login')->with('success', 'Vos informations sont enregistrées avec succès.');

    }

    public function subscribe(Request $request): RedirectResponse
    {
        $user = $request->user();
        if ($user && $user->status !== 'abonné') {
           $user->status = 'abonné';
           $user->save();
            $request->session()->flash('success', 'Vous êtes abonné aux notifications !');
            
        } elseif ($user && $user->status === 'abonné') {
            $user->status = 'non abonné';
            $user->save();
            $request->session()->flash('success', "Vous êtes désabonné aux notifications");
        }else {
            $request->session()->flash('error', "Vous devez être connecté pour vous abonner.");
        }

        return redirect()->back();
    }

}
