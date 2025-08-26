<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Publication Publié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>

<body >
    <div >
        <h1 style=" font-size:2em; color:darkorange; font-weight: bold; text-align:center">Publication rejetté !</h1>
        <p > Cher(ère), {{ $publication->user->name }}</p>
        <p  >Votre publication intitulé "<span class=" font-semibold" style=" font-weight:bold">{{ $publication->title }}</span>" a été rejetté.</p>
        <p >Malheureusement, après examen, nous avons décidé de ne pas publier votre publication sur notre plateforme. Nous vous encourageons à revoir le contenu et à le soumettre à nouveau en tenant compte des directives de notre communauté.</p>
        <p >Si vous avez des questions ou besoin d'assistance, n'hésitez pas à nous contacter.</p>
        <p >Merci de faire partie de notre communauté !</p>
        <p style=" font-style:italic">Cordialement,<br>L'équipe MiniBlog</p>
    </div>  
</body>
</html>