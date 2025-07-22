<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;

class Utilisateur extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $password = 'mot_de_passe';
    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
    ];
    protected $casts = [
        //'email_verified_at' => 'datetime', 
        'mot_de_passe' => 'hashed', 
    ];

    // Relation: Un utilisateur peut avoir un stand (one-to-one)
    public function stand()
    {
        return $this->hasOne(Stand::class, 'utilisateur_id'); 
    }

    // You can add other model properties or methods here as needed
}
