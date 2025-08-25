<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Article Publié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    
    
</head>

<body >
    <div >
       
        <h1 style=" font-size:2em; color:darkorange; font-weight: bold; text-align:center">Un nouvel article a été publié !</h1>
        <p>Cher(ère), {{ $article->user->name }}</p>
        <p >Un nouvel article intitulé "<span style="font-weight: bolder;">{{ $article->title }}</span>" a été publié sur MiniBlog.</p>
        <p >Vous pouvez le lire en cliquant sur le lien ci-dessous :</p>
        <a href="{{ route('articles.show', ['slug' => $article->slug]) }}" style="background-color: darkorange; color:white; text-align:center; padding:0.5em; text-decoration:none">Lire l'article</a>
        <p >Merci de faire partie de notre communauté !</p>
        <p style=" font-style:italic">Cordialement,<br>L'équipe MiniBlog</p>
    </div>  
</body>
</html>



