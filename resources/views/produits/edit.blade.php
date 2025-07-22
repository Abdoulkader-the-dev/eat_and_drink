@extends('layouts.app')

@section('title', 'Modifier le produit : {{ $produit->nom }}')

@section('content')
    <h2>Modifier le produit : {{ $produit->nom }}</h2>

    <form method="POST" action="{{ route('produits.update', $produit->id) }}">
        @csrf
        @method('PUT') {{-- Indique que c'est une requête PUT pour la mise à jour --}}

        <div>
            <label for="nom">Nom du produit:</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description', $produit->description) }}</textarea>
        </div>

        <div>
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" step="0.01" value="{{ old('prix', $produit->prix) }}" required>
        </div>

        <div>
            <label for="image_url">URL de l'image:</label>
            <input type="text" id="image_url" name="image_url" value="{{ old('image_url', $produit->image_url) }}">
        </div>

        <button type="submit">Mettre à jour le produit</button>
    </form>
@endsection