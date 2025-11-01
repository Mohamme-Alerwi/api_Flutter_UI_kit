<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherStatus;

class TeacherStatusController extends Controller
{
    // حفظ أو تحديث حالة المعلم
    public function updateStatus(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'status' => 'required|in:present,vacation,absent',
        ]);

        $status = TeacherStatus::updateOrCreate(
            ['teacher_id' => $request->teacher_id],
            ['status' => $request->status]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'تم تحديث حالة المعلم بنجاح',
            'data' => $status
        ], 200);
    }

    // جلب جميع الحالات مع المعلمين
    public function getStatuses()
    {
        $statuses = TeacherStatus::with('teacher')->get();

        return response()->json([
            'status' => 'success',
            'data' => $statuses
        ], 200);
    }
}
