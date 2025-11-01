<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    // رفع تكليف جديد
public function upload(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'teacher_id' => 'required|int|exists:teachers,id',
        'grade_id' => 'required|int|exists:grades,id',
        'section' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'priority' => 'nullable|string|max:50',
        'assignment_date' => 'required|date',
        'due_date' => 'nullable|date',
        'description' => 'nullable|string|max:170',
        'assignment_file' => 'nullable|file|max:10240', // 10MB
    ]);

    // رفع الملف إذا تم إرساله
    $filePath = null;
    if ($request->hasFile('assignment_file')) {
        $filePath = $request->file('assignment_file')->store('assignments', 'public');
    }

    // جلب اسم المعلم والصف تلقائيًا من قاعدة البيانات
    $teacher = \App\Models\Teacher::findOrFail($request->teacher_id);
    $grade = \App\Models\Grade::findOrFail($request->grade_id);

    // إنشاء التكليف
    $assignment = \App\Models\Assignment::create([
        'title' => $request->title,
        'description' => $request->description,
        'teacher_id' => $teacher->id,             // تخزين الـ ID أيضًا
        'teacher_name' => $teacher->full_name,    // اسم المعلم
        'grade_id' => $grade->id,                 // تخزين الـ ID للصف
        'grade_name' => $grade->garde_name,             // اسم الصف
        'section' => $request->section,
        'subject' => $request->subject,
        'priority' => $request->priority ?? 'متوسط',
        'assignment_date' => $request->assignment_date,
        'due_date' => $request->due_date,
        'assignment_file_path' => $filePath,
    ]);

    return response()->json([
        'success' => true,
        'assignment' => $assignment
    ]);
}


    // جلب جميع التكاليف
    public function index()
    {
        $assignments = Assignment::latest()->get();
        return response()->json($assignments);
    }

    // جلب تفاصيل تكليف محدد
    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        return response()->json($assignment);
    }

    // تسليم التكليف من الطالب
    public function submit(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);

        $request->validate([
            'student_notes' => 'nullable|string',
            'submission_file' => 'nullable|file|max:10240',
        ]);

        $submissionFilePath = null;
        if ($request->hasFile('submission_file')) {
            $submissionFilePath = $request->file('submission_file')->store('submissions', 'public');
        }

        $assignment->update([
            'completed' => true,
            'student_notes' => $request->student_notes,
            'submission_file_path' => $submissionFilePath,
        ]);

        return response()->json(['success' => true, 'assignment' => $assignment]);
    }
}
