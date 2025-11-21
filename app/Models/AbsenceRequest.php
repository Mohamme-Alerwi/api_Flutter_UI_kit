<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceRequest extends Model
{
    use HasFactory;
     protected $table = 'absence_request';

    protected $fillable = [
        'full_name',
        'request_type', 
        'date',
        'reason',
        'details',
        'attachment',
        'status',
    ];

   
}
