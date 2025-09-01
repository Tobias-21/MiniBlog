<x-layouts.app>

    <x-slot:titre>
        Modification de la publications
    </x-slot:titre>

    <x-slot:title>
        Modifier de la publication
    </x-slot:title>

    @if (session()->has('success'))
        <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('publications.update', $publication->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="my-7">
            <x-label for="title" label="Titre de la publication" />
            <input type="text" name="title" id="title" class="w-full px-4 py-3 border-1 border-pink-400 rounded-3xl text-gray-700 focus:outline-0 focus:ring-2 focus:ring-pink-500" value="{{ old('title', $publication->title) }}" required>
            <x-error field="title" />
        </div>

        <div class="my-7">
            <x-label for="content" label="Contenu de la publication" />
            <textarea type="text" name="content" id="myTexterea" class="w-full px-4 py-2 border-1 border-pink-500 rounded-3xl text-gray-700 focus:outline-0 focus:ring-2 focus:ring-pink-500" value="" required> {{ old('content', $publication->content) }} </textarea>
            <x-error field="content" />
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Modifier l'publication
            </button>
        </div>
        
    </form> 
</x-layouts.app>