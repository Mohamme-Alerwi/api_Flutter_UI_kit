<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens; // إذا أردت تسجيل دخول أولياء الأمور

class ParentsModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // ✅ HasFactory مهم

    protected $table = 'parents'; // لأن Parent كلمة محجوزة في PHP

    protected $fillable = ['full_name','role', 'email', 'phone', 'password'];

    protected $hidden = ['password'];

    // Mutator لتشفير كلمة المرور تلقائيًا
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Illuminate\Support\Facades\Hash::make($value);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'parent_student', 'parent_id', 'student_id');
    }
    

}
