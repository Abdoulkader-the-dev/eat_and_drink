@extends('layouts.app')

@section('title', 'Produits de ' . $stand->nom_stand)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <a href="{{ route('public.stands.index') }}" class="btn btn-ghost mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Retour à la liste des stands
    </a>

    <!-- Stand Header -->
    <div class="card bg-base-100 shadow-lg mb-8">
        <div class="card-body">
            <h2 class="card-title text-3xl mb-2">Produits du Stand : {{ $stand->nom_stand }}</h2>
            <p class="text-lg mb-4"><span class="font-semibold">Description :</span> {{ $stand->description }}</p>

            @if($stand->utilisateur)
                <div class="bg-base-200 p-4 rounded-lg">
                    <p class="font-semibold">Propriétaire du stand :</p>
                    <p class="text-lg">{{ $stand->utilisateur->nom_entreprise }}</p>
                    <p class="font-semibold mt-2">Email de contact :</p>
                    <a href="mailto:{{ $stand->utilisateur->email }}" class="link link-primary">{{ $stand->utilisateur->email }}</a>
                </div>
            @else
                <div class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Ce stand n'a pas encore d'entrepreneur assigné.</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Products Section -->
    <h3 class="text-2xl font-bold mb-6">Nos produits :</h3>

    @if($produits->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($produits as $produit)
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <!-- Product Image Placeholder -->
                    <figure class="px-6 pt-6">
                        @if($produit->image_url)
                            <img src="{{ $produit->image_url }}" alt="{{ $produit->nom }}" class="rounded-xl h-48 w-full object-cover">
                        @else
                            <div class="bg-base-200 rounded-xl flex items-center justify-center h-48 w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-base-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </figure>

                    <div class="card-body">
                        <h4 class="card-title">{{ $produit->nom }}</h4>
                        <p class="text-base-content/70">{{ $produit->description }}</p>
                        <p class="text-xl font-bold mt-2">{{ number_format($produit->prix, 2) }} €</p>

                        <!-- Add to Cart Form -->
                        <div class="card-actions mt-4">
                            <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                <div class="flex items-center gap-2">
                                    <input
                                        type="number"
                                        name="quantite"
                                        value="1"
                                        min="1"
                                        class="input input-bordered w-20 text-center"
                                    >
                                    <button type="submit" class="btn btn-primary flex-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                        </svg>
                                        Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>Ce stand n'a pas encore de produits listés.</span>
            </div>
        </div>
    @endif
</div>
@endsection
