<?php

namespace App\Http\Controllers\Api;

use App\Services\TwilioService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\ParentsModel;
use App\Models\User;

class AuthController extends Controller
{
      protected $twilio;

    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }
    // تسجيل دخول المعلم
    public function loginTeacher(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $teacher = Teacher::where('email', $request->email)->first();

        if (!$teacher || !Hash::check($request->password, $teacher->password)) {
            return response()->json([
                'success' => false,
                'message' => 'بيانات الدخول غير صحيحة'
            ], 401);
        }

        // حذف التوكنات القديمة
        $teacher->tokens()->delete();

        // $token = $teacher->createToken('teacher_token')->plainTextToken;
            $token = $teacher->createToken('teacher_token', ['teacher'])->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => [
                'id' => $teacher->id,
                'name' => $teacher->full_name,
                'email' => $teacher->email,
                'role' => 'teacher',
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
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
            return response()->json([
                'success' => false,
                'message' => 'بيانات الدخول غير صحيحة'
            ], 401);
        }

        $student->tokens()->delete();
        $token = $student->createToken('student_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'class_id' => $student->class_id,
                'role' => 'student',
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    // تسجيل دخول المدير
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password,$user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'بيانات الدخول غير صحيحة'
            ], 401);
        }

        $user->tokens()->delete();
        // $token = $user->createToken('admin_token')->plainTextToken;
            $token = $user->createToken('admin_token', ['admin'])->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => 'admin',
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
    
    public function loginParent(Request $request)
    {
         $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $parent = ParentsModel::where('email', $request->email)->first();

        if (!$parent || !Hash::check($request->password, $parent->password)) {
            return response()->json([
                'success' => false,
                'message' => 'بيانات الدخول غير صحيحة'
            ], 401);
        }

        $parent->tokens()->delete();
        // $token = $user->createToken('parent_token')->plainTextToken;
            $token = $parent->createToken('parent_token', ['parent'])->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => [
                'id' => $parent->id,
                'name' => $parent->full_name,
                'email' => $parent->email,
                'role' => 'parent',
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}














// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use App\Models\Teacher;
// use App\Models\Student;
// use App\Models\User;

// class AuthController extends Controller
// {
//     // تسجيل دخول المعلم
//     public function loginTeacher(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         $teacher = Teacher::where('email', $request->email)->first();

//         if (!$teacher || !Hash::check($request->password, $teacher->password)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'بيانات الدخول غير صحيحة'
//             ], 401);
//         }

        
//         // حذف التوكنات القديمة
//         $teacher->tokens()->delete();

//         $token = $teacher->createToken('teacher_token')->plainTextToken;

//         return response()->json([
//             'success' => true,
//             'message' => 'تم تسجيل الدخول بنجاح',
//             'user' => [
//                 'id' => $teacher->id,
//                 'name' => $teacher->full_name,
//                 'email' => $teacher->email,
//                 'role' => $teacher->role,
//                 // 'grade_id'=> $teacher->grade_id,
//             ],
//             'access_token' => $token,
//             'token_type' => 'Bearer',
//         ], 200);
//     }

//     // تسجيل دخول الطالب
//     public function loginStudent(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         $student = Student::where('email', $request->email)->first();

//         if (!$student || !Hash::check($request->password, $student->password)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'بيانات الدخول غير صحيحة'
//             ], 401);
//         }

//         $student->tokens()->delete();
//         $token = $student->createToken('student_token')->plainTextToken;

//         return response()->json([
//             'success' => true,
//             'message' => 'تم تسجيل الدخول بنجاح',
//             'user' => [
//                 'id' => $student->id,
//                 'name' => $student->name,
//                 'email' => $student->email,
//                 // 'grade_id'=> $teacher->grade_id,
//                 'grade_name' => $student->grade_id,
//                 'role' => $student->role,
//             ],
//             'access_token' => $token,
//             'token_type' => 'Bearer',
//             'role' => 'student',
//         ], 200);
//     }

//     // تسجيل دخول أي مستخدم كمدير (Admin)
//     public function loginAdmin(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         $user = User::where('email', $request->email)->first();

//         if (!$user || !Hash::check($request->password, $user->password)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'بيانات الدخول غير صحيحة'
//             ], 401);
//         }

//         $user->tokens()->delete();
//         $token = $user->createToken('admin_token')->plainTextToken;

//         return response()->json([
//             'success' => true,
//             'message' => 'تم تسجيل الدخول بنجاح',
//             'user' => [
//                 'id' => $user->id,
//                 'name' => $user->name,
//                 'email' => $user->email,
//                 'role' => $user->role ?? 'admin',
//             ],
//             'access_token' => $token,
//             'token_type' => 'Bearer',
//             'role' => 'admin',
//         ], 200);
//     }
// }

