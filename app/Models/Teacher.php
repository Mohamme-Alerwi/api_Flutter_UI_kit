<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable; 

class Teacher extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = [
        'full_name',
        'role',
        'password',
        'specialization',
        'phone',
        'email',
        'grade_id',
        'hire_date',
        'salary',
        'qualification',
        'photo_url',
        'is_active',
        'user_id'
    ];
   // Dashboard خاص بـ
    // protected $fillable = ['full_name', 'email', 'phone', 'specialization', 'password'];


    // تشفير كلمة المرور تلقائيًا عند الحفظ
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    //    return $this->hasOne(User::class,'user_id','students_id');
    }
    public function status()
{
    return $this->hasOne(TeacherStatus::class);
}
}
