@extends('layouts.app')

@section('title', 'Modifier le produit : ' . $produit->nom)

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="card bg-base-100 shadow-lg">
        <div class="card-body">
            <h2 class="card-title text-3xl font-bold mb-2">Modifier le produit</h2>
            <div class="text-xl font-semibold text-primary mb-6">{{ $produit->nom }}</div>

            <form method="POST" action="{{ route('produits.update', $produit->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Nom Field -->
                <div class="form-control">
                    <label for="nom" class="label">
                        <span class="label-text">Nom du produit</span>
                    </label>
                    <input type="text" id="nom" name="nom"
                           value="{{ old('nom', $produit->nom) }}"
                           required
                           class="input input-bordered w-full focus:input-primary"
                           placeholder="Nom du produit">
                </div>

                <!-- Description Field -->
                <div class="form-control">
                    <label for="description" class="label">
                        <span class="label-text">Description</span>
                    </label>
                    <textarea id="description" name="description"
                              class="textarea textarea-bordered h-32 focus:textarea-primary"
                              placeholder="Description du produit">{{ old('description', $produit->description) }}</textarea>
                </div>

                <!-- Price Field -->
                <div class="form-control">
                    <label for="prix" class="label">
                        <span class="label-text">Prix</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">€</span>
                        <input type="number" id="prix" name="prix" step="0.01"
                               value="{{ old('prix', $produit->prix) }}"
                               required
                               class="input input-bordered w-full pl-8 focus:input-primary"
                               placeholder="0.00">
                    </div>
                </div>

                <!-- Image URL Field -->
                <div class="form-control">
                    <label for="image_url" class="label">
                        <span class="label-text">URL de l'image</span>
                    </label>
                    <input type="text" id="image_url" name="image_url"
                           value="{{ old('image_url', $produit->image_url) }}"
                           class="input input-bordered w-full focus:input-primary"
                           placeholder="https://example.com/image.jpg">
                    @if($produit->image_url)
                    <div class="mt-2">
                        <div class="text-sm text-gray-500 mb-1">Image actuelle:</div>
                        <img src="{{ $produit->image_url }}" alt="Product image" class="w-32 h-32 object-cover rounded-lg border">
                    </div>
                    @endif
                </div>

                <!-- Form Actions -->
                <div class="card-actions justify-end mt-8 space-x-3">
                    <a href="{{ route('produits.index') }}" class="btn btn-ghost">Annuler</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
