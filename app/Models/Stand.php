<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    protected $table = 'stands';

    protected $fillable = [
        'nom_stand',
        'description',
        'utilisateur_id',
    ];

    public $timestamps = false;
    // You can add other model properties or methods here as needed
}
