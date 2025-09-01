<x-layouts.app>

    <x-slot:titre>
        Voir la publication
    </x-slot:titre>

    <x-slot:title>
        Informations sur la publication
    </x-slot:title>

    @if (session('success'))
        <div class="bg-green-200 text-green-700 p-4 rounded-md my-3">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-200 text-red-700 p-4 rounded-md my-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="my-7 border-t-2 border-t-amber-500 ">
        <div class="my-5">
        <img src="{{ asset('storage/' . $publication->photo) }}" alt="Photo de l'publication" class=" w-2xs h-72 object-cover rounded-lg shadow-md">
        </div>
        <h1 class=" text-2xl font-bold text-indigo-800 my-5 mb-1"> {{ $publication->title }}</h1>
        <p class="text-gray-700 my-4">{!! $publication->content !!}</p>
        <p class="text-gray-700 mt-3"> Catégorie : {{ $publication->categori->name }}</p>
    </div>

    <div>
        @if (!auth()->check())
            <p class=" bg-yellow-200 text-yellow-700 font-mono text-sm p-3"> Connectez-vous pour noter l'publication </p>
        @else
        <form action="{{ route('ratings') }}" method="POST" class="flex items-center space-x-2">
            @csrf
            @method('POST')
            <input type="hidden" name="publication_id" value="{{ $publication->id }}">
            
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
        <p class="text-sm text-gray-500">Publié le {{ $publication->created_at->format('d/m/Y H:i') }}</p>

    </div>

    @if (!$publication->created_at->isSameHour($publication->updated_at) || !$publication->created_at->isSameDay($publication->updated_at))
        <div class="mb-3">
            <p class="text-sm text-gray-500">Mis à jour le {{ $publication->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    @endif

    <div>
        <h2 class=" text-amber-600 text-2xl text-center font-bold mt-7"> Commentaires </h2>

        @forelse ($publication->comments as $comment)
            <div class=" p-9 shadow-md rounded-2xl">
                <h3 class=" font-bold  mb-1 text-indigo-800"> {{ $comment->name }}</h3>

                <p class=" text-gray-700"> {!! $comment->comment !!} </p>

                <p class=" text-gray-500 font-mono text-sm mt-2"> Posté le {{ $comment->created_at->format('d/m/Y H:i') }}  </p>
                @if (auth()->check())
                <a href="#"  class="reponse font-medium flex justify-end text-indigo-800 mt-3"> Répondre </a>
                @endif

                 @if ($comment->replies->count() > 0)
                    <div class="my-3 ml-6">
                        <h4 class="text-sm font-semibold text-gray-600">Réponses :</h4>
                        @foreach ($comment->replies as $reply)
                            <div class=" my-2 p-4 rounded-md shadow-sm">
                                <p class="text-gray-700 mb-1.5">{!! $reply->reply !!}</p>
                                <p class="text-xs text-gray-500 font-mono mt-1">Répondu par {{ $reply->user->name }} le {{ $reply->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <div class="form hidden" style=" margin-left: 20px;">
                    <form action="{{ route('comments.reply', $comment->id) }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="publication_id" value="{{ $publication->id }}">
                        <textarea name="reply" id="reply" placeholder="Écrire une réponse..." class=" w-full px-3 py-2 border rounded-md">{{ old('reply') }}</textarea>

                        <div class="flex justify-end mt-2">
                            <button class=" bg-amber-600 py-1 px-4 rounded hover:bg-amber-500" >Envoyer</button>
                        </div>
                    </form>
                </div>
               
            </div>
        @empty

            <p class=" text-gray-600 text-center mt-5"> Aucun commentaire pour le moment. Soyez le premier à commenter cet publication!</p>

        @endforelse
    </div>
    
    
    @if (auth()->check() && auth()->user()->id !== $publication->user_id && (auth()->user()->role === 'user' || auth()->user()->role === 'admin' && $publication->status === 'validé') )
        
    <div class="mt-15">
        <h2 class="text-xl font-semibold text-pink-500 text-center">Ajouter un commentaire</h2>
    </div>

    <form action="{{ route('comments.store') }}" method="post" class="mt-3">
        @csrf
        <input type="hidden" name="publication_id" value="{{ $publication->id }}">

        <div class="mb-4">
            <textarea name="comment" id="myTexterea" class="w-full px-3 py-2 border rounded-md" placeholder="Ecrire un commentaire" >{{ old('comment') }}</textarea>
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