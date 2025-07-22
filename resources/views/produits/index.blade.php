 @extends('layouts.app')
@section('title', 'Mes Produits')

@section('content')
<h2>Mes Produits</h2>
<a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter un nouveau produit</a>
<p>Voici la liste de vos produits disponibles :</p>
    @if($produits->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->description }}</td>
                        <td> {{ $produit->prix }}</td>
                        <td>
                           <a href="{{ route('produits.edit', $produit->id) }}">Modifier</a>
    
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</button>
                            </form>
                        </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    @else
       <p>Vous n'avez pas encore ajouté de produits. <a href="{{ route('produits.create') }}">Cliquez ici pour en ajouter un !</a></p>
    @endif
@endsection