<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login(Request $request){
        $dataform = $request->validate([
            'loginemail' => ['required', 'email'],
            'mot_de_passe' => ['required' , 'min:8'],
        ]);

        if(Auth::attempt(['email' => $dataform['loginemail'],'mot_de_passe' => $dataform['mot_de_passe']])){
         $request->session()->regenerate();
        }
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function register(Request $request){
        $dataform = $request->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required', 'email', Rule::unique('utilisateurs' , 'email')],
            'mot_de_passe' => ['required', 'min:8' , 'max:200'],
        ]);

        $dataform['mot_de_passe'] = bcrypt($dataform['mot_de_passe']);
        $user = Utilisateur::create($dataform);
        Auth::login($user);
        return redirect('/');
    }
}
