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
            'grade_name' => 'required|string|max:255',
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
    public function index()
{
    $classes = SchoolClass::all();
    return response()->json([
        'success' => true,
        'classes' => $classes
    ], 200);
    
}
}
