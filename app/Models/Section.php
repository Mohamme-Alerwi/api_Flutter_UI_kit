<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- هذا هو الصحيح

class Section extends Model
{
    use HasFactory; // الآن سيعمل بدون خطأ

    protected $fillable = [
        'grade_id',
        'section_name',
        'section_capacity',
        'teacher_id',
    ];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'grade_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
