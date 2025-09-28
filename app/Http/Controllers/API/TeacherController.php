<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    // إنشاء معلم جديد
    public function store(Request $request)
    {
        $request->validate([
            // 'teacher_code' => 'required|unique:teachers|max:20',
            'full_name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:teachers',
            'hire_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'qualification' => 'nullable|string|max:100',
            'photo' => 'nullable|image|max:2048', // يقبل الصورة
            'is_active' => 'boolean',
        ]);

        $teacher = Teacher::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة المعلم بنجاح',
            'data' => $teacher
        ], 201);
    }

    // عرض جميع المعلمين (API endpoint جديد)
    public function index()
    {
        $teachers = Teacher::all(); // جلب جميع المعلمين
        return response()->json($teachers); // ترجع JSON List of objects
    }

    // عرض معلم واحد حسب ID (اختياري)
    public function show($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json([
                'success' => false,
                'message' => 'المعلم غير موجود'
            ], 404);
        }

        return response()->json($teacher);
    }
}
