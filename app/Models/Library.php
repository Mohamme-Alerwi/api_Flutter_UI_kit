<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
      protected $table = 'library';
    protected $fillable = [
    'book_title',
    // 'book_code',
    'author',
    'publisher',
    'category',
    'grade_id',
    'subject_id',
    'file_name',
    'file_path',
];
// علاقات
public function class() {
    return $this->belongsTo(\App\Models\Classes::class, 'grade_id');
}

public function subject() {
    return $this->belongsTo(\App\Models\Subject::class, 'subject_id');
}

}



// خاص بـDashboard
// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// // إذا أردت الفاكتوري: استخدم السطر التالي
// use Illuminate\Database\Eloquent\Factories\HasFactory;

// class Library extends Model
// {

//     use HasFactory; // احذف هذا السطر إذا لا تستخدم الفاكتوري

//     protected $table = 'library'; // اسم الجدول
//     protected $fillable = ['title', 'author', 'year']; // الحقول المسموح تعبئتها
// }
