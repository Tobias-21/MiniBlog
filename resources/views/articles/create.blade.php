<x-layouts.app>

    <x-slot:titre>
        Création d'articles
    </x-slot:titre>

    <x-slot:title>
        Créer un article
    </x-slot:title>

    @if (session()->has('success'))

        <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="post">
        @csrf

        
        
        <div class=" my-7">
            <x-label for="title" label="Titre de l'article" />
            <input type="text" name="title" id="title" class=" w-full px-4 py-3 border-1 border-pink-400 rounded-3xl text-gray-700 focus:outline-0" value=" {{ old('title') }}" required> 
            <x-error field="title" />
        </div>

        <div class=" my-7">
            <x-label for="content" label="Contenu de l'article" />
            <input type="text" name="content" id="content" class="w-full px-4 py-3 border-1 border-pink-400 rounded-3xl text-gray-700 focus:outline-0" value=" {{ old('content') }}" required>
           <x-error field="content" />
        </div>

        <div class="flex justify-end">
            <button type="submit" class= " bg-amber-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Créer l'article </button>
        </div>
        
    </form>


</x-layouts.app>