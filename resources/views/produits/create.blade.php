@extends('layouts.app')

@section('title', 'Ajouter un nouveau produit')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-2xl font-bold mb-6">Ajouter un nouveau produit</h2>

                <form method="POST" action="{{ route('produits.store') }}" class="space-y-4">
                    @csrf

                    <div class="form-control">
                        <label for="nom" class="label">
                            <span class="label-text">Nom du produit</span>
                        </label>
                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            required
                            class="input input-bordered w-full"
                            placeholder="Entrez le nom du produit">
                    </div>

                    <div class="form-control">
                        <label for="description" class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            class="textarea textarea-bordered h-24"
                            placeholder="Décrivez le produit"></textarea>
                    </div>

                    <div class="form-control">
                        <label for="prix" class="label">
                            <span class="label-text">Prix</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">€</span>
                            <input
                                type="number"
                                id="prix"
                                name="prix"
                                step="0.01"
                                required
                                class="input input-bordered w-full pl-8"
                                placeholder="0.00">
                        </div>
                    </div>

                    <div class="form-control">
                        <label for="image_url" class="label">
                            <span class="label-text">URL de l'image</span>
                        </label>
                        <input
                            type="text"
                            id="image_url"
                            name="image_url"
                            class="input input-bordered w-full"
                            placeholder="https://example.com/image.jpg">
                    </div>

                    <div class="card-actions justify-end mt-6">
                        <button type="submit" class="btn btn-primary">
                            Ajouter le produit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
