<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">

    <h1 class="text-3xl text-center text-pink-700 font-bold">Connexion</h1>    

    @if (session('success'))
        <div class="bg-green-200 text-green-700 p-4 rounded-md my-3">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-200 text-red-700 p-4 rounded-md my-3">
            {{ session('error') }}
        </div>
    @elseif (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>

    @endif


    <form action="{{ route('auth.doLogin') }}" method="POST" class=" w-full md:w-2xl lg:w-1/3 mt-10 p-10  bg-yellow-50 rounded-lg shadow-md" >
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" value="{{ old('email') }}" >
            <x-error field="email" class="text-red-500 text-sm mt-1" />
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" id="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" value="{{ old('password') }}" >
            <x-error field="password" class="text-red-500 text-sm mt-1" />
        </div>

        <div class="sm:flex justify-between items-center mb-2 block">
            <p>
                <input type="checkbox" name="remember" id="remember" class="mr-1">
                <label for="remember" class="text-sm text-gray-600"> Se souvenir de moi </label>
            </p>
            <a href="{{ route('password.request') }}" class=" text-gray-700 text-sm text-end my-3"> Mot de passe oublié </a>
        </div>

        <button type="submit" class="w-full bg-pink-600 text-white py-2 px-4 rounded-md hover:bg-pink-700">Se connecter</button>

        <p class=" text-center font-medium pt-5 text-gray-600"> Vous n'avez pas de compte? <a href=" {{ route('register') }} " class=" font-medium hover:underline text-blue-600 "> S'inscrire </a> </p>
    </form>
</body>
</html>