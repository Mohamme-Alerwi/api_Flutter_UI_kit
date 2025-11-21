@extends('layouts.app')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم')

@section('content')
<div class="row g-4">

    <!-- بطاقة الطلاب -->
    <div class="col-md-4">
        <a href="{{ route('students.index') }}" class="text-decoration-none">
            <div class="card text-center p-4 shadow-sm border-0 hover-scale">
                <div class="mb-3">
                    <i class="bi bi-people-fill" style="font-size: 50px; color: #0d6efd;"></i>
                </div>
                <h5 class="text-primary">الطلاب</h5>
                <h2>{{ $students_count }}</h2>
                <span class="btn btn-primary mt-2">عرض الطلاب</span>
            </div>
        </a>
    </div>

    <!-- بطاقة المعلمين -->
    <div class="col-md-4">
        <a href="{{ route('teachers.index') }}" class="text-decoration-none">
            <div class="card text-center p-4 shadow-sm border-0 hover-scale">
                <div class="mb-3">
                    <i class="bi bi-person-badge-fill" style="font-size: 50px; color: #198754;"></i>
                </div>
                <h5 class="text-success">المعلمين</h5>
                <h2>{{ $teachers_count }}</h2>
                <span class="btn btn-success mt-2">عرض المعلمين</span>
            </div>
        </a>
    </div>

    <!-- بطاقة الكتب -->
    <div class="col-md-4">
        <a href="{{ route('books.index') }}" class="text-decoration-none">
            <div class="card text-center p-4 shadow-sm border-0 hover-scale">
                <div class="mb-3">
                    <i class="bi bi-book-fill" style="font-size: 50px; color: #ffc107;"></i>
                </div>
                <h5 class="text-warning">الكتب</h5>
                <h2>{{ $books_count }}</h2>
                <span class="btn btn-warning mt-2">عرض الكتب</span>
            </div>
        </a>
    </div>

</div>
@endsection
