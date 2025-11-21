<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- هذا هو الصحيح

class Section extends Model
{
    use HasFactory; 

    protected $fillable = [
        'class_id',
        'section_name',
        'section_capacity',
        'teacher_id',
    ];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // للحضور
    public function attendances()
{
    return $this->hasMany(Attendance::class, 'section_id');
}

    /**
     * العلاقة مع الطلاب
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'section_id');
    }

    /**
     * العلاقة مع الحصص (Timetable)
     */
    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'section_id');
    }
}
