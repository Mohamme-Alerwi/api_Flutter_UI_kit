<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
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
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // الحضور مرتبط بالحصة
    public function timetable()
    {
        return $this->belongsTo(Timetable::class, 'timetable_id');
    }
}

