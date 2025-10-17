<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends Controller
{
    // إرجاع جميع الاختبارات
    public function index()
    {
        $exams = Exam::with(['classe', 'subject'])->get();
        return response()->json($exams);
    }

    // إضافة اختبار جديد
    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'importance' => 'required|in:عالية,متوسطة,منخفضة',
            'status' => 'required|in:قادم,منتهي,ملغي',
            'type' => 'required|in:شهري,نهائي,تجريبي',
            'note' => 'nullable|string',
        ]);

        $exam = Exam::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة الاختبار بنجاح',
            'data' => $exam
        ], 201);
    }

     public function apiIndex()
    {
        $exam = Exam::all();
        return response()->json($exam);
    }
}
