<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Article Publié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    
    
</head>

<body class=" container mx-auto p-4 max-w-4xl bg-gray-100">
    <div class=" bg-white p-6 rounded-lg shadow-md">
        <h1 class=" text-3xl font-bold mb-4 text-amber-500">Un nouvel article a été publié !</h1>
        <p class=" text-gray-700 mb-4">Bonjour, {{ $article->user->name }}</p>
        <p class=" text-gray-700 mb-4">Un nouvel article intitulé "<span class=" font-semibold">{{ $article->title }}</span>" a été publié sur MiniBlog.</p>
        <p class=" text-gray-700 mb-4">Vous pouvez le lire en cliquant sur le lien ci-dessous :</p>
        <a href="{{ route('articles.show', ['slug' => $article->slug]) }}" class=" text-white mb-4 bg-amber-500 py-2 px-1">Lire l'article</a>
        <p class=" text-gray-700">Merci de faire partie de notre communauté !</p>
        <p class=" text-gray-700 mt-4 fst-italic">Cordialement,<br>L'équipe MiniBlog</p>
    </div>  
</body>
</html>



