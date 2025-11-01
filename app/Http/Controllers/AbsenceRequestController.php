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
            'full_name'=>'reuired|string|max:160',
            'date' => 'required|date',
            'reason' => 'required|string|max:255',
            'details' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // 10MB
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $leaveRequest = AbsenceRequest::create([
            'full_name'=>$request->name,
            'date' => $request->date,
            'reason' => $request->reason,
            'details' => $request->details,
            'attachment' => $attachmentPath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إرسال الطلب بنجاح',
            'data' => $leaveRequest,
        ], 200);
    }
    
}
