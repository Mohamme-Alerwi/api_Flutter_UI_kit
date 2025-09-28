<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'grade_id' => 'required|exists:classes,id',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $subject = Subject::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $subject,
            'message' => 'تم إضافة المادة بنجاح'
        ], 201);
    }
    public function index()
{
    $subjects = Subject::all();
    return response()->json([
        'success' => true,
        'subjects' => $subjects
    ], 200);
}

}

