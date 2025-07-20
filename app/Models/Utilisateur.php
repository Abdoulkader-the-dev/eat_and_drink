<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
    ];

    // You can add other model properties or methods here as needed
}
