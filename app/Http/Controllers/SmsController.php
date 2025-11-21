<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Services\TwilioService;

class SmsController extends Controller
{
    protected $twilio;

    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }
//فلتره الطلاب على حسب الصف و الشعبه لتحضيرهم 
public function filter(Request $request)
{
    $classId = $request->query('class_id');
    $sectionId = $request->query('section_id');

    $query = \App\Models\Student::query();

    if ($classId) {
        $query->where('class_id', $classId);
    }

    if ($sectionId) {
        $query->where('section_id', $sectionId);
    }

    $students = $query->get();

    return response()->json($students);
}

    //دالة عرض جميع المعلمين لتحضيرهم
public function getAllTeachers()
    {
        $teachers = Teacher::all(); // جلب جميع المعلمين

        return response()->json([
            'status' => 'success',
            'data' => $teachers
        ], 200);
    }

// جلب رقم الهاتف للمستخدم المرتبط بالمعلم وإرسال SMS
public function sendSmsToTeacher(Request $request)
{
    $studentId = $request->input('teacher_id');

    // البحث عن الطالب مع المستخدم المرتبط
    $student = \App\Models\Teacher::with('user')->find($studentId);

    if (!$student) {
        return response()->json([
            'error' => 'المعلم غير موجود'
        ], 404);
    }

    if (!$student->user) {
        return response()->json([
            'error' => 'لم يتم العثور على مستخدم مرتبط بالملعم'
        ], 404);
    }

    //  الحصول على رقم الهاتف من المستخدم المرتبط بالمعلم
    $phone = $student->user->phone;

    return response()->json([$phone,200]);

    // return $this->sendSms($phone);
}

// جلب رقم الهاتف للمستخدم المرتبط بالطالب وإرسال SMS
public function sendSmsToStudent(Request $request)
{
    $studentId = $request->input('student_id');

    // البحث عن الطالب مع المستخدم المرتبط
    $student = \App\Models\Student::with('user')->find($studentId);

    if (!$student) {
        return response()->json([
            'error' => 'الطالب غير موجود'
        ], 404);
    }

    if (!$student->user) {
        return response()->json([
            'error' => 'لم يتم العثور على مستخدم مرتبط بالطالب'
        ], 404);
    }

    //  الحصول على رقم الهاتف من المستخدم المرتبط بالطالب
    $phone = $student->user->phone;

    return response()->json([$phone,200]);

    // return $this->sendSms($phone);
}

 public function sendWhatsApp(Request $request)
{
    $request->validate([
        'phone_number' => 'required|string',
        'message' => 'required|string|max:4096',
    ]);

    $phone = $request->input('phone_number');
    $message = $request->input('message');

    $sent = $this->twilio->sendWhatsApp($phone, $message);

    if ($sent) {
        return response()->json(['status' => 'success', 'message' => 'تم إرسال رسالة WhatsApp']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'فشل إرسال رسالة WhatsApp']);
    }
}
// دالة خاصة للإرسال عبر Twilio
private function sendSms(string $phone)
{
    $message = 'هلا ابونجوم';

    try {
        $sent = $this->twilio->sendSms($phone, $message);

        if ($sent) {
            return response()->json([
                'status' => 'success',
                'message' => 'تم إرسال الرسالة بنجاح',
                'phone' => $phone
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'فشل في إرسال الرسالة'
            ], 500);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'حدث خطأ أثناء الإرسال',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
  // public function sendSms(Request $request)
    // {
    //     $request->validate([
    //         'phone_number' => 'required|string',
    //         'message' => 'required|string|max:160',
    //     ]);

    //     $phone = $request->input('phone_number');
    //     $message = $request->input('message');

    //     $sent = $this->twilio->sendSms($phone, $message);

    //     if ($sent) {
    //         return response()->json(['status' => 'success', 'message' => 'تم إرسال الرسالة بنجاح']);
    //     } else {
    //         return response()->json(['status' => 'error', 'message' => 'فشل إرسال الرسالة. تحقق من الرقم أو الحساب في Twilio.'], 500);
    //     }
    // }