<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
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

        // Check if the article is already favorited by the user
        $favori = Favori::where('user_id', $userId)->where('article_id', $articleId)->first();

        if ($favori) {
            // If it exists, delete it (unfavorite)
            $favori->delete();
            return response()->json(['message' => 'Article unfavorited successfully.']);
        } else {
            // If it does not exist, create it (favorite)
            Favori::create([
                'user_id' => $userId,
                'article_id' => $articleId,
            ]);
            return response()->json(['message' => 'Article favorited successfully.']);
        }
    }
}
