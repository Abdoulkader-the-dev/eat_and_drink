<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur; 
use App\Mail\DemandeApprouvee; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Log; 

class AdminController extends Controller
{
    public function liste_demande_stand()
    {
        // Récupère l'email en plus du nom de l'entreprise et de l'ID
        $results = DB::select('
            SELECT id, nom_entreprise, email
            FROM utilisateurs
            WHERE role = "entrepreneur_en_attente"
            ORDER BY id ASC;
        ');

        // Assurez-vous que la vue 'admin.dashboard' existe et est correcte
        return view('admin.dashboard', ['results' => $results]);
    }

    public function liste_stand()
    {
        $results = DB::select('
            SELECT s.id, s.utilisateur_id, u.nom_entreprise, s.nom_stand
            FROM stands s
            INNER JOIN utilisateurs u ON s.utilisateur_id = u.id
            WHERE u.role = "entrepreneur_approuve"
            ORDER BY s.id ASC;
        ');

        // Assurez-vous que la vue 'admin.stand' existe et est correcte
        return view('admin.stand', ['results' => $results]);
    }

    public function approuved(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:utilisateurs,id', // Valide que l'ID est présent et existe dans la table utilisateurs
        ]);

        $userId = $request->input('id');
        $entrepreneur = Utilisateur::find($userId); // Récupère l'utilisateur complet via le modèle Eloquent

        if (!$entrepreneur) {
            return back()->with('error', 'Entrepreneur non trouvé.');
        }

        // Mettre à jour le rôle de l'entrepreneur
        $entrepreneur->role = 'entrepreneur_approuve';
        $entrepreneur->save();

        try {
            // Envoyer l'e-mail de notification à l'entrepreneur
            Mail::to($entrepreneur->email)->send(new DemandeApprouvee($entrepreneur));
            Log::info('Email d\'approbation envoyé à ' . $entrepreneur->email); // Log pour confirmation
            return back()->with('success', 'Entrepreneur approuvé et email de notification envoyé !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email d\'approbation à ' . $entrepreneur->email . ': ' . $e->getMessage());
            return back()->with('error', 'Entrepreneur approuvé, mais échec de l\'envoi de l\'email de notification. Erreur: ' . $e->getMessage());
        }
    }

    public function reject(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:utilisateurs,id', // Valide que l'ID est présent
        ]);

        $userId = $request->input('id');
        $entrepreneur = Utilisateur::find($userId);

        if (!$entrepreneur) {
            return back()->with('error', 'Entrepreneur non trouvé.');
        }

        
        

        
        // $entrepreneur->delete();

        return redirect()->route('dashboard')->with('success', 'Entrepreneur refusé avec succès.');
    }
}
