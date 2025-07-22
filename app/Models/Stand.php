<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
   protected $fillable = ['nom_stand','description','utilisateur_id'];
    public function utilisateur() 
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id'); // 'utilisateur_id' si le nom de la FK n'est pas par défaut 'utilisateur_id'
    }
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    public $timestamps = false;
}
