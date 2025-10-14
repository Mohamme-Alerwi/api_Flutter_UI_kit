<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\User; // ✅ إضافة نموذج المستخدم

class AuthController extends Controller
{
    // تسجيل دخول المعلم
    public function loginTeacher(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $teacher = Teacher::where('email', $request->email)->first();

        if (!$teacher || !Hash::check($request->password, $teacher->password)) {
            return response()->json(['message' => 'بيانات الدخول غير صحيحة'], 401);
        }

        $token = $teacher->createToken('teacher_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => [
                'id' => $teacher->id,
                'name' => $teacher->name,
                'email' => $teacher->email,
                'role' => $teacher->role,
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => 'teacher',
        ], 200);
    }

    // تسجيل دخول الطالب
    public function loginStudent(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'بيانات الدخول غير صحيحة'], 401);
        }

        $token = $student->createToken('student_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'role' => $student->role,
            ],
            'access_token' => $token,
            'role' => 'student',
        ], 200);
    }

    // تسجيل دخول أي مستخدم كمدير (Admin)
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'بيانات الدخول غير صحيحة'], 401);
        }

        $token = $user->createToken('admin_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ?? 'admin',
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => 'admin',
        ], 200);
    }

    // تعريف Gates
    public function boot()
    {
        Gate::define('isTeacher', function ($user) {
            return $user instanceof \App\Models\Teacher;
        });

        Gate::define('isStudent', function ($user) {
            return $user instanceof \App\Models\Student;
        });
    }
}
