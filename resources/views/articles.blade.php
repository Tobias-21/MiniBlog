<x-layouts.app>

    @if (session()->has('success'))
        <div class="my-3 list-disc list-inside text-sm text-green-600 alert alert-success">
            {{ session('success') }}
        </div>

    @elseif (session()->has('error'))
        <div class="my-3 list-disc list-inside text-sm text-red-600 alert alert-error">
            {{ session('error') }}
        </div>
    @endif


    <x-slot:titre>
        Liste des articles
    </x-slot:titre>

    <x-slot:title>
        Liste des articles
    </x-slot:title>

    @forelse($articles as $article)

    <div class=" px-9 py-4 shadow-md my-7 ">
        <div class=" mb-3">
           
                <img src="{{ asset('storage/' . $article->photo) }}" alt="Photo de l'article" class=" w-30 h-30 object-cover rounded-lg">
            
        </div>
        <h2 class=" text-2xl font-bold text-emerald-800 mb-1.5"> {{ $article->title }} </h2>

        <p class=" text-gray-700 font-mono text-sm"> Auteur : {{ $article->user->name }} </p>
        <p class=" text-gray-600 font-mono text-sm"> <span class=" pe-4">Créé le : {{ $article->created_at->format('d/m/Y H:i') }}</span>  {{ $article->comments_count }} commentaire(s) </p>


        <div class=" flex justify-end text-blue-600 space-x-3 ">
            <div>
                <a href=" {{ route('articles.show', compact('article')) }} " class=" hover:underline me-3"> Voir</a>

                @if (auth()->check() && auth()->user()->id === $article->user_id)
                    
                <a href=" {{ route('articles.edit',compact('article')) }} " class=" hover:underline"> Editer</a>

                @endif
            </div>
            
            @if (auth()->check() && auth()->user()->id === $article->user_id)
            <div>
                <form action=" {{ route('articles.destroy',compact('article')) }} " method="post" onsubmit="return confirm('Confirmer la suppression ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" role="button" class=" hover:underline"> Supprimer </button>
                </form>
            </div>
            @endif
            
            
        </div>
    </div>

    @empty

        <p class=" text-gray-700  text-center mt-5"> Aucun article créé </p>
    @endforelse

    <div class=" mt-6">
        {{ $articles->links()}}
    </div>
    
</x-layouts.app>