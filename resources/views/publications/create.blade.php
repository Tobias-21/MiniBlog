<x-layouts.app>

    <x-slot:titre>
        Création d'publications
    </x-slot:titre>

    <x-slot:title>
        Créer une publication
    </x-slot:title>

    @if (session()->has('success'))

        <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('publications.store') }}" method="post" enctype="multipart/form-data" class=" p-10 rounded-lg shadow-md">
        @csrf
        
        <div class=" my-7">
            <x-label for="title" label="Titre de la publication" />
            <input type="text" name="title" id="title" class=" w-full px-4 py-3 border-1 border-pink-400 rounded-3xl text-gray-700 focus:outline-0 focus:ring-2 focus:ring-pink-500 " value=" {{ old('title') }}" required> 
            <x-error field="title" />
        </div>

        <div class=" my-7">
            <x-label for="content" label="Contenu de la publication" />
            <textarea type="text" name="content" id="myTexterea" class="w-full px-4 py-2 border-1 border-pink-400 rounded-3xl text-gray-700 focus:outline-0 focus:ring-2 focus:ring-pink-500" value=" {{ old('content') }}" required> </textarea>
           <x-error field="content" />
        </div>

        <div class=" my-7">
            <x-label for="categorie_id" label="Categorie de la publication" />
            <select name="categorie_id" class=" w-full px-4 py-3 border-1 border-pink-400 rounded-3xl text-gray-700 focus:outline-0 focus:ring-2 focus:ring-pink-500 ">
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}"> {{ $categorie->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="my-7">
            <x-label for="photo" label="Photo de la publication" />
            <input type="file" name="photo" id="photo" class="w-full px-4 py-3 border-1 border-pink-400 rounded-3xl text-gray-700 focus:outline-0 focus:ring-2 focus:ring-pink-500" required>
            <x-error field="photo" />
        </div>

        <div class="flex justify-end">
            <button type="submit" class= " bg-amber-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Créer l'publication </button>
        </div>
        
    </form>


</x-layouts.app>