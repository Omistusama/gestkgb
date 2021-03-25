<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanqueInMission extends Model
{
    use HasFactory;
    protected $table = 'planqueinmissions';
    protected $fillable = [
        'planques_id', 'missions_id'
    ];
}
