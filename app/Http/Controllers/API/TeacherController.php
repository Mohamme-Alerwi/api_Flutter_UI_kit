<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;


class TeacherController extends Controller
{
    // إنشاء معلم جديد
   public function store(Request $request)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|unique:teachers',
        'grade_id' => 'required|exists:classes,id', // ربط بالصف
        'hire_date' => 'nullable|date',
        'salary' => 'nullable|numeric|min:0',
        'qualification' => 'nullable|string|max:100',
        'photo' => 'nullable|image|max:2048',
        // 'photo_url' => 'nullable|string|max:255',
        'is_active' => 'boolean',
    ]);

    $teacher = Teacher::create([
        'full_name' => $request->full_name,
        'password' => Hash::make($request->password),
        // 'password' => $request->password,
        'specialization' => $request->specialization,
        'phone' => $request->phone,
        'email' => $request->email,
        'hire_date'=> $request->hire_date,
        'salary'=> $request->salary,
        'qualification'=> $request->qualification,
        'photo_url'=> $request->photo, // يجب أن يطابق قاعدة البيانات
        'is_active' => $request->is_active,
        'grade_id' =>$request->grade_id,

    ]);

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

       // تسجيل الدخول
// public function login(Request $request)
// {
//     $request->validate([
//         'full_name' => 'required|string',
//         'email' => 'required|email',
//         'password' => 'required|string',
//     ]);

//     $full_name = $request->full_name;
//     $email = $request->email;
//     $password = $request->password;

//     // البحث عن المعلم بالاسم أو البريد
//     $teacher = Teacher::where('full_name', $full_name)
//                       ->orWhere('email', $email)
//                       ->first();

//     if (!$teacher) {
//         return response()->json([
//             'success' => false,
//             'error' => 'المعلم غير موجود'
//         ], 404);
//     }

//     // التحقق من كلمة المرور (لأنها غير مشفرة)
//     if ($teacher->password !== $password) {
//         return response()->json([
//             'success' => false,
//             'error' => 'كلمة المرور غير صحيحة'
//         ], 401);
//     }

//     // تسجيل الدخول ناجح
//     return response()->json([
//         'success' => true,
//         'message' => 'تم تسجيل الدخول بنجاح',
//         'user' => $teacher
//     ], 200);
// }


  
}
