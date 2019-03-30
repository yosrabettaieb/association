<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevDep extends Model
{
    protected $table = "revdepenses";
    protected $fillable=['id','libelle','montant','description','date','payement','type'];
}
