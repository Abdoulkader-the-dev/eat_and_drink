<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Stand;

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
}