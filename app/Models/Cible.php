<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cible extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'datedenaissance', 'nomdecode', 'nationalite'
    ];
}
