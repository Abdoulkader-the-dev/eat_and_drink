<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{

    public function liste_demande_stand() {
        $results = DB::select('
        SELECT id, nom_entreprise
            FROM utilisateurs
            WHERE role = "entrepreneur_en_attente"
            ORDER BY id ASC;
        ');

        return view('admin.dashboard', ['results' => $results]);
    }
    public function liste_stand() {
        $results = DB::select('
        SELECT s.id, s.utilisateur_id, u.nom_entreprise, s.nom_stand
            FROM stands s
            INNER JOIn utilisateurs u ON s.utilisateur_id = u.id
            WHERE role = "entrepreneur_approuve"
            ORDER BY  s.id ASC;
        ');


        return view('admin.stand', ['results' => $results]);
    }

    public function approuved(Request $request){
        $id = $request->input('id');  // Get the stand ID

        DB::update("
            UPDATE utilisateurs
            SET role = ?
            WHERE id = ?
        ", ['entrepreneur_approuve', $id]);

        return redirect()->route('dashboard');
    }

     public function reject(Request $request){
        $id = $request->input('id');  // Securely get the stand ID

        DB::delete("DELETE FROM utilisateurs WHERE id = ?", [$id]);

        return redirect()->route('dashboard');
    }

}

