<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolClass;

class ClassController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'academic_year' => 'required|string|max:20',
            'class_capacity' => 'nullable|integer|min:1',
        ]);

        $class = SchoolClass::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة الصف بنجاح',
            'data' => $class
        ], 201);
    }
//     public function index()
// {
//     $classes = SchoolClass::all();
//     return response()->json([
//         'success' => true,
//         'classes' => $classes
//     ], 200);
    
// }

    public function index()
    {
        // جلب كل الفصول مع الشعب المرتبطة
        //  $classes = SchoolClass::with('sections')->get();
        $classes = SchoolClass::all();
        return response()->json($classes,200);
    }

    // جلب الشعب لفصل معين
    public function sections($classId)
    {
        $sections = \App\Models\Section::where('class_id', $classId)->get();
        return response()->json($sections);
    }
}
