<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInMission extends Model
{
    use HasFactory;
    protected $table = 'contactsinmissions';
    protected $fillable = [
        'contacts_id', 'missions_id'
    ];
}
