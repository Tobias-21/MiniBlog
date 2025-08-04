<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$titre}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <header class=" bg-pink-500 text-white py-4 px-10">
    
        <nav>
            <ul class="flex space-x-4">
                <li><a href="{{ route('articles.index') }}" class="text-white hover:underline">Articles</a></li>
                <li><a href="{{ route('articles.create') }}" class="text-white hover:underline">Créer un article</a></li>
            </ul>
        </nav>
    </header>

    <main class="container mx-auto p-4 max-w-4xl">
       
        <h1 class="text-3xl font-bold my-5 text-amber-500 text-center">{{ $title }}</h1>
        {{ $slot }}

    </main>
    
</body>
</html>