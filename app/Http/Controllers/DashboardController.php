<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Library;

class DashboardController extends Controller
{
    public function index()
    {
        $students_count = Student::count();
        $teachers_count = Teacher::count();
        $books_count = Library::count();

        return view('dashboard', compact('students_count', 'teachers_count', 'books_count'));
    }
}
