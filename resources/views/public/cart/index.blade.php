@extends('layouts.app')

@section('title', 'Votre Panier')

@section('content')
<div class="p-6" data-theme="cupcake">
    <h1 class="text-3xl font-bold mb-6 text-center">Votre Panier</h1>

    {{-- Messages de session --}}
    @if(session('success'))
        <div class="alert alert-success shadow-lg mb-4">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error shadow-lg mb-4">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if(count($cartItems) > 0)
        <div class="overflow-x-auto">
            <table class="table w-full text-left table-zebra">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($cartItems as $item)
                        @php
                            $itemTotal = $item['product']->prix * $item['quantite'];
                            $grandTotal += $itemTotal;
                        @endphp
                        <tr>
                            <td>{{ $item['product']->nom }}</td>
                            <td>{{ $item['product']->prix }} €</td>
                            <td>{{ $item['quantite'] }}</td>
                            <td>{{ number_format($itemTotal, 2) }} €</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="produit_id" value="{{ $item['product']->id }}">
                                    <button type="submit" class="btn btn-error btn-sm">Retirer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="font-bold">
                        <td colspan="3" class="text-right">Grand Total :</td>
                        <td colspan="2">{{ number_format($grandTotal, 2) }} €</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Bouton Passer la Commande --}}
        <div class="mt-6 text-right">
            <a href="{{ route('checkout.show') }}" class="btn btn-primary btn-lg">
                Passer la Commande
            </a>
        </div>
    @else
        <div class="text-center mt-10">
            <p class="text-xl mb-4">Votre panier est vide pour l'instant.</p>
            <a href="{{ route('public.stands.index') }}" class="btn btn-secondary">
                Continuer vos achats
            </a>
        </div>
    @endif
</div>
@endsection
