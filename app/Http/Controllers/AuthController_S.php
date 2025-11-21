<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthController_S extends Controller
{
    //تُرجع رسالة خطأ (401)
    //  عند محاولة 
    // الوصول إلى مورد بدون تسجيل دخول في حال لم يكن الطلب من نوع JSON.
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
            'class_id' => 'required|exists:classes,id', // ربط بالصف
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'class_id' =>$request->class_id
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $student
        ], 201);
    }

    // API endpoint لإرجاع جميع الطلاب بصيغة JSON (List of objects)
    public function getAllStudents()
    {
        $students = Student::all(); // جلب كل الطلاب
        return response()->json($students, 200);
    }
    //    public function index()
    // {
    //     $students = Student::all(); // جلب كل الطلاب
    //     return response()->json($students, 200);
        
    // }
    public function index(Request $request)
{
    $students = Student::all();

    // إذا كان الطلب من Flutter أو أي API (يرسل Accept: application/json)
    if ($request->wantsJson()) {
        return response()->json($students);
    }

    // إذا كان طلب عادي من المتصفح
    return view('students.index', compact('students'));
}

    public function filter(Request $request)
{
    $classId = $request->query('class_id');
    $sectionId = $request->query('section_id');

    $query = \App\Models\Student::query();

    if ($classId) {
        $query->where('class_id', $classId);
    }

    if ($sectionId) {
        $query->where('section_id', $sectionId);
    }

    $students = $query->get();

    return response()->json($students);
}


public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index');
    }
}


// خاص بـDashboard
// namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
// use App\Models\Student;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;


// class AuthController_S extends Controller
// {
//     public function index() {
//         $students = Student::all();
//         return view('students.index', compact('students'));
//     }

//    public function create()
//     {
//         return view('students.create');
//     }

//     // تخزين الطالب بدون CSRF
//   public function store(Request $request)
// {
//     // استلام البيانات من GET
//     $name = $request->query('name');
//     $email = $request->query('email');
//     $phone = $request->query('phone');

//     // إنشاء الطالب
//     Student::create([
//         'name' => $name,
//         'email' => $email,
//         'phone' => $phone,
//         'password' => Hash::make('123456'), // كلمة مرور افتراضية
//     ]);

//     return redirect('/students'); // الرجوع لقائمة الطلاب
// }

//     public function edit($id) {
//         $student = Student::findOrFail($id);
//         return view('students.edit', compact('student'));
//     }

//     public function update(Request $request, $id) {
//         $student = Student::findOrFail($id);
//         $student->update($request->all());
//         return redirect()->route('students.index');
//     }

//  public function destroy($id)
//     {
//         $student = Student::findOrFail($id);
//         $student->delete();

//         return redirect()->route('students.index');
//     }
// }
