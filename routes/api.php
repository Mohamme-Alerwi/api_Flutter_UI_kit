<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ClassController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\GradeController;

Route::apiResource('grades', GradeController::class);


Route::get('exams', [ExamController::class, 'index']);
Route::post('exams', [ExamController::class, 'store']);
Route::get('exams', [ExamController::class, 'apiIndex']);
Route::get('exams/classes', [ClassController::class, 'index']);
Route::get('exams/subjects', [SubjectController::class, 'index']);

Route::get('library', [LibraryController::class, 'apiIndex']);
Route::get('library/classes', [ClassController::class, 'index']);
Route::get('library/subjects', [SubjectController::class, 'index']);

Route::post('library/classes', [ClassController::class, 'store']);
Route::post('library/subjects', [SubjectController::class, 'store']);

Route::post('library', [LibraryController::class, 'store']);

Route::post('subjects', [SubjectController::class, 'store']);

Route::get('subjects', [SubjectController::class, 'index']);

// Route::post('teachers', [TeacherController::class, 'store']);
Route::get('/teachers', [TeacherController::class, 'index']); // جميع المعلمين
Route::get('/teachers/{id}', [TeacherController::class, 'show']); // معلم محدد
Route::post('/teachers', [TeacherController::class, 'store']); // إضافة معلم

Route::post('sections', [SectionController::class, 'store']);

Route::get('classes', [ClassController::class, 'index']); 
Route::post('classes', [ClassController::class, 'store']);



Route::get('/students', [AuthController::class, 'getAllStudents']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);