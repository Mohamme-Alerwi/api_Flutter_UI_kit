<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'teacher_id',
        'class_id',
        'section',
        'subject',
        'priority',
        'assignment_date',
        'due_date',
        'assignment_file_path',
        'completed',
        'student_notes',
        'submission_file_path',
    ];
public function grade() {
    return $this->belongsTo(\App\Models\SchoolClass::class, 'class_id');
}

   public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
