<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;



class Student extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;
    protected $fillable = ['name', 'email', 'password','role','class_id'];
     // للحضور

   

    // الطالب ينتمي لفصل
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    // الطالب لديه حضور
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
    public function section() {
    return $this->belongsTo(Section::class, 'section_id');
}
public function parents()
{
    return $this->belongsToMany(ParentModel::class, 'parent_student', 'student_id', 'parent_id');
}

}
