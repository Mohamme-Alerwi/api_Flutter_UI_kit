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
        'is_active'
    ];

    // تشفير كلمة المرور تلقائيًا عند الحفظ
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }
}
