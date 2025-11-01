<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\API\StudentController;
// use App\Http\Controllers\API\ClassController;
// use App\Http\Controllers\API\SectionController;
// use App\Http\Controllers\API\TeacherController;
// use App\Http\Controllers\API\SubjectController;
// use App\Http\Controllers\API\LibraryController;
// use App\Http\Controllers\API\ExamController;
// use App\Http\Controllers\GradeController;
// use App\Http\Controllers\AttendanceController;
// use App\Http\Controllers\notifications;

// Route::get('/notifications', [notifications::class, 'latestItems']);

// // ------------------ Attendance ------------------
// Route::post('attendance', [AttendanceController::class, 'store']);
// Route::get('attendance', [AttendanceController::class, 'index']);


// // // routes/api.php
// // Route::get('/students', [StudentController::class, 'index']);
// // Route::get('/grades', [GradeController::class, 'index']);
// // Route::get('/sections', [SectionController::class, 'index']);
// // Route::post('/attendance', [AttendanceController::class, 'store']);

// // // للموقع العادي (web)
// // // Route::resource('attendances', \App\Http\Controllers\AttendanceController::class);

// // // // أو لواجهة API
// // // Route::apiResource('attendances', \App\Http\Controllers\AttendanceController::class);


// Route::apiResource('grades', GradeController::class);


// Route::get('exams', [ExamController::class, 'index']);
// Route::post('exams', [ExamController::class, 'store']);
// Route::get('exams', [ExamController::class, 'apiIndex']);
// Route::get('exams/classes', [ClassController::class, 'index']);
// Route::get('exams/subjects', [SubjectController::class, 'index']);

// Route::get('library', [LibraryController::class, 'apiIndex']);
// Route::get('library/classes', [ClassController::class, 'index']);
// Route::get('library/subjects', [SubjectController::class, 'index']);
// Route::post('/library', [LibraryController::class, 'store']);
// Route::put('/library/{id}', [LibraryController::class, 'update']);
// Route::delete('/library/{id}', [LibraryController::class, 'destroy']);


// Route::post('library/classes', [ClassController::class, 'store']);
// Route::post('library/subjects', [SubjectController::class, 'store']);

// Route::post('library', [LibraryController::class, 'store']);

// Route::post('subjects', [SubjectController::class, 'store']);

// Route::get('subjects', [SubjectController::class, 'index']);

// Route::post('/teachers/login', [TeacherController::class, 'login']);
// // Route::post('teachers', [TeacherController::class, 'store']);
// Route::get('/teachers', [TeacherController::class, 'index']); // جميع المعلمين
// Route::get('/teachers/{id}', [TeacherController::class, 'show']); // معلم محدد
// Route::post('/teachers', [TeacherController::class, 'store']); // إضافة معلم

// Route::post('sections', [SectionController::class, 'index']);
// Route::post('sections', [SectionController::class, 'store']);

// Route::get('classes', [ClassController::class, 'index']); 
// Route::post('classes', [ClassController::class, 'store']);



// Route::get('/students', [AuthController::class, 'getAllStudents']);

// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController_S;
// use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\ClassController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\TeacherStatusController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\LibraryController;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\StudentStatusController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AbsenceRequestController;
use App\Http\Controllers\ParentComplaintController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\API\AuthController;


// ---------------- Notifications ----------------
// Route::get('/notifications', [NotificationsController::class, 'latestItems']);

// ---------------- Attendance ----------------
Route::get('attendance', [AttendanceController::class, 'index']);//
Route::post('attendance', [AttendanceController::class, 'store']);//

// ---------------- Grades ----------------
Route::apiResource('grades', GradeController::class);//

// ---------------- Exams ----------------
Route::get('exams', [ExamController::class, 'apiIndex']); // جلب كل الاختبارات
Route::post('exams', [ExamController::class, 'store']);//
Route::get('exams/classes', [ClassController::class, 'index']);//
Route::get('exams/subjects', [SubjectController::class, 'index']);//

// ---------------- Library ----------------
Route::get('library', [LibraryController::class, 'apiIndex']); // جلب جميع الكتب
// Route::post('library', [LibraryController::class, 'store']); // إضافة كتاب جديد
Route::put('library/{id}', [LibraryController::class, 'update']); // تعديل كتاب
Route::delete('library/{id}', [LibraryController::class, 'destroy']); // حذف كتاب

Route::get('library/classes', [ClassController::class, 'index']); // جلب الصفوف
Route::get('library/subjects', [SubjectController::class, 'index']); // جلب المواد
// Route::post('library/classes', [ClassController::class, 'store']); // إضافة صف للمكتبة
// Route::post('library/subjects', [SubjectController::class, 'store']); // إضافة مادة للمكتبة

// ---------------- Subjects ----------------
Route::get('subjects', [SubjectController::class, 'index']);//
Route::post('subjects', [SubjectController::class, 'store']);//

// ---------------- Teachers ----------------
// Route::post('/teachers/login', [TeacherController::class, 'login']);
// Route::get('/teachers', [TeacherController::class, 'index']); // جميع المعلمين
// Route::get('/teachers/{id}', [TeacherController::class, 'show']); // معلم محدد
// Route::post('/teachers', [TeacherController::class, 'store']); // إضافة معلم

// ---------------- Sections ----------------
Route::get('classes', [ClassController::class, 'index']); //
Route::post('classes', [ClassController::class, 'store']);//
Route::post('sections', [SectionController::class, 'store']);//اضافة شعبة
Route::post('sections/index', [SectionController::class, 'index']); // إذا كنت تحتاج POST لجلبها

// ---------------- Students ----------------
Route::get('/students', [AuthController_S::class, 'getAllStudents']);//جلب الطلاب بصيغة json
Route::post('/register', [AuthController_S::class, 'register']);//اضافة طالب (انشاء حساب)
// Route::post('login', [AuthController_S::class, 'login']);



// تسجيل دخول المعلمين
Route::post('/login/teacher', [AuthController::class, 'loginTeacher']);

// تسجيل دخول الطلاب
Route::post('/login/student', [AuthController::class, 'loginStudent']);

// تسجيل دخول ألمدير
Route::post('/login/admin', [AuthController::class, 'loginAdmin']);


Route::middleware('auth:sanctum')->group(function ()
 {

    //للمعلم
   Route::middleware('can:isTeacher')->group(function () {
        Route::post('library', [LibraryController::class, 'store']);
    });

    // للمدير فقط
    Route::middleware('can:isAdmin')->group(function () {
        Route::post('library', [LibraryController::class, 'store']);
    });
    //للطالب
        Route::middleware('can:isStudent')->group(function () {
        Route::get('/students/dashboard', [AuthController_S::class, 'dashboard']);
    });
    
});

  
 

Route::post('/parent-complaint', [ParentComplaintController::class, 'store']);


Route::post('/absence-request', [AbsenceRequestController::class, 'store']);




// إرسال رسائل
Route::post('send-sms', [SmsController::class, 'sendSms']);
Route::post('send-whatsapp', [SmsController::class, 'sendWhatsApp']);

// // جلب بيانات الطلاب والمستخدمين
// Route::get('users', [UserController::class, 'getUsers']); // جلب المستخدمين
// Route::get('students', [UserController::class, 'getStudent']); // جلب الطلاب مع الفصل والشعبة
// Route::post('get-student-phone', [UserController::class, 'getStudentPhone']); // جلب رقم الطالب عبر user_id

// جلب الفصول والشعب
// Route::get('classes', [ClasseController::class, 'index']);
// Route::get('/classes/{id}/sections', [ClassController::class, 'sections']);

Route::get('students/filter', [SmsController::class, 'filter']);
Route::post('get-user-phone', [SmsController::class, 'sendSmsToStudent']);

// تحديث حالة معلم معين
Route::post('/teacher-status', [TeacherStatusController::class, 'updateStatus']);

// جلب كل الحالات الحالية للمعلمين
Route::get('/teacher-statuses', [TeacherStatusController::class, 'getStatuses']);


Route::get('teachers', [SmsController::class, 'getAllTeachers']);
Route::post('get-user-phone_T', [SmsController::class, 'sendSmsToTeacher']);

Route::get('/classes/{id}/sections', [ClassController::class, 'sections']);


Route::get('/assignments', [AssignmentController::class, 'index']); // عرض كل التكاليف
Route::get('/assignments/{id}', [AssignmentController::class, 'show']); // تفاصيل تكليف
Route::post('/upload-assignment', [AssignmentController::class, 'upload']); // رفع تكليف جديد
Route::post('/assignments/{id}/submit', [AssignmentController::class, 'submit']); // إتمام التكليف


Route::post('/student-status', [StudentStatusController::class, 'updateStatus']);
Route::get('/student-statuses', [StudentStatusController::class, 'getStatuses']);






  // للمعلمين فقط
    // Route::middleware('can:isTeacher')->group(function () {
    //     Route::get('/teachers/dashboard', [TeacherController::class, 'dashboard']);
    //     // Route::get('/library', [LibraryController::class, 'apiIndex']);
    //     Route::post('library', [LibraryController::class, 'store']);
    // });

    // للطلاب فقط
    // Route::middleware('can:isStudent')->group(function () {
    //     Route::get('/students/dashboard', [StudentController::class, 'dashboard']);
    // });
