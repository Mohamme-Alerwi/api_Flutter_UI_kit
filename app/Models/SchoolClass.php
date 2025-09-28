<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'classes'; // ربط الموديل بالجدول
    protected $fillable = [
        'grade_name',
        'academic_year',
        'class_capacity',
    ]; 
}


