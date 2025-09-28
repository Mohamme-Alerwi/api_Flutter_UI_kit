<?php
// namespace App\Http\Controllers;

// use App\Models\Grade;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class GradeController extends Controller
// {
//     // ✅ عرض جميع الدرجات
//     public function index()
//     {
//         $grades = Grade::with(['student', 'teacher', 'subject'])->get();

//         return response()->json([
//             'success' => true,
//             'data' => $grades
//         ]);
//     }

//     // ✅ إضافة درجة جديدة
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'student_id'   => 'required|exists:students,id',
//             'subject_id'   => 'required|exists:subjects,id', // ✅ تم التصحيح
//             'teacher_id'   => 'required|exists:teachers,id',
//             'score'        => 'required|numeric|min:0',
//             'total_score'  => 'required|numeric|min:1',
//             'evaluation'   => 'required|in:ضعيف,مقبول,جيد,ممتاز',
//             'exam_type'    => 'required|in:تجريبي,شهري,نهائي,منتصف الفصل,اختبار قصير', // ✅ أضفت الأنواع من Flutter
//             'exam_paper'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
//         ]);

//         // رفع الصورة إن وجدت
//         if ($request->hasFile('exam_paper')) {
//             $path = $request->file('exam_paper')->store('exam_papers', 'public');
//             $validated['exam_paper'] = $path;
//         }

//         $grade = Grade::create($validated);

//         return response()->json([
//             'success' => true,
//             'message' => 'تم إضافة الدرجة بنجاح',
//             'data' => $grade
//         ], 201);
//     }

//     // ✅ عرض درجة معينة
//     public function show(Grade $grade)
//     {
//         return response()->json([
//             'success' => true,
//             'data' => $grade->load(['student', 'subject', 'teacher'])
//         ]);
//     }

//     // ✅ تعديل درجة
//     public function update(Request $request, Grade $grade)
//     {
//         $validated = $request->validate([
//             'score'        => 'nullable|numeric|min:0',
//             'total_score'  => 'nullable|numeric|min:1',
//             'evaluation'   => 'nullable|in:ضعيف,مقبول,جيد,ممتاز',
//             'exam_type'    => 'nullable|in:تجريبي,شهري,نهائي,منتصف الفصل,اختبار قصير',
//             'exam_paper'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
//         ]);

//         if ($request->hasFile('exam_paper')) {
//             // حذف الصورة القديمة إذا موجودة
//             if ($grade->exam_paper && Storage::disk('public')->exists($grade->exam_paper)) {
//                 Storage::disk('public')->delete($grade->exam_paper);
//             }

//             $path = $request->file('exam_paper')->store('exam_papers', 'public');
//             $validated['exam_paper'] = $path;
//         }

//         $grade->update($validated);

//         return response()->json([
//             'success' => true,
//             'message' => 'تم تحديث الدرجة بنجاح',
//             'data' => $grade
//         ]);
//     }

//     // ✅ حذف درجة
//     public function destroy(Grade $grade)
//     {
//         if ($grade->exam_paper && Storage::disk('public')->exists($grade->exam_paper)) {
//             Storage::disk('public')->delete($grade->exam_paper);
//         }

//         $grade->delete();

//         return response()->json([
//             'success' => true,
//             'message' => 'تم حذف الدرجة بنجاح'
//         ]);
//     }
// }








namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GradeController extends Controller
{
    // ✅ عرض جميع الدرجات مع العلاقات
    public function index()
    {
        try {
            $grades = Grade::with(['student', 'teacher', 'subject'])->get();

            return response()->json([
                'success' => true,
                'data' => $grades,
                'count' => $grades->count()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في تحميل البيانات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ✅ إضافة درجة جديدة
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'student_id'   => 'required|exists:students,id',
                'subject_id'   => 'required|exists:subjects,id',
                'teacher_id'   => 'required|exists:teachers,id',
                'score'        => 'required|numeric|min:0',
                'total_score'  => 'required|numeric|min:1',
                'evaluation'   => 'required|in:ضعيف,مقبول,جيد,ممتاز',
                'exam_type'    => 'required|in:تجريبي,شهري,نهائي',
                'exam_paper'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            // رفع الصورة إن وجدت
            if ($request->hasFile('exam_paper')) {
                $path = $request->file('exam_paper')->store('exam_papers', 'public');
                $validated['exam_paper'] = $path;
            }

            $grade = Grade::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة الدرجة بنجاح',
                'data' => $grade->load(['student', 'teacher', 'subject'])
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطأ في التحقق من البيانات',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في إضافة الدرجة',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ✅ عرض درجة معينة
    public function show(Grade $grade)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $grade->load(['student', 'subject', 'teacher'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في تحميل البيانات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ✅ تعديل درجة
    public function update(Request $request, Grade $grade)
    {
        try {
            $validated = $request->validate([
                'score'        => 'nullable|numeric|min:0',
                'total_score'  => 'nullable|numeric|min:1',
                'evaluation'   => 'nullable|in:ضعيف,مقبول,جيد,ممتاز',
                'exam_type'    => 'nullable|in:تجريبي,شهري,نهائي',
                'exam_paper'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            if ($request->hasFile('exam_paper')) {
                // حذف الصورة القديمة إذا موجودة
                if ($grade->exam_paper && Storage::disk('public')->exists($grade->exam_paper)) {
                    Storage::disk('public')->delete($grade->exam_paper);
                }

                $path = $request->file('exam_paper')->store('exam_papers', 'public');
                $validated['exam_paper'] = $path;
            }

            $grade->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الدرجة بنجاح',
                'data' => $grade
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في تحديث الدرجة',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ✅ حذف درجة
    public function destroy(Grade $grade)
    {
        try {
            if ($grade->exam_paper && Storage::disk('public')->exists($grade->exam_paper)) {
                Storage::disk('public')->delete($grade->exam_paper);
            }

            $grade->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الدرجة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في حذف الدرجة',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}