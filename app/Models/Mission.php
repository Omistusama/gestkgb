<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'nomdecode', 'pays', 'type', 'statut', 'specialite', 'datedebut', 'datefin'
    ];
    public function agents() {
        return $this->belongsToMany(Agent::class, 'agentsinmissions');
    }


}
