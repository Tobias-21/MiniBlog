<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié </title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">

    <h1 class="text-3xl text-center text-amber-800 font-bold">Mot de passe oublié</h1>    

    @if (session('status'))
        <div class="bg-green-200 text-green-700 p-4 rounded-md my-3">
            {{ session('status') }}
        </div>
    @elseif (session('email'))
        <div class="bg-red-200 text-red-700 p-4 rounded-md my-3">
            {{ session('email') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class=" w-full md:w-2xl lg:w-1/3 mt-10 p-10  bg-yellow-50 rounded-lg shadow-md" >
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Votre adresse mail</label>
            <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" value="{{ old('email') }}" >
            <x-error field="email" class="text-red-500 text-sm mt-1" />
        </div>

        <div class=" flex justify-end">
            <button type="submit" class=" bg-amber-800 text-white py-2 px-4 rounded-md hover:bg-amber-900">Soumettre</button>
        </div>

        <p class=" text-center mt-2"><a href="{{ route('login') }}" class=" font-medium text-sm hover:underline text-gray-600 "> Retourner à la page de connexion</a> </p>
    </form>
</body>
</html>