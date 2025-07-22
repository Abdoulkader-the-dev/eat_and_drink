<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
   protected $table = 'commandes';

    // Les colonnes que vous autorisez à être remplies massivement (via create() ou update())
    // 'details_commande' est important car c'est là que nous stockons le JSON de vos produits.
    // 'date_commande' et 'stand_id' sont également remplis par le contrôleur.
    protected $fillable = [
        'stand_id',
        'details_commande',
        'date_commande',
        // Si vous ajoutez une colonne 'total' à votre table commandes, ajoutez-la ici aussi
        // 'total',
    ];

    // Indique à Eloquent que 'details_commande' doit être casté en array/json
    // C'est très utile pour travailler avec les données JSON dans votre base de données.
    protected $casts = [
        'details_commande' => 'array', // Ceci convertira automatiquement le JSON en tableau PHP et vice-versa
        'date_commande' => 'datetime',
    ];

    // Désactive les timestamps 'created_at' et 'updated_at' si votre table n'en a pas
    // D'après votre migration, vous n'avez pas de timestamps par défaut pour la table 'commandes'.
    public $timestamps = false;

    /**
     * Une commande appartient à un stand.
     */
    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }
}