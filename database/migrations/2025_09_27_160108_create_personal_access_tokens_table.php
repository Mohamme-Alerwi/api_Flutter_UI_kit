<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
        'message' => 'تم تسجيل الدخول بنجاح',
        'user' => $teacher,
        'access_token' => $token,
        'token_type' => 'Bearer',
        'role' => 'teacher',
    ]);
}
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
        'message' => 'تم تسجيل الدخول بنجاح',
        'user' => $student,
        'access_token' => $token,
        'token_type' => 'Bearer',
        'role' => 'student',
    ]);
}

};
