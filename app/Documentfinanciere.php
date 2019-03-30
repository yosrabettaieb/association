<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentfinanciere extends Model
{
    protected $fillable=['id','nomDocument','description','path','created_at'];
}
