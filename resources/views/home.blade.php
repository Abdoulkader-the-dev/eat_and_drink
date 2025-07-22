<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenue sur Eat & Drink</title> {{-- Titre plus pertinent --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="w-screen h-screen flex flex-col items-center justify-center space-between gap-20" data-theme="cupcake">

        {{-- Contenu visible pour TOUS les visiteurs (connectés ou non) --}}
        <h1 class="text-5xl font-bold mb-8">Bienvenue sur Eat & Drink !</h1>
        <p class="text-xl text-center mb-12">Découvrez les meilleurs stands et leurs produits.</p>

        {{-- Lien vers la liste des exposants (vitrine publique) --}}
        <a href="{{ route('public.stands.index') }}" class="btn btn-primary btn-lg border border-4 border-secondary m-4">
            Voir nos Exposants
        </a>

        {{-- Optionnel : lien vers le panier --}}
        <a href="{{ route('cart.view') }}" class="btn btn-info btn-lg border border-4 border-secondary m-4">
            Voir mon Panier
        </a>

        {{-- Contenu visible UNIQUEMENT si l'utilisateur est authentifié --}}
        @auth
            <div class="mt-12 text-center">
                <p class="text-4xl">Bienvenue de retour, {{ Auth::user()->nom_entreprise ?? Auth::user()->nom }} ! 🥳🥳🥳</p>
                <form action="/logout" method="POST" class="mt-4">
                    @csrf
                    <button class="btn btn-warning btn-wide border border-4 border-secondary m-4">Se déconnecter</button>
                </form>
                {{-- Vous pouvez ajouter ici des liens vers le tableau de bord de l'entrepreneur si authentifié --}}
                <a href="/dashboard" class="btn btn-success btn-wide border border-4 border-secondary m-4">Mon Tableau de Bord</a>
            </div>
        @endauth

        {{-- Contenu visible UNIQUEMENT si l'utilisateur N'EST PAS authentifié --}}
        @guest
            <div class="mt-12 text-center">
                <p class="text-xl">Vous êtes un entrepreneur ?</p>
                <a href="{{ route('login') }}" class="btn btn-accent btn-wide border border-4 border-secondary m-4">
                    Se connecter / S'inscrire
                </a>
            </div>
        @endguest
    </div>
    @endauth
</body>
</html>
