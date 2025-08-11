<?php

namespace App\Http\Controllers;

use illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ArticleController extends Controller
{
    public function create() : View {
        return view('articles.create');
    }

    public function index(Request $request) : View {

        $search = $request->input('search');
        $articles = Article::withCount('comments')->with('user')->when($search, function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        })->latest()->paginate(5);
        return view('articles', compact('articles','search'));
        
    }

    public function store(Request $request):RedirectResponse {
        // Validate and store the article
        $request->validate([
            'title' => 'required|string|min:5',
            'content' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate photo if provided

        ]);
        

        // Logic to save the article in the database
        $article = new Article() ;
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->photo = $request->file('photo')->store('photos', 'public'); // Store photo if provided
        $article->user_id = Auth::id();
        $article->save();
        
        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(Article $article) {

        if(Auth::user()->id !== $article->user_id) {
            return redirect()->route('articles.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet article.');
        }
        
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article) : RedirectResponse {
        // Logic to update the article

        if(Auth::user()->id !== $article->user_id) {
            return redirect()->route('articles.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet article.');
        }

        $request->validate([
            'title' => 'required|string|min:5',
            'content' => 'required|string',
        ]);

        // This method should accept an ID and update the corresponding article
        
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->save();

        // For now, we will just return a redirect response
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
        
    }

    public function show(Article $article) : View {
        // Logic to show a single article
        $article->load(['comments' => function ($query) {
            $query->latest();
        }]);
        return view('articles.show', compact('article'));
    }

    public function destroy(Article $article) : RedirectResponse {

        if(Auth::user()->id !== $article->user_id) {
            return redirect()->route('articles.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer cet article.');
        }

        $article->delete();

        return redirect()->route('articles.index');
    }
    
}
