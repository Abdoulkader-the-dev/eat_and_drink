@extends('layouts.app')

@section('title', 'Finaliser votre commande')

@section('content')
    <h1>Finaliser votre commande</h1>

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
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Sous-Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['product']->nom }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['product']->prix }} €</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $item['quantite'] }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ number_format($item['total'], 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="padding: 12px; border: 1px solid #ddd; text-align: right; font-weight: bold;">Grand Total :</td>
                    <td style="padding: 12px; border: 1px solid #ddd; font-weight: bold;">{{ number_format($grandTotal, 2) }} €</td>
                </tr>
            </tfoot>
        </table>

        <div style="margin-top: 30px; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
            <h3>Détails de la Commande</h3>
            <p>Ici, vous pourriez ajouter des champs pour les informations du client (nom, adresse, téléphone) si elles n'étaient pas gérées par l'authentification.</p>
            <p>Pour ce TP, la simple confirmation du panier suffit.</p>

            <form action="{{ route('checkout.place') }}" method="POST" style="margin-top: 20px;">
                @csrf
                <button type="submit" style="background-color: #28a745; color: white; padding: 15px 25px; border: none; border-radius: 5px; font-size: 1.2em; cursor: pointer;">
                    Confirmer la Commande
                </button>
            </form>
        </div>

    @else
        <p>Votre panier est vide. <a href="{{ route('public.stands.index') }}">Retour à la liste des stands</a></p>
    @endif

    <div style="margin-top: 20px;">
        <a href="{{ route('cart.view') }}">Retour au panier</a>
    </div>
@endsection