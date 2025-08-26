<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication validé</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    
    
</head>

<body >
    <div >
        
        <h1  style=" font-size:2em; color:darkorange; font-weight: bold; text-align:center">Publication validé !</h1>
        <p >Cher(ère), {{ $publication->user->name }}</p>
        <p >Votre publication intitulé "<span  style="font-weight: bolder;">{{ $publication->title }}</span>" a été validé sur MiniBlog.</p>
        <p >Vous pouvez le lire en cliquant sur le lien ci-dessous :</p>
        <a href="{{ route('publications.show', ['slug' => $publication->slug]) }}"  style="background-color: darkorange; color:white; text-align:center; padding:0.5em; text-decoration:none">Lire l'publication</a>
        <p >Merci de faire partie de notre communauté !</p>
        <p style=" font-style:italic">Cordialement,<br>L'équipe MiniBlog</p>
    </div>  
</body>
</html>



