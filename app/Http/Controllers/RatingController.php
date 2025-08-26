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
            'publication_id' => 'required|exists:publications,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $publicationId = $request->input('publication_id');
        $userId = Auth::id();

        
        // Check if the user has already rated the publication
        $rating = Rating::where('user_id', $userId)->where('publication_id', $publicationId)->first();

        if ($rating) {
            // If it exists, update the rating
            $rating->update(['rating' => $request->input('rating')]);
        } else {
            // If it does not exist, create a new rating
            Rating::create([
                'user_id' => $userId,
                'publication_id' => $publicationId,
                'rating' => $request->input('rating'),
            ]);
        }

        return \redirect()->route('publications.index');
    }

    
}
