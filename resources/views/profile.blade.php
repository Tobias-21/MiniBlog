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
        Profile
    </x-slot:titre>

    <x-slot:title>
       Mon Profile
    </x-slot:title>

    <hr class=" my-5 text-gray-400">

    <h3 class=" font-light text-lg text-gray-800 "> Informations personnelles </h3>

    <div class="  my-5 flex justify-end text-sm ">
        <button class=" bg-pink-300 p-3" id="modifierButton"> Modifier mes informations </button>
    </div>

    <form action="{{ route('user.update', auth()->user()) }}" method="POST" class=" mt-6 flex flex-col space-y-4  mx-auto">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class=" block font-semibold mb-2 text-gray-700 text-sm">Nom </label>
            <input type="text" name="name" id="name" class=" bg-gray-200 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 profile" value="{{ old('name', $user->name) }}" required disabled>
            <x-error field="name" />
        </div>
        <div>
            <label for="email" class=" block font-semibold mb-2 text-gray-700 text-sm">Email </label>
            <input type="email" name="email" id="email" class=" bg-gray-200 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 profile" value="{{ old('email', $user->email) }}" required disabled>
            <x-error field="email" />
        </div>
        <div>
            <label for="password" class=" block font-semibold mb-2 text-gray-700 text-sm">Nouveau mot de passe (laisser vide pour conserver l'actuel)</label>
            <input type="password" name="password" id="password" class=" bg-gray-200 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 profile" disabled>
            <x-error field="password" />
        </div>
        <div>
            <label for="password_confirmation" class=" block font-semibold mb-2 text-gray-700 text-sm">Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class=" bg-gray-200 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 profile" disabled>
            <x-error field="password_confirmation" />
        </div>
        <div class=" flex justify-end">
            <button type="submit" class=" bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-500 hidden" id="buttonProfile">Mettre à jour</button>
        </div>

    </form>

    <h3 class=" font-light text-lg text-gray-800 mt-11 mb-5"> Informations supplémentaires </h3>
    <div class=" space-y-4 max-w-md">
        
        @if($user->role === 'admin')
            <p class=" text-gray-800 font-semibold"> Nombre de publications : <span class=" font-bold text-pink-600"> {{ $validé }} </span> </p>
            <p class=" text-gray-800 font-semibold"> Rôle : <span class=" font-bold text-pink-600"> Administrateur </span> </p>

        @else
            <p class=" text-gray-800 font-semibold"> Nombre de publications validées : <span class=" font-bold text-pink-600"> {{ $validé }} </span> </p>
            <p class=" text-gray-800 font-semibold"> Nombre de publications en attente : <span class=" font-bold text-pink-600"> {{ $en_attente }} </span> </p>
            <p class=" text-gray-800 font-semibold"> Rôle : <span class=" font-bold text-green-600"> Utilisateur </span> </p>
            <p class=" text-gray-800 font-semibold"> Statut : 
            @if($user->status === 'abonné')
                <span class=" font-bold text-green-600"> Abonné </span>
            @else
                <span class=" font-bold text-red-600"> Non abonné </span>
            @endif 
            </p> 
        @endif
       
    </div>
</x-layouts.app>