<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:classes,id', // ربط بالصف
            'section_name' => 'required|string|max:255',
            'section_capacity' => 'nullable|integer|min:1',
            'teacher_id' => 'nullable|exists:teachers,id', // ربط بالمعلم
        ]);

        $section = Section::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة الشعبة بنجاح',
            'data' => $section
        ], 201);
    }
 public function index()
    {
        return response()->json(Section::all());
    }
}
