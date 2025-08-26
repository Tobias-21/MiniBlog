<x-layouts.app>

    @if (session()->has('success'))
        <div class="my-3 list-disc list-inside text-sm bg-green-200 alert alert-success p-4 rounded-md text-green-700">
            {{ session('success') }}
        </div>

    @elseif (session()->has('error'))
        <div class="my-3 list-disc list-inside bg-red-300 text-sm text-red-700 p-4 alert alert-error rounded-md">
            {{ session('error') }}
        </div>
    @endif


    <x-slot:titre>
        Liste des publications
    </x-slot:titre>

    <x-slot:title>
        Liste des publications
    </x-slot:title>

    <x-slot:search>
        <div class="flex justify-center mb-10">
            <form action="{{ route('publications.index') }}" method="GET" class="flex">
                @csrf
                @method('GET')
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un publication..." class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="ml-2 bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600"> <i class="bi bi-search "></i></button>
            </form>
        </div>


        <div class=" flex justify-between items-center mb-6">
            <select onchange="window.location.href = this.value" class=" p-4 shadow text-gray-600 focus:outline-0">
                <option value="{{ route('publications.index') }}" @selected(empty($slug))> Toutes les categories</option>
                @foreach ($categories as $categorie)
                    <option value="{{ route('publications.categorie' , ['slug' => $categorie->slug]) }}" @if ($slug == $categorie->slug) selected @endif > {{ $categorie->name }} </option>
                @endforeach
                
            </select>

            @if (Auth::check() && Auth::user() && Auth::user()->role === 'admin')
            <div>
                <a href="{{ route('publications.en_attente') }}" class=" bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600">Ajouter une catégorie</a>
            </div>
        @endif
        </div>
        
    </x-slot:search>

    @php
        $userFavoris = auth()->user() ? auth()->user()->favoris->pluck('id')->toArray() : [];
               
    @endphp

    @forelse($publications as $publication)

        
            <div class=" px-9 py-4 shadow-md my-7 ">
                <div class=" mb-3">
                
                        <img src="{{ asset('storage/' . $publication->photo) }}" alt="Photo de l'publication" class=" w-30 h-30 object-cover rounded-lg">
                    
                </div>
                <div class=" flex space-x-3 mb-3 items-center">
                <h2 class=" text-2xl font-bold text-emerald-800"> {{ $publication->title }} </h2>
                
                @if (auth()->check() && auth()->user())
                    <form action=" {{ route('favoris') }} " method="post">
                        @csrf
                        @method('POST')

                        <input type="hidden" value="{{ $publication->id }}" name="publication_id">
                        @if ( in_array($publication->id, $userFavoris) )
                            <button type="submit"> <i class="bi bi-heart-fill" style="color: red;"></i> </button>
                        @else
                            <button type="submit"> <i class="bi bi-heart" style="color: red;"></i> </button>
                        @endif
                    </form>
                @endif
                </div>
                <p class=" text-gray-700 font-mono text-sm"> Auteur : {{ $publication->user->name }} </p>
                <p class=" text-gray-600 font-mono text-sm"> <span class=" pe-4">Créé le : {{ $publication->created_at->format('d/m/Y H:i') }}</span>  {{ $publication->comments_count }} commentaire(s) </p>
                <p class=" text-gray-600 font-mono text-sm"> <span class=" pe-4">
                    
                    @php
                        $avg = round($publication->ratings->avg('rating') ?? 0);
                        
                    @endphp
                    @for ($i = 1 ; $i <= 5; $i++)
                        
                        @if ( $i <= $avg)
                            <i class="bi bi-star-fill text-yellow-500"></i>
                        @else
                            <i class="bi bi-star text-gray-600"></i>
                        @endif
                    
                    @endfor
                
                </span> </p>

                <div class=" flex justify-end text-blue-600 space-x-3 ">
                    <div class=" flex space-x-2">
                    <button class=" bg-green-500 py-1 px-2 rounded-lg text-white"> <a href=" {{ route('publications.show', ['slug' => $publication->slug]) }} "> Voir</a></button> 

                        @if (auth()->check() && auth()->user()->id === $publication->user_id)
                            
                        <button class=" bg-amber-500 py-1 px-2 rounded-lg text-white"><a href=" {{ route('publications.edit',compact('publication')) }} "> Editer</a></button>

                        <form action=" {{ route('publications.destroy',compact('publication')) }} " method="post" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" role="button" class=" bg-red-500 py-1 px-2 rounded-lg text-white "> Supprimer </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
    @empty

        <p class=" text-gray-700  text-center mt-5"> Aucune publication créée </p>

       
    @endforelse

    <div class=" mt-6">
        {{ $publications->links()}}
    </div>
    
</x-layouts.app>