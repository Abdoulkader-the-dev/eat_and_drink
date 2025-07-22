<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //---------Stand--------------
public function stand(Request $request)
{
    // Validation
    $validated = $request->validate([
        'nom'         => ['required', Rule::unique('stands', 'nom_stand')],
        'description' => ['nullable'],
        'email'       => ['required', 'email']
    ]);

    // Trouver l'utilisateur via son email
    $userId = Utilisateur::where('email', $validated['email'])->value('id');

    if (!$userId) {
        // Si aucun utilisateur trouvé
        return back()
            ->withErrors(['email' => 'Utilisateur introuvable.'])
            ->withInput();
    }

    // Créer le stand
    Stand::create([
        'nom_stand'       => $validated['nom'],
        'description'     => $validated['description'],
        'utilisateur_id'  => $userId, // Vérifie le bon nom de ta colonne
    ]);

    // Retour avec message de succès
    return back()->with('stand_success', 'Stand créé avec succès !');
}


//-----------------Connexion---------------
    public function login(Request $request){

        $dataform = $request->validate([
            'loginemail' => ['required', 'email'],
            'mot_de_passe' => ['required' , 'min:8'],
        ]);
        $credentials = [
        'email' => $dataform['loginemail'],
        'password' => $dataform['mot_de_passe'],
    ];

        if(Auth::attempt(['email' => $dataform['loginemail'],'password' => $dataform['mot_de_passe']])){
         $request->session()->regenerate();
         return redirect('/');
        }
         return back()->withErrors(['loginemail' => 'Informations d\'identification incorrectes.']);

    return back()->withErrors([
        'loginemail' => 'Email ou mot de pass incorrect.',
        'mot_de_passe' => 'Email ou mot de pass incorrect.',
    ])->onlyInput('loginemail');
}



//------------Deconnexion-----------------
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

//------------Inscription-----------------
    public function register(Request $request){
        $dataform = $request->validate([
            'nom-entreprise' => ['required'],
            'email' => ['required', 'email', Rule::unique('utilisateurs' , 'email')],
            'mot_de_passe' => ['required', 'min:8' , 'max:200'],
        ]);

        $dataform['mot_de_passe'] = bcrypt($dataform['mot_de_passe']);
        $user = Utilisateur::create([
            'email'          => $dataform['email'],
            'mot_de_passe'   => $dataform['mot_de_passe'],
            'nom_entreprise' => $dataform['nom-entreprise'], // ADD THIS
        ]);
        Auth::login($user);
        return redirect('/');
    }
}
