<?php
// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Grade extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'student_id',
//         // 'exam_id',
//         'subject_id',
//         'teacher_id',
//         'score',
//         'total_score',
//         'evaluation',
//         'exam_type',
//         'exam_paper'
//     ];

//     // العلاقات
//     public function student()
//     {
//         return $this->belongsTo(Student::class);
//     }

//     public function exam()
//     {
//         return $this->belongsTo(Exam::class);
//     }

//     public function teacher()
//     {
//         return $this->belongsTo(Teacher::class);
//     }
// }









namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id', 
        'subject_id',
        'exam_type',
        'score',
        'total_score',
        'evaluation',
        'exam_paper'
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'total_score' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}