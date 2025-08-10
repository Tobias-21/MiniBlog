<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
   


    public function store(Request $request):RedirectResponse
    {
        // Logic to store a new comment
        $request->validate([
            'article_id' => 'required',
            'comment' => 'required|string|min:10',
        ]);

        // Logic to save the comment in the database
        $comment = new Comment();
        $comment->article_id = $request->input('article_id');
        $comment->name = Auth::user()->name; // Assuming the user is authenticated
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->back();
    }

    
}
