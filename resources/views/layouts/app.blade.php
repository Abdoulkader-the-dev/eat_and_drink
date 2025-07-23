<!DOCTYPE html>
<html lang="en" data-theme="acid">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eat & Drink - @yield('title', 'Accueil')</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200 text-base-content flex flex-col">

    <!-- Header -->
    <header class="navbar bg-base-100 shadow-md px-6">
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-primary">Bienvenue à Eat & Drink</h1>
        </div>
        <nav class="flex-none flex gap-4">
            <a href="{{ route('public.stands.index') }}" class="btn btn-outline btn-primary btn-sm">Nos Exposants</a>
            <a href="{{ route('cart.view') }}" class="btn btn-outline btn-secondary btn-sm relative">
                Panier
                @php
                    $cart = Session::get('cart', []);
                    $cartItemCount = array_sum(array_column($cart, 'quantite'));
                @endphp
                @if($cartItemCount > 0)
                    <span class="badge badge-error absolute -top-2 -right-2 text-xs">
                        {{ $cartItemCount }}
                    </span>
                @endif
            </a>
             <a href="{{ route('login') }}" class="btn btn-outline btn-primary btn-sm">Se connecter</a>
        </nav>
    </header>

    <!-- Flash messages -->
    <main class="flex-1 container mx-auto px-6 py-6">
        @if (session('success'))
            <div class="alert alert-success shadow-lg mb-4">
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error shadow-lg mb-4">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer footer-center bg-base-300 text-base-content p-4">
        <p>&copy;{{ date('Y') }} Eat & Drink, Tous droits réservés</p>
    </footer>

</body>
</html>
