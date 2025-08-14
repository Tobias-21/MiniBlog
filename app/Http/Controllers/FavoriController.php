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
            'article_id' => 'required|exists:articles,id',
        ]);

        $articleId = $request->input('article_id');
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Connectez-vous pour ajouter un favori.');
        }
        // Check if the article is already favorited by the user
        $favori = Favori::where('user_id', $userId)->where('article_id', $articleId)->first();

        if ($favori) {
            // If it exists, delete it (unfavorite)
            $favori->delete();
            return redirect()->route('articles.index')->with('Favori_status',false);
        } else {
            // If it does not exist, create it (favorite)
            Favori::create([
                'user_id' => $userId,
                'article_id' => $articleId,
                
            ]);
            return redirect()->route('articles.index')->with('Favori_status', true);
        }
    }

    public function favoris(Request $request) {

        $searchs = $request->input('searchs');
        $articles = Auth::user()
        ->favoris()
        ->withCount('comments')
        ->when($searchs, function ($query) use ($searchs) {
            $query->where('title', 'like', '%' . $searchs . '%')
                  ->orWhere('content', 'like', '%' . $searchs . '%')
                  ->orWhereHas('user', function ($q) use ($searchs) {
                      $q->where('name', 'like', '%' . $searchs . '%');
                  });
        })->latest()->paginate(5);


        return view('articles.favoris',compact('articles','searchs'));
        
    }
}
