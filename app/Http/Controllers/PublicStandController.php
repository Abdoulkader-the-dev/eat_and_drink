<?php

namespace App\Http\Controllers;


use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicStandController extends Controller
{
    public function index()
    {
        $stands = Stand::all();
        return view('public.stands.index', compact('stands'));
    }
     public function productsByStand(Stand $stand)
    {

        $produits = $stand->produits()->orderBy('nom')->get();

        return view('public.stands.products', compact('stand', 'produits'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'nom_stand'   => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Stand::create([
            'nom_stand'      => $data['nom_stand'],
            'description'    => $data['description'],
            'utilisateur_id' => Auth::id(), // Get ID of the authenticated user
        ]);

        return redirect()->route('public.stands.index')->with('success', 'Stand ajouté avec succès !');
    }

}
