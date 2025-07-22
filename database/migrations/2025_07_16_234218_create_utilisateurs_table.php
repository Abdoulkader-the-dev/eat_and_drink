<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();                                   // id (PK)
           // $table->string('nom');
            //$table->string('prenom');
            $table->string('nom_entreprise');               // nom de l'entreprise
            $table->string('email')->unique();              // email unique
            $table->string('mot_de_passe');                 // mot de passe
            $table->enum('role', [
                'admin',
                'entrepreneur_en_attente',
                'entrepreneur_approuve',
            ])->default('entrepreneur_en_attente');         // role par de defaut
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('utilisateurs');
    }
};
