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
        
        <h1  style=" font-size:2em; color:darkorange; font-weight: bold; text-align:center">Réinitialisation de mot de passe !</h1>
        <p >Cher(ère), {{ $user->name }}</p>
        <p >Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.</p>
        <p style="text-align:center">  <a href="{{ $url }}"  style="background-color: darkorange; color:white; text-align:center; padding:0.5em; text-decoration:none">Réinitialiser mon mot de passe</a></p>
        <p> Ce lien de réinitialisation de mot de passe expirera dans 60 minutes </p>
        <p> Si vous n’avez pas demandé la réinitialisation, aucune action n’est requise.</p>
        <p >Merci de faire partie de notre communauté !</p> 
        <p style=" font-style:italic">Cordialement,<br>L'équipe MiniBlog</p>
    </div>  
</body>
</html>



