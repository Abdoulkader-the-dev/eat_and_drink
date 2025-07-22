@extends('layouts.app')

@section('title', 'Votre Panier')

@section('content')
    <h1>Votre Panier</h1>

    {{-- Affichage des messages de session (par exemple, "Produit ajouté au panier !") --}}
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Produit</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Prix Unitaire</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Quantité</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Total</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Actions</th>
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
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['product']->nom }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['product']->prix }} €</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['quantite'] }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ number_format($itemTotal, 2) }} €</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">
                            <form action="{{ route('cart.remove') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="produit_id" value="{{ $item['product']->id }}">
                                <button type="submit" style="background-color: #f44336; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">Retirer</button>
                            </form>
                            {{-- On pourrait ajouter des boutons pour modifier la quantité ici --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="padding: 12px; border: 1px solid #ddd; text-align: right; font-weight: bold;">Grand Total :</td>
                    <td colspan="2" style="padding: 12px; border: 1px solid #ddd; font-weight: bold;">{{ number_format($grandTotal, 2) }} €</td>
                </tr>
            </tfoot>
        </table>

        {{-- Section pour Passer la Commande --}}
        <div style="margin-top: 30px; text-align: right;">
            <a href="{{ route('checkout.show') }}" style="background-color: #008CBA; color: white; padding: 12px 20px; border: none; border-radius: 5px; text-decoration: none; font-size: 1.1em;">
                Passer la Commande
            </a>
        </div>

    @else
        <p>Votre panier est vide pour l'instant.</p>
        <a href="{{ route('public.stands.index') }}">Continuer vos achats</a>
    @endif
@endsection