<?php

namespace App\Http\Controllers;

use illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Publication;
use App\Models\Categori;
use App\Models\User;
use App\Events\PublicationPublished;
use App\Events\PublicationRejetted;

class PublicationController extends Controller
{
    public function create() : View {

        $categories = Categori::all();
        return view('publications.create',\compact('categories'));
    }

    public function index(Request $request, $slug = null) : View {

        $search = $request->input('search');        
        $publications = Publication::with(['favoris','ratings','user'])->withAvg('ratings','rating')->withCount('comments')->where('status', 'validé'); // Only show validated publications

        if($slug){
            $publications->whereHas('categori', function ($query) use ($slug) {
                $query->where('slug',$slug);
            });
        }
        
        if($search){
            $publications->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }

        $publications = $publications->latest()->paginate(5);
        $categories = Categori::all();

        return view('publications', compact('publications','search','categories','slug'));
    }

    public function mes_Publication(Request $request) {

        $search = $request->input('search');
        $publications = Publication::where('user_id', auth::id())->where('status', 'validé');

        if($search){
            $publications->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        }

        $publications = $publications->latest()->paginate(5);
        return view('mes_publications', compact('publications','search'));
    }

    public function store(Request $request):RedirectResponse {
        // Validate and store the publication
        $request->validate([
            'title' => 'required|string|min:5|unique:publications',
            'content' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate photo if provided

        ]);
        
        // Logic to save the publication in the database
        $publication = new Publication() ;
        $publication->title = $request->input('title');
        $publication->content = $request->input('content');
        $publication->photo = $request->file('photo')->store('photos', 'public'); // Store photo if provided
        $publication->user_id = Auth::id();
        $publication->categori_id = $request->input('categorie_id');
        $publication->slug = Str::slug($request->input('title'),'_');

        if(Auth::user()->role == 'admin'){
            $publication->status = 'validé';
        }
        $publication->save();
        
        if(Auth::user()->role == 'admin'){
            return redirect()->route('publications.index')->with('success', 'Publication créé avec succès.');
        }

        return redirect()->route('publications.en_attente')->with('success', 'Publication créé avec succès.');
    }

    public function edit(Publication $publication) {

        if(Auth::user()->id !== $publication->user_id) {
            return redirect()->route('publications.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet publication.');
        }
        return view('publications.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication) : RedirectResponse {
        // Logic to update the publication
        if(Auth::user()->id !== $publication->user_id) {
            return redirect()->route('publications.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet publication.');
        }

        $request->validate([
            'title' => 'required|string|min:5|unique:publications',
            'content' => 'required|string',
        ]);

        // This method should accept an ID and update the corresponding publication
        
        $publication->title = $request->input('title');
        $publication->content = $request->input('content');
        $publication->slug = Str::slug($request->input('title'),'_');
        $publication->save();

        // For now, we will just return a redirect response
        return redirect()->route('publications.index')->with('success', 'Publication mis à jour avec succès.');
        
    }

    public function show(string $slug) : View {
        // Logic to show a single publication

        $publication = Publication::where('slug',$slug)->firstOrFail();
        $publication->load(['comments' => function ($query) {
            $query->latest();
        }]);
        
        return view('publications.show', compact('publication'));
    }

    public function enAttente() {
        
        if(Auth::check() && Auth::user()->role == 'admin') {
            $publications = Publication::where('status', 'en attente')->get();
           
        }elseif(Auth::check() && Auth::user()->role == 'user') {
            $publications = Publication::where('status', 'en attente')->where('user_id', auth::id())->get();
           
        }   
         return view('publications.en_attentes', compact('publications'));
       
    }

    public function validatePublication(string $slug) : RedirectResponse {

        if (Auth::check() && Auth::user()->role == 'admin') {
            $publication = Publication::where('slug', $slug)->firstOrFail();
            $publication->status = 'validé';
            $publication->save();

            PublicationPublished::dispatch($publication);

            return redirect()->route('publications.en_attente')->with('success', 'Publication validé avec succès.');
        }

        return redirect()->route('publications.index')->with('error', 'Vous n\'êtes pas autorisé à valider cet publication.');
    }

    public function destroy(Publication $publication) : RedirectResponse {

        if(Auth::user()->id !== $publication->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('publications.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer cet publication.');
        }

        if(auth::user()->role === 'admin' && $publication->status === 'en attente'){ 
            $info_publication = $publication;
            $publication->delete();
            PublicationRejetted::dispatch($info_publication);
            
            return redirect()->route('publications.index')->with('success', 'Publication supprimé avec succès.');
        }

        $publication->delete();
        return redirect()->route('publications.index')->with('success', 'Publication supprimé avec succès.');
    }
    
    public function categories() : View {
        $categories = Categori::all();
        return view('categories', compact('categories'));
    }

    public function storeCategorie(Request $request) : RedirectResponse {

        $request->validate([
            'name' => 'required|string|min:3|unique:categoris'
        ]);

        $categori = new Categori();
        $categori->name = $request->input('name');
        $categori->slug = Str::slug($request->input('name'),'_');
        $categori->save();

        return redirect()->route('categories')->with('success', 'Catégorie créé avec succès.');
    }

    public function destroyCategorie(Categori $categorie) : RedirectResponse {

        if(Auth::user()->role !== 'admin') {
            return redirect()->route('categories')->with('error', 'Vous n\'êtes pas autorisé à supprimer cette catégorie.');
        }   
        
        $categorie->delete();

        return redirect()->route('categories')->with('success', 'Catégorie supprimé avec succès.');
    }
}
