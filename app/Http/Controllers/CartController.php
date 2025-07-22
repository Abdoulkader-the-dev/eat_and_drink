<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Produit; 
use App\Models\Commande;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Ajoute un produit au panier.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $produitId = $request->input('produit_id');
        $quantite = $request->input('quantite');

        // Récupérer le panier actuel de la session
        // Si le panier n'existe pas, il sera un tableau vide
        $cart = Session::get('cart', []);

        // Vérifier si le produit est déjà dans le panier
        if (isset($cart[$produitId])) {
            // Si oui, augmenter la quantité
            $cart[$produitId]['quantite'] += $quantite;
        } else {
            // Si non, ajouter le nouveau produit au panier
            $produit = Produit::find($produitId); // Récupérer les détails du produit
            if ($produit) {
                $cart[$produitId] = [
                    'id' => $produit->id,
                    'nom' => $produit->nom,
                    'prix' => $produit->prix,
                    'quantite' => $quantite,
                    // Vous pouvez ajouter d'autres détails du produit si nécessaire, comme l'image_url, etc.
                ];
            }
        }

        // Sauvegarder le panier mis à jour dans la session
        Session::put('cart', $cart);

        // Optionnel : Rediriger l'utilisateur avec un message de succès
        return back()->with('success', 'Produit ajouté au panier !');
    }

    /**
     * Affiche le contenu du panier. (Nous l'implémenterons dans la prochaine étape si tout se passe bien)
     */
    public function viewCart()
    {
        $cart = Session::get('cart', []);
        // Si vous voulez récupérer les objets Produit complets pour chaque item du panier
        $cartItems = [];
        foreach ($cart as $item) {
            $product = Produit::find($item['id']);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantite' => $item['quantite']
                ];
            }
        }
        return view('public.cart.index', compact('cartItems'));
    }

    /**
     * Supprime un produit du panier ou réduit sa quantité.
     */
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            // 'quantite' => 'integer|min:1', // Optionnel : pour réduire la quantité au lieu de supprimer
        ]);

        $produitId = $request->input('produit_id');
        $cart = Session::get('cart', []);

        if (isset($cart[$produitId])) {
            // Option 1: Supprimer complètement l'article
            unset($cart[$produitId]);

            // Option 2: Réduire la quantité (si implémenté)
            // $quantiteASupprimer = $request->input('quantite', $cart[$produitId]['quantite']);
            // $cart[$produuitId]['quantite'] -= $quantiteASupprimer;
            // if ($cart[$produitId]['quantite'] <= 0) {
            //     unset($cart[$produitId]);
            // }
        }

        Session::put('cart', $cart);
        return back()->with('success', 'Produit retiré du panier !');
    }

    /**
     * Affiche le formulaire de finalisation de la commande (checkout).
     */
    public function showCheckoutForm()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Votre panier est vide. Ajoutez des produits avant de passer commande.');
        }

        $cartItems = [];
        $grandTotal = 0;

        foreach ($cart as $item) {
            $product = Produit::find($item['id']);
            if ($product) {
                $itemTotal = $product->prix * $item['quantite'];
                $grandTotal += $itemTotal;
                $cartItems[] = [
                    'product' => $product,
                    'quantite' => $item['quantite'],
                    'total' => $itemTotal
                ];
            }
        }

        // Nous allons créer la vue resources/views/public/checkout/show.blade.php
        return view('public.checkout.show', compact('cartItems', 'grandTotal'));
    }

    /**
     * Traite la soumission de la commande.
     */
    public function placeOrder(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Votre panier est vide. Impossible de passer une commande.');
        }

        // Valider les informations du formulaire de commande si vous en ajoutez (ex: nom, adresse, tel)
        // Pour ce TP, une simple soumission suffit, donc pas de validation complexe pour l'instant.

        // Préparer les détails de la commande pour la base de données
        $orderDetails = [];
        $totalCommande = 0;
        $standIdForOrder = null; // Nous devrons décider à quel stand la commande est associée.

        foreach ($cart as $item) {
            $product = Produit::find($item['id']);
            if ($product) {
                $orderDetails[] = [
                    'produit_id' => $product->id,
                    'nom_produit' => $product->nom,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $product->prix,
                    'sous_total' => $product->prix * $item['quantite'],
                ];
                $totalCommande += ($product->prix * $item['quantite']);

                // S'il n'y a qu'un seul stand par commande, prenez le premier ID de stand
                if (is_null($standIdForOrder)) {
                    $standIdForOrder = $product->stand_id;
                }
                // NOTE: Si une commande peut contenir des produits de plusieurs stands,
                // il faudrait créer plusieurs commandes ou adapter la structure de la DB.
                // Pour ce TP, on va supposer une commande par stand ou un stand principal.
            }
        }

        if (is_null($standIdForOrder)) {
             return back()->with('error', 'Erreur: Impossible de déterminer le stand pour cette commande.');
        }

        try {
            DB::beginTransaction();

            // Créer une nouvelle commande
            $commande = new Commande();
            $commande->stand_id = $standIdForOrder;
            // Stocke les détails sous forme de JSON (nécessite 'details_commande' de type TEXT dans la migration)
            $commande->details_commande = json_encode($orderDetails);
            $commande->date_commande = now(); // Utilise la date et l'heure actuelles
            // Optionnel: ajouter un champ 'total' à la table commandes si nécessaire
            // $commande->total = $totalCommande;
            $commande->save();

            DB::commit();

            // Vider le panier après une commande réussie
            Session::forget('cart');

            return redirect('/')->with('success', 'Votre commande a été passée avec succès ! Total : ' . number_format($totalCommande, 2) . ' €');

        } catch (\Exception $e) {
            DB::rollBack();
            // Gérer l'erreur, par exemple, logguer l'erreur et rediriger avec un message d'erreur
            return back()->with('error', 'Une erreur est survenue lors du passage de votre commande. Veuillez réessayer. Détails: ' . $e->getMessage());
        }
    }
}