<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'password',
        'specialization',
        'phone',
        'email',
        'hire_date',
        'salary',
        'qualification',
        'photo_url',
        'is_active'
    ];

    // تشفير كلمة المرور تلقائيًا عند الحفظ
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
