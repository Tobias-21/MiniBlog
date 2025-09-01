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
        Catégories
    </x-slot:titre>

    <x-slot:title>
       Listes des Catégories
    </x-slot:title>


    
         <div class=" my-10 flex flex-wrap justify-start items-center gap-2 text-sm">
            @foreach ($categories as $categorie)
            
                    <div class="shadow-md rounded-2xl bg-amber-50  font-bold text-blue-700 mb-3 p-4 py-2 flex justify-between items-center">
                        <p class=" "> {{ $categorie->name }} 
                            <form action=" {{ route('category.destroy', $categorie ) }}  " method="post" onsubmit="return confirm('Confirmer la suppression ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" role="button" class="  py-1 px-2 rounded-lg text-red-600 hover:text-red-700 "> <i class=" bi bi-trash"></i> </button>
                            </form>
                        </p> 
                    </div>
                
            @endforeach
        </div>
    
        <section class=" mt-10 p-10 rounded-md shadow-md">
            <h2 class="md:text-2xl text-pink-600 text-center font-bold"> Ajouter une catégorie </h2>

            <form action="{{ route('categories.store') }}" method="POST" class=" mt-6 flex flex-col space-y-4 max-w-md mx-auto">
                @csrf
                <div>
                    <label for="name" class=" block font-semibold mb-2 text-gray-700 text-sm">Nom de la catégorie </label>
                    <input type="text" name="name" id="name" class=" w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name') }}" required>
                    <x-error field="name" />
                </div>
                <div class=" flex justify-center text-sm">
                    <button type="submit" class=" bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-500">Ajouter la catégorie</button>
                </div>
            </form>
        </section>


</x-layouts.app>