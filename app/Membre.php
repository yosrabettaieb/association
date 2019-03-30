<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'email', 'dateNaissance', 'telephone', 'cin', 'adresse', 'dateEntree','photo','mdp'
    ];
}
