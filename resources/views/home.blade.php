<!DOCTYPE html>
<html lang="en" data-theme="acid">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenue sur Eat & Drink</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="min-h-screen bg-base-200">
    <!-- Navigation -->
    <nav class="navbar bg-base-100 shadow-lg">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="btn btn-ghost normal-case text-xl font-bold text-primary">Eat & Drink</a>
        </div>
        <div class="flex-none gap-2">
            <a href="{{ route('public.stands.index') }}" class="btn btn-ghost">Exposants</a>
            <a href="{{ route('cart.view') }}" class="btn btn-ghost">Panier</a>
            @auth
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full bg-primary text-primary-content flex items-center justify-center">
                            <span class="text-xl font-bold">{{ substr(Auth::user()->nom_entreprise ?? Auth::user()->nom, 0, 1) }}</span>
                        </div>
                    </label>
                    <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <span class="font-bold">Bonjour, {{ Auth::user()->nom_entreprise ?? Auth::user()->nom }}</span>
                            <span class="badge badge-warning">{{ Auth::user()->role }}</span>
                        </li>
                        <li class="menu-title">
                            <span>Actions</span>
                        </li>
                        @if (Auth::user()->role === "entrepreneur_approuve" || Auth::user()->role === "admin")
                        <li><a href="{{ route('produits.index') }}">Mes produits</a></li>
                        <li><a href="{{ route('addStand') }}">Ajouter un stand</a></li>
                        @endif
                        @if (Auth::user()->role === "admin")
                        <li><a href="{{ route('dashboard') }}">Tableau de board</a></li>
                        @endif
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left">Se déconnecter</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero min-h-[70vh]" style="background-image: url(https://images.unsplash.com/photo-1514933651103-005eec06c04b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80);">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-3xl">
                <h1 class="mb-5 text-5xl font-bold">Bienvenue sur Eat & Drink !</h1>
                <p class="mb-5 text-xl">Découvrez les meilleurs stands et leurs produits.</p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('public.stands.index') }}" class="btn btn-primary btn-lg transition duration-300 ease-in-out hover:scale-105">
                        Voir nos Exposants
                    </a>
                    <a href="{{ route('cart.view') }}" class="btn btn-info btn-lg transition duration-300 ease-in-out hover:scale-105">
                        Voir mon Panier
                    </a>
                </div>

                @guest
                <div class="mt-8">
                    <p class="text-xl mb-4">Vous êtes un entrepreneur ?</p>
                    <a href="{{ route('login') }}" class="btn btn-accent btn-wide transition duration-300 ease-in-out hover:scale-105">
                        Se connecter / S'inscrire
                    </a>
                </div>
                @endguest
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Pourquoi choisir Eat & Drink ?</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="card bg-base-100 shadow-xl">
                    <a href="{{route('public.stands.index')}}">
                        <figure class="px-10 pt-10">
                            <div class="text-6xl">🍽️</div>
                        </figure>
                        <div class="card-body items-center text-center">
                            <h3 class="card-title">Diversité culinaire</h3>
                            <p>Découvrez une large sélection de stands offrant des spécialités uniques.</p>
                        </div>
                    </a>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <a href="{{ route('cart.view') }}">
                        <figure class="px-10 pt-10">
                            <div class="text-6xl">🛒</div>
                        </figure>
                        <div class="card-body items-center text-center">
                            <h3 class="card-title">Panier pratique</h3>
                            <p>Commandez facilement et gérez vos achats avec notre système de panier intuitif.</p>
                        </div>
                    </a>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <a href="{{ route('login') }}">
                        <figure class="px-10 pt-10">
                            <div class="text-6xl">🚀</div>
                        </figure>
                        <div class="card-body items-center text-center">
                            <h3 class="card-title">Opportunités business</h3>
                            <p>Pour les entrepreneurs, une plateforme idéale pour présenter vos produits.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer p-10 bg-base-100 text-base-content">
        <div>
            <span class="footer-title">Services</span>
            <a href="{{ route('public.stands.index') }}" class="link link-hover">Exposants</a>
            <a href="{{ route('cart.view') }}" class="link link-hover">Panier</a>
            @auth
            <a href="{{ route('addStand') }}" class="link link-hover">Ajouter un stand</a>
            @endauth
        </div>
        <div>
            <span class="footer-title">Entreprise</span>
            <a class="link link-hover">À propos</a>
            <a class="link link-hover">Contact</a>
            <a class="link link-hover">Conditions d'utilisation</a>
        </div>
        <div>
            <span class="footer-title">Réseaux sociaux</span>
            <div class="grid grid-flow-col gap-4">
                <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg></a>
                <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path></svg></a>
                <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg></a>
            </div>
        </div>
    </footer>
</body>
</html>
