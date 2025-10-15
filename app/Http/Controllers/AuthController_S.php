<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthController_S extends Controller
{
    protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}

    // تسجيل مستخدم جديد
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6',
            'grade_id' => 'required|exists:classes,id', // ربط بالصف
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'grade_id' =>$request->grade_id
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $student
        ], 201);
    }

    // تسجيل الدخول
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     $student = Student::where('name', $request->name)
    //                       ->where('email', $request->email)
    //                       ->first();

    //     if (!$student || !Hash::check($request->password, $student->password)) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => 'بيانات الاعتماد غير صحيحة'
    //         ], 401);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'تم تسجيل الدخول بنجاح',
    //         'user' => $student
    //     ], 200);
    // }

    // API endpoint لإرجاع جميع الطلاب بصيغة JSON (List of objects)
    public function getAllStudents()
    {
        $students = Student::all(); // جلب كل الطلاب
        return response()->json($students, 200);
    }
}
