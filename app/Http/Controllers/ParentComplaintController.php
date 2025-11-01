<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentComplaint;

class ParentComplaintController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:50',
            'parent_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'complaint_type' => 'required|string|max:255',
            'complaint_text' => 'required|string',
            'priority' => 'nullable|string|max:50',
            'submission_date' => 'nullable|date',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // 10MB
        ]);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('complaint_attachments', 'public');
        }

        $complaint = ParentComplaint::create([
            'student_name' => $request->student_name,
            'student_id' => $request->student_id,
            'parent_name' => $request->parent_name,
            'phone' => $request->phone,
            'complaint_type' => $request->complaint_type,
            'complaint_text' => $request->complaint_text,
            'priority' => $request->priority ?? 'عادية',
            'submission_date' => $request->submission_date ?? now(),
            'attachment' => $attachmentPath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إرسال الشكوى بنجاح',
            'data' => $complaint,
        ], 200);
    }
}
