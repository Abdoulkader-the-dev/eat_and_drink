@extends('layouts.app')
@section('title', 'Mes Produits')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-primary">Mes Produits</h2>
        <a href="{{ route('produits.create') }}" class="btn btn-primary gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Ajouter un nouveau produit
        </a>
    </div>

    @if($produits->count() > 0)
        <div class="bg-base-100 rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-200">
                            <th class="text-left px-6 py-4">Nom</th>
                            <th class="text-left px-6 py-4">Description</th>
                            <th class="text-right px-6 py-4">Prix</th>
                            <th class="text-center px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produits as $produit)
                            <tr class="hover:bg-base-200 transition-colors duration-200">
                                <td class="px-6 py-4 font-medium">{{ $produit->nom }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $produit->description }}</td>
                                <td class="px-6 py-4 text-right font-bold">{{ number_format($produit->prix, 2) }} €</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-outline btn-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Modifier
                                        </a>
                                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline btn-error"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>Vous n'avez pas encore ajouté de produits. <a href="{{ route('produits.create') }}" class="font-bold underline">Cliquez ici pour en ajouter un !</a></span>
            </div>
        </div>
    @endif
</div>
@endsection
