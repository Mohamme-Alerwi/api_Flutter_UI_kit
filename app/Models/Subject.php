<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name', 'grade_id', 'teacher_id'];

    // العلاقات
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'grade_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
