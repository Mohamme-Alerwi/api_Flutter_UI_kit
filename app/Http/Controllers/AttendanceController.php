<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date', now()->toDateString());

        $attendances = Attendance::with('student')
            ->where('date', $date)  
            ->when($request->grade_id, fn($q) => $q->where('grade_id', $request->grade_id))
            ->when($request->section_id, fn($q) => $q->where('section_id', $request->section_id))
            ->get();

        return response()->json($attendances);
    }

    public function store(Request $request)
    {
        // التحقق من الحقول مباشرة
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'grade_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'date' => 'nullable|date',
            'status' => 'required|in:present,absent,حاضر,غائب',
            'behavior' => 'required|in:منتظم,مشاغب',
            'notes' => 'nullable|string',
        ]);

        $date = $validated['date'] ?? now()->toDateString();

        $attendance = Attendance::updateOrCreate(
            [
                'student_id' => $validated['student_id'],
                'date' => $date,
                'grade_id' => $validated['grade_id'],
                'section_id' => $validated['section_id'],
            ],
            [
                'status' => $validated['status'],
                'behavior' => $validated['behavior'],
                'notes' => $validated['notes'] ?? null,
            ]
        );

        return response()->json($attendance, 201);
    }
}
