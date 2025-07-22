@extends('layouts.app')

@section('title', 'Produits de ' . $stand->nom_stand)

@section('content')
<a href="{{ route('public.stands.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Retour à la liste des stands</a>

<h2 class="text-3xl font-semibold mb-2">Produits du Stand : {{ $stand->nom_stand }}</h2>
<p class="mb-6"><strong>Description du stand :</strong> {{ $stand->description }}</p>

@if($stand->utilisateur)
    <p><strong>Propriétaire du stand (Entreprise) :</strong> {{ $stand->utilisateur->nom_entreprise }}</p>
    <p class="mb-6"><strong>Email de contact de l'entrepreneur :</strong> {{ $stand->utilisateur->email }}</p>
@else
    <p class="mb-6">Ce stand n'a pas encore d'entrepreneur assigné.</p>
@endif

<h3 class="text-2xl font-semibold mb-4">Nos produits :</h3>

@if($produits->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($produits as $produit)
            <div
                class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-lg transition-shadow duration-300 ease-in-out transform hover:-translate-y-1"
                data-theme="cupcake"
            >
                <h4 class="text-xl font-semibold mb-2">{{ $produit->nom }}</h4>
                <p class="text-gray-700 mb-2">{{ $produit->description }}</p>
                <p class="font-semibold mb-3">Prix : {{ $produit->prix }} €</p>

                {{-- @if($produit->image_url)
                    <img
                        src="{{ $produit->image_url }}"
                        alt="Image de {{ $produit->nom }}"
                        class="max-w-full h-auto rounded mb-3 object-cover"
                        style="max-height: 150px;"
                    >
                @else
                    <p class="italic text-gray-400 mb-3">Pas d'image disponible.</p>
                @endif --}}

                {{-- Formulaire "Ajouter au panier" --}}
                <form action="{{ route('cart.add') }}" method="POST" class="flex items-center space-x-2">
                    @csrf
                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                    <label for="quantity-{{ $produit->id }}" class="text-sm">Quantité :</label>
                    <input
                        type="number"
                        id="quantity-{{ $produit->id }}"
                        name="quantite"
                        value="1"
                        min="1"
                        class="w-16 px-2 py-1 border border-gray-300 rounded text-center focus:outline-none focus:ring-2 focus:ring-green-400"
                    >
                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors duration-200"
                    >
                        Ajouter au panier
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@else
    <p>Ce stand n'a pas encore de produits listés.</p>
@endif
@endsection
