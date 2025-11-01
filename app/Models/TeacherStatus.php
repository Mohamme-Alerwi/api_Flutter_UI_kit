<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherStatus extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'status'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
