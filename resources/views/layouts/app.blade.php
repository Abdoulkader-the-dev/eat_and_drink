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
           <a href="{{ route('public.stands.index') }}" class="btn btn-outline btn-primary btn-sm gap-1">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
  </svg>
  Accueil
</a>
            <div class="flex gap-2">
    <!-- Exposants Button -->
    <a href="{{ route('public.stands.index') }}" class="btn btn-outline btn-primary btn-sm gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
        Nos Exposants
    </a>

    <!-- Cart Button with Badge -->
    <a href="{{ route('cart.view') }}" class="btn btn-outline btn-secondary btn-sm gap-1 relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        Panier
        @php
            $cart = Session::get('cart', []);
            $cartItemCount = array_sum(array_column($cart, 'quantite'));
        @endphp
        @if($cartItemCount > 0)
            <span class="badge badge-error absolute -top-2 -right-2 text-xs w-5 h-5 flex items-center justify-center p-0">
                {{ min($cartItemCount, 9) }}{{ $cartItemCount > 9 ? '+' : '' }}
            </span>
        @endif
    </a>
</div>
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
