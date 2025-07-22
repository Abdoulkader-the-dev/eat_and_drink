<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eat & Drink - @yield('title', 'Accueil')</title> {{-- AJOUTÉ: @yield('title') --}}
</head>
<body>
    <header>
        <h1>Bienvenue à Eat & Drink</h1>
        {{--<nav>--}}
            {{--<a href="/">Accueil</a>  Mieux de mettre la route '/' pour l'accueil --}}
            {{--<a href="{{ route('produits.index') }}">Mes Produits</a>  AJOUTÉ: Lien vers vos produits --}}
            {{-- Vous pouvez ajouter d'autres liens de navigation ici, par exemple pour la connexion/déconnexion --}}
    <a href="{{ route('public.stands.index') }}" style="margin-right: 20px;">Nos Exposants</a>
    <a href="{{ route('cart.view') }}" style="margin-right: 20px;">Panier</a> {{-- NOUVEAU LIEN --}}
    {{-- Autres liens (Accueil, Connexion/Déconnexion, etc.) --}}

    {{-- Afficher le nombre d'articles dans le panier (optionnel, nécessite JS ou rechargement de page) --}}
    @php
        $cart = Session::get('cart', []);
        $cartItemCount = array_sum(array_column($cart, 'quantite')); // Somme des quantités
        // Ou juste le nombre d'articles uniques: count($cart);
    @endphp
    @if($cartItemCount > 0)
        <span style="background-color: red; color: white; border-radius: 50%; padding: 2px 7px; font-size: 0.8em;">{{ $cartItemCount }}</span>
    @endif
</nav>
    </header>
    <main>
        {{-- AJOUTÉ: Gestion des messages flash (succès, erreur) --}}
        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content') {{-- AJOUTÉ: @yield('content') pour le contenu principal de la page --}}
    </main>
    <footer>
        <p>
            &copy;{{ date('Y') }} Eat & Drink, Tous droits réservés
        </p>
    </footer>
</body>
</html>