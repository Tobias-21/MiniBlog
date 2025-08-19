<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Comment;
use App\Models\Reply;
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

    public function reply(Request $request, $commentId): RedirectResponse
    {
        if(!Auth::check()) {
            return redirect()->back()->with('error', 'Vous devez être connecté pour répondre à un commentaire.');
        }
        // Logic to store a reply to a comment
        $request->validate([
            'reply' => 'required|string|min:3',
        ]);

        // Check if the comment exists
        $comment = Comment::findOrFail($commentId);

        // Logic to save the reply in the database
        Reply::create([
            'comment_id' => $comment->id,
            'user_id' => Auth::id(), // Assuming the user is authenticated
            'reply' => $request->input('reply'),
        ]);        
        return redirect()->back();
    }

    
}
