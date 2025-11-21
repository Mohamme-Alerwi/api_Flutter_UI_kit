<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsenceRequest;
use Illuminate\Support\Facades\Storage;

class AbsenceRequestController extends Controller
{
    // حفظ طلب الإجازة
public function store(Request $request)
{
       $request->validate([
        'full_name'      => 'required|string|max:160',
        'request_type'   => 'required|string|max:50', // النوع (ولي أمر - معلم)
        'date'           => 'required|date',
        'reason'         => 'required|string|max:255',
        'details'        => 'nullable|string',
        'attachment'     => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // 10MB
         ]);

    // رفع الملف إن وجد
    $attachmentPath = null;

    if ($request->hasFile('attachment')) {
        $attachmentPath = $request->file('attachment')->store('attachments', 'public');
    }

    // إنشاء الطلب
    $leaveRequest = AbsenceRequest::create([
        'full_name'     => $request->full_name,
        'request_type'  => $request->request_type,
        'date'          => $request->date,
        'reason'        => $request->reason,
        'details'       => $request->details,
        'attachment'    => $attachmentPath,
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'تم إرسال الطلب بنجاح',
        'data'    => $leaveRequest,
    ], 200);
}

}
