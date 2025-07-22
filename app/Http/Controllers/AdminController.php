<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{

   /*  SELECT s.id, s.utilisateur_id, u.nom, u.prenom, s.nom_stand
            FROM stands s, utilisateurs u
            WHERE s.utilisateur_id = u.id AND role = "entrepreuneur_en_attente"
            ORDER BY u.nom ASC; */

    public function liste_demande_stand() {
        $results = DB::select('
        SELECT s.id, s.utilisateur_id, u.nom, u.prenom, s.nom_stand
            FROM stands s
            INNER JOIn utilisateurs u ON s.utilisateur_id = u.id
            WHERE role = "entrepreuneur_en_attente"
            ORDER BY u.nom ASC;
        ');

        // $results is an array of stdClass objects
        return view('admin.dashboard', ['results' => $results]);
    }
}
