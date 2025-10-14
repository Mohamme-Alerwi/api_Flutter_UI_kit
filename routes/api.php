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
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\ClassController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\LibraryController;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\API\AuthController;

// ---------------- Notifications ----------------
Route::get('/notifications', [NotificationsController::class, 'latestItems']);

// ---------------- Attendance ----------------
Route::get('attendance', [AttendanceController::class, 'index']);
Route::post('attendance', [AttendanceController::class, 'store']);

// ---------------- Grades ----------------
Route::apiResource('grades', GradeController::class);

// ---------------- Exams ----------------
Route::get('exams', [ExamController::class, 'apiIndex']); // جلب كل الاختبارات
Route::post('exams', [ExamController::class, 'store']);
Route::get('exams/classes', [ClassController::class, 'index']);
Route::get('exams/subjects', [SubjectController::class, 'index']);

// ---------------- Library ----------------
Route::get('library', [LibraryController::class, 'apiIndex']); // جلب جميع الكتب
Route::post('library', [LibraryController::class, 'store']); // إضافة كتاب جديد
Route::put('library/{id}', [LibraryController::class, 'update']); // تعديل كتاب
Route::delete('library/{id}', [LibraryController::class, 'destroy']); // حذف كتاب

Route::get('library/classes', [ClassController::class, 'index']); // جلب الصفوف
Route::get('library/subjects', [SubjectController::class, 'index']); // جلب المواد
Route::post('library/classes', [ClassController::class, 'store']); // إضافة صف للمكتبة
Route::post('library/subjects', [SubjectController::class, 'store']); // إضافة مادة للمكتبة

// ---------------- Subjects ----------------
Route::get('subjects', [SubjectController::class, 'index']);
Route::post('subjects', [SubjectController::class, 'store']);

// ---------------- Teachers ----------------
// Route::post('/teachers/login', [TeacherController::class, 'login']);
Route::get('/teachers', [TeacherController::class, 'index']); // جميع المعلمين
Route::get('/teachers/{id}', [TeacherController::class, 'show']); // معلم محدد
Route::post('/teachers', [TeacherController::class, 'store']); // إضافة معلم

// ---------------- Sections ----------------
Route::get('classes', [ClassController::class, 'index']); 
Route::post('classes', [ClassController::class, 'store']);
Route::post('sections', [SectionController::class, 'store']);
Route::post('sections/index', [SectionController::class, 'index']); // إذا كنت تحتاج POST لجلبها

// ---------------- Students ----------------
Route::get('/students', [AuthController_S::class, 'getAllStudents']);
Route::post('/register', [AuthController_S::class, 'register']);
// Route::post('login', [AuthController_S::class, 'login']);



// تسجيل دخول المعلمين
Route::post('/login/teacher', [AuthController::class, 'loginTeacher']);

// تسجيل دخول الطلاب
Route::post('/login/student', [AuthController::class, 'loginStudent']);

// تسجيل دخول ألمدير
Route::post('/login/admin', [AuthController::class, 'loginAdmin']);

Route::middleware('auth:sanctum')->group(function () {

    // routes للمعلمين فقط
    Route::middleware('can:isTeacher')->group(function () {
        Route::get('/teachers/dashboard', [TeacherController::class, 'dashboard']);
        Route::get('/library', [LibraryController::class, 'apiIndex']);
        Route::post('/library', [LibraryController::class, 'store']);
    });

    // routes للطلاب فقط
    Route::middleware('can:isStudent')->group(function () {
        Route::get('/students/dashboard', [StudentController::class, 'dashboard']);
    });

});
