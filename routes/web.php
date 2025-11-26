<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController_S;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\LibraryController;
use App\Http\Controllers\DashboardController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// الطلاب
Route::resource('students', AuthController_S::class)->except(['edit', 'update', 'show']);

// المعلمين
Route::resource('teachers', TeacherController::class)->except(['edit', 'update', 'show']);

// الكتب
Route::resource('books', LibraryController::class)->except(['edit', 'update', 'apiIndex']);
