<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'grade_id',
        'section_id',
        'date',
        'status',
        'behavior',
        'notes',
    ];
protected $table = 'attendance';

    // العلاقات
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function grade()
    {
        return $this->belongsTo(Classes::class, 'grade_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
