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
    <header class=" bg-pink-500 text-white py-4 px-20 ">
    
        <nav class=" flex justify-between" >
            <div class="flex space-x-7">
                <ul>
                    <li>
                        <button id="dropButton" class=" text-white focus:outline-none">
                            Publications <i class="bi bi-caret-down-fill"></i>
                        </button>
                    </li>
                    <div id="dropMenu" class=" absolute left-2 mt-6 items-center hidden p-6 bg-pink-400 rounded shadow-md">
                        <li class=" mb-3"><a href="{{ route('publications.index') }}" class="text-white hover:text-pink-600">Toutes les Publications</a></li>
                        @auth
                            <li class=" mb-3"> <a href="{{ route('mes_publications') }}" class="text-white hover:text-pink-600">Mes Publications</a> </li>                    
                            <li class=" mb-3"><a href="{{ route('publications.create') }}" class="text-white hover:text-pink-600">Créer une publication</a></li>
                            
                            <li><a href="{{ route('publications.en_attente') }}" class="text-white hover:text-pink-600">Publications en attente</a></li>
                        @endauth
                    </div>
                </ul>
                    @auth
                        <ul>
                            <li> <a href="{{ route('publications.favoris') }}" class="text-white hover:underline">Mes Favoris</a> </li>
                        </ul>
                        
                        @if (auth()->user() && auth()->user()->role === 'user')
                            <form action="{{ route('user.subscribe') }}" method="POST" class="inline">
                                @csrf
                                @if(auth()->user()->status === 'abonné')
                                    <button type="submit" class=" bg-amber-50 text-pink-500 px-3 py-1 rounded-2xl font-bold"> <i class="bi bi-bell-fill"></i> Se désabonné</button>
                                @else
                                    <button type="submit" class=" bg-amber-50 text-pink-500 px-3 py-1 rounded-2xl font-bold"> <i class="bi bi-bell"></i> S'abonner</button>
                                @endif
                            </form> 
                        @endif
                    @endauth
            </div>
           
            
            <div class=" flex space-x-4 items-center">   
                @auth
                <ul>
                    <li>
                        <button id="dropButtonProfile" class=" text-white focus:outline-none">
                            {{ Auth::user()->name }}  <i class="bi bi-caret-down-fill"></i>
                        </button>
                    </li>
                    
                    <div class=" absolute mt-6 right-2 hidden bg-pink-400 rounded-md shadow-md p-4" id ="dropMenuProfile">
                    
                        <li class=" mb-3"><form action="{{ route('auth.logout') }}" method="POST" class="inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="text-white hover:underline">Déconnexion</button>
                            </form>
                        </li>
                    </div>
                
                </ul>
            
                @else
                    <ul class=" flex space-x-4">
                        <li><a href="{{ route('login') }}" class="text-white hover:underline">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="text-white hover:underline">Inscription</a></li>
                    </ul>
                @endauth
                
           </div> 
        </nav>
    </header>

    <main class="container mx-auto p-4 max-w-4xl mt-5">
       
        <div>
            {{ $search ?? '' }}
        </div>


        <h1 class="text-3xl font-bold my-5 text-amber-500 text-center">{{ $title }}</h1>
        {{ $slot }}

    </main>
    
</body>
</html>