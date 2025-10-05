<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Library;

class DashboardController extends Controller
{
    public function latestItems()
    {
        // آخر 5 اختبارات
        $latestExams = Exam::latest()->take(5)->get([
            'id', 'note', 'type', 'status', 'importance', 'created_at'
        ]);

        // آخر 5 درجات
        $latestGrades = Grade::latest()->take(5)->get([
            'id', 'score', 'total_score', 'evaluation', 'exam_type', 'exam_paper', 'created_at'
        ]);

        // آخر 5 كتب في المكتبة
        $latestLibrary = Library::latest()->take(5)->get([
            'id', 'book_title', 'author', 'publisher', 'category', 'file_name', 'file_path', 'created_at'
        ]);

        return response()->json([
            'exams' => $latestExams,
            'grades' => $latestGrades,
            'library' => $latestLibrary,
        ]);
    }
}
