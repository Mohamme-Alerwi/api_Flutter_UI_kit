<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController_S;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\LibraryController;
use App\Http\Controllers\DashboardController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// الطلاب
Route::get('students', [AuthController_S::class, 'index']); // عرض الطلاب
Route::get('students/create', [AuthController_S::class, 'create']); // صفحة إضافة طالب
Route::get('students/store', [AuthController_S::class, 'store']); // إضافة طالب بدون CSRF
Route::get('students/delete/{id}', [AuthController_S::class, 'destroy']); // حذف طالب بدون CSRF

// المعلمين
Route::get('teachers', [TeacherController::class, 'index']); // عرض المعلمين
Route::get('teachers/create', [TeacherController::class, 'create']); // صفحة إضافة معلم
Route::get('teachers/store', [TeacherController::class, 'store']); // إضافة معلم بدون CSRF
Route::get('teachers/delete/{id}', [TeacherController::class, 'destroy']); // حذف معلم بدون CSRF

// المكتبة
Route::get('book', [LibraryController::class, 'index']); // عرض الكتب
Route::get('book/create', [LibraryController::class, 'create']); // صفحة إضافة كتاب
Route::get('book/store', [LibraryController::class, 'store']); // إضافة كتاب بدون CSRF
Route::get('book/delete/{id}', [LibraryController::class, 'destroy']); // حذف كتاب بدون CSRF



// الطلاب
Route::get('students', [AuthController_S::class, 'index'])->name('students.index'); // الآن الاسم موجود
Route::get('students/create', [AuthController_S::class, 'create'])->name('students.create');
Route::get('students/store', [AuthController_S::class, 'store'])->name('students.store');
Route::get('students/delete/{id}', [AuthController_S::class, 'destroy'])->name('students.delete');

// المعلمين
Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
Route::get('teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
Route::get('teachers/delete/{id}', [TeacherController::class, 'destroy'])->name('teachers.delete');

// المكتبة
Route::get('book', [LibraryController::class, 'index'])->name('book.index');
Route::get('book/create', [LibraryController::class, 'create'])->name('book.create');
Route::get('book/store', [LibraryController::class, 'store'])->name('book.store');
Route::get('book/delete/{id}', [LibraryController::class, 'destroy'])->name('book.delete');


