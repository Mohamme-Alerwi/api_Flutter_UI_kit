<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'teacher_id',
        'section_id',
        'subject_id',
        'subject',
        'start_time',
        'end_time',
        'day'
    ];

    // الحصة تنتمي لفصل
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

      public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    // الحصة تنتمي لمعلم
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // الحصة تحتوي على حضور
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'timetable_id');
    }
    public function section() {
    return $this->belongsTo(Section::class, 'section_id');
}

}
