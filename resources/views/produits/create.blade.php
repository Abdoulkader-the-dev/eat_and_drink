 @extends('layouts.app')

@section('title', 'Ajouter un nouveau produit')

@section('content')
    <h2>Ajouter un nouveau produit</h2>

    <form method="POST" action="{{ route('produits.store') }}">
        
        @csrf 

        <div>
            <label for="nom">Nom du produit:</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div>
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" step="0.01" required>
        </div>

        <div>
            <label for="image_url">URL de l'image:</label>
            <input type="text" id="image_url" name="image_url">
        </div>

        <button type="submit">Ajouter</button>
    </form>
@endsection