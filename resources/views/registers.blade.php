<!DOCTYPE html>
<html lang="fr">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" flex flex-col items-center justify-center min-h-screen bg-gray-100">


    <h1 class=" text-3xl text-center text-blue-600 font-bold "> Insription </h1>    

    <form action="{{ route('users.store') }}" method="POST"  class=" mx-auto mt-10 p-10 md:w-2xl w-1/2 bg-yellow-50 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" >
            <x-error field="name" class="text-red-500 text-sm mt-1" />
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" >
            <x-error field="email" class="text-red-500 text-sm mt-1" />
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" id="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" >
            <x-error field="password" class="text-red-500 text-sm mt-1" />
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2">
            <x-error field="password_confirmation" class="text-red-500 text-sm mt-1" />
        </div>

        <button type="submit" class="w-full bg-emerald-600 text-white py-2 px-4 rounded-md hover:bg-emerald-700">S'inscrire</button>

        <p class=" text-center text-gray-600 font-medium pt-5"> Vous avez déjà un compte ? <a href=" {{ route('login') }} " class=" text-center text-blue-600 hover:underline"> Connectez-vous </a>





        </p>
    </form>

</body>
</html>