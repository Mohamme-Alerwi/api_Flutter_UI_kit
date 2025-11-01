<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentStatus;

class StudentStatusController extends Controller
{
    // حفظ أو تحديث حالة الطالب
    public function updateStatus(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'status' => 'required|in:present,vacation,absent',
        ]);

        $status = StudentStatus::updateOrCreate(
            ['student_id' => $request->student_id],
            ['status' => $request->status]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث حالة الطالب بنجاح',
            'data' => $status
        ], 200);
    }

    // جلب جميع الحالات مع معلومات الطلاب
    public function getStatuses(Request $request)
    {
        $query = StudentStatus::with('student');

        if ($request->has('grade_id')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            });
        }

        if ($request->has('section_id')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('section_id', $request->section_id);
            });
        }

        $statuses = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $statuses
        ], 200);
    }
}
