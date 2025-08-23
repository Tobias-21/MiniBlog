<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$titre}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.tiny.cloud/1/cixo5jpt20prdy762p1g95716632exrs60xvkx5pth9c310b/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <header class=" bg-pink-500 text-white py-4 px-10">
    
        <nav class="flex justify-between items-center">
            <ul class="flex space-x-4">
                <li><a href="{{ route('articles.index') }}" class="text-white hover:underline">Articles</a></li>
                @auth
                <li><a href="{{ route('articles.create') }}" class="text-white hover:underline">Créer un article</a></li>
                <li> <a href="{{ route('articles.favoris') }}" class="text-white hover:underline">Mes Favoris</a> </li>
                <li><a href="{{ route('articles.en_attente') }}" class="text-white hover:underline">Articles en attente</a></li>
                <li>
                    @if (auth()->user() && auth()->user()->role === 'user')
                       
                    <form action="{{ route('user.subscribe') }}" method="POST" class="inline">
                        @csrf
                        @if(auth()->user()->status === 'abonné')
                            <button type="submit" class=" bg-amber-50 text-pink-500 px-2 py-1 rounded-2xl font-bold"> <i class="bi bi-bell-fill"></i> Se désabonné</button>
                        @else
                            <button type="submit" class=" bg-amber-50 text-pink-500 px-2 py-1 rounded-2xl font-bold"> <i class="bi bi-bell"></i> S'abonner</button>
                        @endif
                    </form> 
                    @endif
                </li>
               
                @endauth
                
            </ul>

            <ul class="flex space-x-4 float-right">
                @auth
                <li> {{ Auth::user()->name }} </li>
                <li><form action="{{ route('auth.logout') }}" method="POST" class="inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="text-white hover:underline">Déconnexion</button>
                    </form></li>
                @else
                    <li><a href="{{ route('login') }}" class="text-white hover:underline">Connexion</a></li>
                    <li><a href="{{ route('register') }}" class="text-white hover:underline">Inscription</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main class="container mx-auto p-4 max-w-4xl">
       
        <div>
            {{ $search ?? '' }}
        </div>


        <h1 class="text-3xl font-bold my-5 text-amber-500 text-center">{{ $title }}</h1>
        {{ $slot }}

    </main>
    
</body>
</html>