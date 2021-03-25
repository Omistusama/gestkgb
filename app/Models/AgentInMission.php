<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentInMission extends Model
{
    use HasFactory;
    protected $table = 'agentsinmissions';
    protected $fillable = [
        'agents_id', 'missions_id'
    ];
}
