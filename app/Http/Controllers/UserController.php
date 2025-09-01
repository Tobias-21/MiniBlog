<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Publication;

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

    public function profile(){
    
        $user = User::find(auth()->id());
        $validé = $user->publications()->where('status','validé')->count();
        $en_attente = $user->publications()->where('status','en attente')->count();
        
        return view ('profile',compact('user','validé','en_attente'));
    }

    public function updateProfile(Request $request): RedirectResponse{
   
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        
        $user->update($request->only('name', 'email'));

        if ($request->filled('password')) {
            $user->password = $request->input('password');
            $user->save();
        }

        return redirect()->route('user.profile')->with('success', 'Profil mis à jour avec succès.');
    }

}
