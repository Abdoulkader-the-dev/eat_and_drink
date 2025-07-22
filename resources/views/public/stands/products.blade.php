@extends('layouts.app')

@section('title', 'Produits de ' . $stand->nom_stand)

@section('content')
    <a href="{{ route('public.stands.index') }}">Retour à la liste des stands</a>

    <h2>Produits du Stand : {{ $stand->nom_stand }}</h2>
    <p><strong>Description du stand :</strong> {{ $stand->description }}</p>

    @if($stand->utilisateur)
        <p><strong>Propriétaire du stand (Entreprise) :</strong> {{ $stand->utilisateur->nom_entreprise }}</p>
        <p><strong>Email de contact de l'entrepreneur :</strong> {{ $stand->utilisateur->email }}</p>
    @else
        <p>Ce stand n'a pas encore d'entrepreneur assigné.</p>
    @endif

    <h3>Nos produits :</h3>

    @if($produits->count() > 0)
        <div class="products-list">
            @foreach($produits as $produit)
                <div class="product-card" style="border: 1px dashed #eee; padding: 10px; margin-bottom: 20px;">
                    <h4>{{ $produit->nom }}</h4>
                    <p>{{ $produit->description }}</p>
                    <p>Prix : {{ $produit->prix }} €</p>
                    @if($produit->image_url)
                        <img src="{{ $produit->image_url }}" alt="Image de {{ $produit->nom }}" style="max-width: 150px; height: auto;">
                    @else
                        <p>Pas d'image disponible.</p>
                    @endif

                    {{-- NOUVELLE PARTIE : Formulaire "Ajouter au panier" --}}
                    <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                        <label for="quantity-{{ $produit->id }}">Quantité :</label>
                        <input type="number" id="quantity-{{ $produit->id }}" name="quantite" value="1" min="1" style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 3px;">
                        <button type="submit" style="background-color: #4CAF50; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;">Ajouter au panier</button>
                    </form>
                    {{-- FIN NOUVELLE PARTIE --}}
                </div>
            @endforeach
        </div>
    @else
        <p>Ce stand n'a pas encore de produits listés.</p>
    @endif
@endsection