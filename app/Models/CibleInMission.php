<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CibleInMission extends Model
{
    use HasFactory;
    protected $table = 'ciblesinmissions';
    protected $fillable = [
        'cibles_id', 'missions_id'
    ];
}
