<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenue sur Eat & Drink</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="min-h-screen bg-base-200 flex items-center justify-center">
    <div class="w-full max-w-3xl mx-auto text-center px-4 py-8">

        {{-- Contenu visible pour TOUS les visiteurs (connectés ou non) --}}
        <h1 class="text-4xl font-extrabold text-primary mb-4">Bienvenue sur Eat & Drink !</h1>
        <p class="text-lg text-gray-700 mb-8">Découvrez les meilleurs stands et leurs produits.</p>

        {{-- Lien vers la liste des exposants --}}
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <a href="{{ route('app') }}" class="btn btn-primary btn-lg transition duration-300 ease-in-out hover:scale-105">
                Voir nos Exposants
            </a>

            {{-- Optionnel : lien vers le panier --}}
            <a href="{{ route('cart.view') }}" class="btn btn-info btn-lg transition duration-300 ease-in-out hover:scale-105">
                Voir mon Panier
            </a>
        </div>

        {{-- Contenu visible UNIQUEMENT si l'utilisateur est authentifié --}}
        @auth
            <div class="mt-12">
                <p class="text-2xl mb-4">Bienvenue de retour,
                    <span class="font-bold text-success-content ">
                        {{ Auth::user()->nom_entreprise ?? Auth::user()->nom }}
                    </span> 🥳
                </p>
                <span class="badge badge-warning text-lg mb-4">{{ Auth::user()->role }}</span>

                <div class="flex flex-wrap justify-center gap-4 mt-4">
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="btn btn-warning btn-wide transition duration-300 ease-in-out hover:scale-105 text-xl">Se déconnecter</button>
                    </form>
                    <a href="{{ route('dashboard') }}" class="btn btn-success text-xl btn-wide transition duration-300 ease-in-out hover:scale-105">
                        Mon Tableau de Bord
                    </a>
                </div>
            </div>
        @endauth

        {{-- Contenu visible UNIQUEMENT si l'utilisateur N'EST PAS authentifié --}}
        @guest
            <div class="mt-12">
                <p class="text-xl mb-4">Vous êtes un entrepreneur ?</p>
                <a href="{{ route('login') }}" class="btn btn-accent btn-wide transition duration-300 ease-in-out hover:scale-105">
                    Se connecter / S'inscrire
                </a>
            </div>
        @endguest

    </div>
</body>
</html>
