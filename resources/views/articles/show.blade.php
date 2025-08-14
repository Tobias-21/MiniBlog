<x-layouts.app>

    <x-slot:titre>
        Voir l'article
    </x-slot:titre>

    <x-slot:title>
        Informations sur l'article
    </x-slot:title>

    

    <div class="my-7 border-t-2 border-t-amber-500 ">
        <div class="my-5">
        <img src="{{ asset('storage/' . $article->photo) }}" alt="Photo de l'article" class=" w-2xs h-1/2 object-cover rounded-lg shadow-md">
        </div>
        <h1 class=" text-2xl font-bold text-indigo-800 mt-5 mb-1"> {{ $article->title }}</h1>
        <p class="text-gray-700">{{ $article->content }}</p>
    </div>

    <div>
        @if (!auth()->check())
            <p class=" bg-yellow-200 text-yellow-700 font-mono text-sm p-3"> Connectez-vous pour noter l'article </p>
        @else
        <form action="{{ route('ratings') }}" method="POST" class="flex items-center space-x-2">
            @csrf
            @method('POST')
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            
            <div class="flex flex-row-reverse justify-end space-x-1 space-x-reverse">
                @for ($i = 5; $i >= 1; --$i)

                    <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" class="hidden peer" >
                    <label for="rating-{{ $i }}" class=" text-gray-500 peer-checked:text-yellow-500 cursor-pointer transition-color hover:text-yellow-600">
                        <i class="bi bi-star"></i>
                    </label> 
                   
                @endfor
            </div>
            <button type="submit" class="bg-blue-700 text-white px-3 py-1 rounded hover:bg-blue-600">
                Noter   
            </button>
            <x-error field="rating" class="text-red-500 text-sm mt-1" />
            
        </form>

       @endif     
        
    </div>

    <div class="my-2">
        <p class="text-sm text-gray-500">Publié le {{ $article->created_at->format('d/m/Y H:i') }}</p>

    </div>

    @if (!$article->created_at->isSameHour($article->updated_at) || !$article->created_at->isSameDay($article->updated_at))
        <div class="mb-3">
            <p class="text-sm text-gray-500">Mis à jour le {{ $article->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    @endif

    <div>
        <h2 class=" text-amber-600 text-2xl text-center font-bold mt-7"> Commentaires </h2>

        @forelse ($article->comments as $comment)
            <div class=" p-9 shadow-md rounded-2xl">
                <h3 class=" font-medium text-base mb-1 text-indigo-800"> {{ $comment->name }}</h3>

                <p class=" text-gray-700"> {{ $comment->comment }} </p>

                <p class=" text-gray-500 font-mono text-sm mt-2"> Posté le {{ $comment->created_at->format('d/m/Y H:i') }} </p>
            </div>
        @empty

            <p class=" text-gray-600 text-center mt-5"> Aucun commentaire pour le moment. Soyez le premier à commenter cet article!</p>

        @endforelse
    </div>
    

    
    @if (auth()->check() && auth()->user()->id !== $article->user_id)
        
    <div class="mt-15">
        <h2 class="text-xl font-semibold text-pink-500 text-center">Ajouter un commentaire</h2>
    </div>

    <form action="{{ route('comments.store') }}" method="post" class="mt-3">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">

        <div class="mb-4">
            
            <textarea name="comment" id="comment" class="w-full px-3 py-2 border rounded-md" required>{{ old('comment') }}</textarea>
            <x-error field="comment" />
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Ajouter un commentaire
            </button>
        </div>
    </form>

    @endif

</x-layouts.app>