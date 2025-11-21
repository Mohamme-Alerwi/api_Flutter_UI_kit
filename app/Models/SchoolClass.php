<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
       use HasFactory; 
    protected $table = 'classes'; // ربط الموديل بالجدول
    protected $fillable = [
        'class_name',
        'academic_year',
        'class_capacity',
    ]; 
     // للحضور
    public function attendances()
{
    return $this->hasMany(Attendance::class, 'class_id');
}
    // العلاقة مع الطلاب عبر الشعب
    public function students()
    {
        return $this->hasManyThrough(Student::class, Section::class, 'class_id', 'section_id');
    }
     // العلاقة مع الشعب
    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    // كل فصل يحتوي على جداول دراسية (حصص)
    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'class_id');
    }

}


