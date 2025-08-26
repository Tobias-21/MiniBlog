<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Favori;



class FavoriController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'publication_id' => 'required|exists:publications,id',
        ]);

        $publicationId = $request->input('publication_id');
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Connectez-vous pour ajouter un favori.');
        }
        // Check if the publication is already favorited by the user
        $favori = Favori::where('user_id', $userId)->where('publication_id', $publicationId)->first();

        if ($favori) {
            // If it exists, delete it (unfavorite)
            $favori->delete();
            return redirect()->route('publications.index')->with('Favori_status',false);
        } else {
            // If it does not exist, create it (favorite)
            Favori::create([
                'user_id' => $userId,
                'publication_id' => $publicationId,
                
            ]);
            return redirect()->route('publications.index')->with('Favori_status', true);
        }
    }

    public function favoris(Request $request) {

        $searchs = $request->input('searchs');
        $publications = Auth::user()
        ->favoris()
        ->withCount('comments')
        ->when($searchs, function ($query) use ($searchs) {
            $query->where('title', 'like', '%' . $searchs . '%')
                  ->orWhere('content', 'like', '%' . $searchs . '%')
                  ->orWhereHas('user', function ($q) use ($searchs) {
                      $q->where('name', 'like', '%' . $searchs . '%');
                  });
        })->latest()->paginate(5);

        return view('publications.favoris',compact('publications','searchs'));
    }
}
