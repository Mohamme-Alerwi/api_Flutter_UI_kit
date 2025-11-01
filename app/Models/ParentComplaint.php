<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'student_id',
        'parent_name',
        'phone',
        'complaint_type',
        'complaint_text',
        'priority',
        'attachment',
        'submission_date',
    ];
}
