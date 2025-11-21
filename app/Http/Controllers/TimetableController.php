<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\User;
use App\Models\ClassModel;
use Carbon\Carbon;
use App\Models\Section;
use App\Models\Subject;

class TimetableController extends Controller
{
public function index(){
    $timetables = Timetable::with(['teacher','section.class','subject'])->get();
    return view('timetables.index', compact('timetables'));
}


public function create(){
    $teachers = User::where('role','teacher')->get();
    $sections = Section::with('class')->get();
    $subjects = Subject::all();
    return view('timetables.create', compact('teachers','sections','subjects'));
}


public function store(Request $request){
 $request->validate([
    'teacher_id'=>'required|exists:users,id',
    'section_id'=>'required|exists:sections,id',
    'subject_id'=>'required|exists:subjects,id',
    'day'=>'required',
    'start_time'=>'required',
    'end_time'=>'required'
]);

Timetable::create($request->all());
    return redirect()->route('timetables.index')->with('success', 'تمت إضافة الحصة بنجاح');
}

public function edit(Timetable $timetable){
    $teachers = User::where('role','teacher')->get();
    $sections = Section::with('class')->get();
    $subjects = Subject::all();
    return view('timetables.edit', compact('timetable','teachers','sections','subjects'));
}


public function update(Request $request, Timetable $timetable){
    $request->validate([
        'teacher_id'=>'required|exists:users,id',
        'section_id'=>'required|exists:sections,id',
        'subject_id'=>'required|exists:subjects,id',
        'day'=>'required',
        'start_time'=>'required',
        'end_time'=>'required'
    ]);

    $timetable->update($request->all());

    return redirect()->route('timetables.index')->with('success','تم تحديث الحصة');
}


    public function destroy(Timetable $timetable){
        $timetable->delete();
        return redirect()->route('timetables.index')->with('success','تم حذف الحصة');
    }




public function teacherTimetable(Request $request)
{
    $user = $request->user();

    // التحقق من أن المستخدم معلم
    if ($user->role !== 'teacher') {
        return response()->json(['error' => 'غير مخول'], 403);
    }

    // اليوم الحالي بالإنجليزية (Monday, Tuesday...)
    $today = Carbon::now()->format('l');

    // جلب الحصص الخاصة بالمعلم لليوم الحالي فقط
    $timetables = Timetable::where('teacher_id', $user->id)
        ->where('day', $today)
        ->with(['subject', 'section.class'])
        ->get()
        ->map(function($t) {
            return [
                'id' => $t->id,
                'subject_name' => $t->subject->name ?? '',
                'class_name' => $t->section->class->name ?? '',
                'day' => $t->day,
                'start_time' => $t->start_time,
                'end_time' => $t->end_time,
            ];
        });

    return response()->json($timetables);
}


// public function studentSchedule(Request $request)
// {
//     $user = $request->user(); // الطالب الحالي
//     $timetables = Timetable::whereHas('section', function($q) use ($user) {
//         $q->where('id', $user->section_id);
//     })
//     ->with(['subject', 'section.class'])
//     ->get()
//     ->map(function($t) {
//         return [
//             'id' => $t->id,
//             'subject_name' => $t->subject->name ?? '',
//             'class_name' => $t->section->class->name ?? '',
//             'day' => $t->day,
//             'start_time' => $t->start_time,
//             'end_time' => $t->end_time,
//         ];
//     });

//     return response()->json($timetables);
// }


    public function studentTimetable(Request $request)
    {
        $user = $request->user();

        // التحقق من أن المستخدم طالب
        if ($user->role !== 'student') {
            return response()->json(['error' => 'غير مخول'], 403);
        }

        // جلب الحصص للطالب بناءً على الصف الذي ينتمي إليه
        $timetables = Timetable::where('section_id', $user->section_id)
            ->with(['subject', 'section.class', 'teacher'])
            ->get()
            ->map(function($t) {
                return [
                    'id' => $t->id,
                    'subject_name' => $t->subject->name ?? '',
                    'class_name' => $t->section->class->name ?? '',
                    'teacher_name' => $t->teacher->name ?? '',
                    'day' => $t->day,
                    'start_time' => $t->start_time,
                    'end_time' => $t->end_time,
                ];
            });

        return response()->json($timetables);
    }
}
