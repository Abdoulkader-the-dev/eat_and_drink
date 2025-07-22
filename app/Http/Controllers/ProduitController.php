<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;


class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vérifie si l'utilisateur est authentifié
        $user = Auth::user();
        //recupere tout les produit de la base de donnee
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation des données
        $validatedData = $request->validate(
            [
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'prix' => 'required|numeric|min:0.01',
                'image_url' => 'nullable|url|max:255',
            ],
            // Messages d'erreur 
            [
                'nom.required' => 'Le nom du produit est obligatoire.',
                'nom.string' => 'Le nom du produit doit être une chaîne de caractères.',
                'nom.max' => 'Le nom du produit ne doit pas dépasser :max caractères.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'prix.required' => 'Le prix du produit est obligatoire.',
                'prix.numeric' => 'Le prix doit être un nombre.',
                'prix.min' => 'Le prix doit être supérieur à zéro.',
                'image_url.url' => 'L\'URL de l\'image doit être une URL valide.',
                'image_url.max' => 'L\'URL de l\'image ne doit pas dépasser :max caractères.',
            ]
        );


        $user = Auth::user();


        $standId = $user->stand_id ?? 1; // Remplacez 1 par un ID de stand existant si vous n'avez pas encore lié l'utilisateur à un stand


        $produit = Produit::create([
            'nom' => $validatedData['nom'],
            'description' => $validatedData['description'],
            'prix' => $validatedData['prix'],
            'image_url' => $validatedData['image_url'],
            'stand_id' => $standId,
        ]);

        // 4. Rediriger avec un message de succès
        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        // 1. Validation des données
        $validatedData = $request->validate(
            [
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'prix' => 'required|numeric|min:0.01',
                'image_url' => 'nullable|url|max:255',
            ],
            [
                'nom.required' => 'Le nom du produit est obligatoire.',
                'nom.string' => 'Le nom du produit doit être une chaîne de caractères.',
                'nom.max' => 'Le nom du produit ne doit pas dépasser :max caractères.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'prix.required' => 'Le prix du produit est obligatoire.',
                'prix.numeric' => 'Le prix doit être un nombre.',
                'prix.min' => 'Le prix doit être supérieur à zéro.',
                'image_url.url' => 'L\'URL de l\'image doit être une URL valide.',
                'image_url.max' => 'L\'URL de l\'image ne doit pas dépasser :max caractères.',
            ]
        );

        // 2. Mise à jour du produit
        $produit->update($validatedData);

        // 3. Rediriger avec un message de succès
        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Produit $produit)
    {
        $produit->delete(); 

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès !');
    }
}
