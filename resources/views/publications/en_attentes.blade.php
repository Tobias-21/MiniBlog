<x-layouts.app>

    <x-slot:titre>
        Publications en attente
    </x-slot:titre>

    <x-slot:title>
        Publications en attente
    </x-slot:title>

    @if (session()->has('success'))
        <div class="mt-3 mb-4 list-disc list-inside bg-green-200 p-4 text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

     @forelse($publications as $publication)
            <div class=" px-9 py-4 shadow-md my-7 ">
                <div class=" mb-3">
                
                        <img src="{{ asset('storage/' . $publication->photo) }}" alt="Photo de la publication" class=" w-30 h-30 object-cover rounded-lg">
                    
                </div>
                <div class=" flex space-x-3 mb-3 items-center">
                    <h2 class=" text-2xl font-bold text-emerald-800"> {{ $publication->title }} </h2>
                </div>

                <p class=" text-gray-700 font-mono text-sm"> Auteur : {{ $publication->user->name }} </p>
                <p class=" text-gray-600 font-mono text-sm"> <span class=" pe-4">Créé le : {{ $publication->created_at->format('d/m/Y H:i') }}</p>

                <div class=" flex justify-end text-blue-600 space-x-3 mt-3 ">
                    <div class=" flex space-x-2">
                        <a href=" {{ route('publications.show', ['slug' => $publication->slug]) }} " class=" bg-yellow-500 py-1 px-2 rounded-lg text-white"> Voir</a>
                        @if (auth()->check() && auth()->user()->role == 'user')
                            <button class=" bg-blue-500 py-1 px-2 rounded-lg text-white"> <a href=" {{ route('publications.edit', $publication) }} "> Modifier </a></button>

                        @elseif (auth()->check() && auth()->user()->role == 'admin')
                            <form action=" {{ route('publications.validate',['slug' => $publication->slug]) }} " method="post">
                                @csrf
                                
                                <button type="submit" role="button" class=" bg-green-500 py-1 px-2 rounded-lg text-white "> Valider </button>
                            </form>
                        @endif

                        <form action=" {{ route('publications.destroy',compact('publication')) }} " method="post" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" role="button" class=" bg-red-500 py-1 px-2 rounded-lg text-white "> Supprimer </button>
                        </form>
                    </div>
                </div>
            </div>        
    @empty
         <p class=" text-gray-700  text-center mt-5"> Aucun publication en attente </p>
    @endforelse

</x-layouts.app>