<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

class RatingController extends Controller
{
    public function ratings(Request $request)
    {
        
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $articleId = $request->input('article_id');
        $userId = Auth::id();

        
        // Check if the user has already rated the article
        $rating = Rating::where('user_id', $userId)->where('article_id', $articleId)->first();

        if ($rating) {
            // If it exists, update the rating
            $rating->update(['rating' => $request->input('rating')]);
        } else {
            // If it does not exist, create a new rating
            Rating::create([
                'user_id' => $userId,
                'article_id' => $articleId,
                'rating' => $request->input('rating'),
            ]);
        }

        return \redirect()->route('articles.index');
    }

    
}
