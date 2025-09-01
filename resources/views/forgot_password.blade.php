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

    @if (session('success'))
        <div class="bg-green-200 text-green-700 p-4 rounded-md my-3">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-200 text-red-700 p-4 rounded-md my-3">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('forgot_password.form') }}" method="POST" class=" w-full md:w-2xl lg:w-1/3 mt-10 p-10  bg-yellow-50 rounded-lg shadow-md" >
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" value="{{ old('email') }}" >
            <x-error field="email" class="text-red-500 text-sm mt-1" />
        </div>

        <div class="mb-4">
            <label for="new_password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
            <input type="password" name="new_password" id="new_password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" value="{{ old('new_password') }}" >
            <x-error field="new_password" class="text-red-500 text-sm mt-1" />
        </div>

        <div class="mb-5">
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-0 p-2" value="{{ old('new_password_confirmation') }}" >
            <x-error field="new_password_confirmation" class="text-red-500 text-sm mt-1" /> 
        </div>

        <button type="submit" class="w-full bg-amber-800 text-white py-2 px-4 rounded-md hover:bg-amber-900">Soumettre</button>
        
    </form>
</body>
</html>