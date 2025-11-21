@extends('layouts.app')

@section('title', 'الطلاب')
@section('page-title', 'قائمة الطلاب')

@section('content')
<a href="{{ route('students.create') }}" class="btn btn-primary mb-3">إضافة طالب جديد</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>الرقم</th>
            <th>الاسم</th>
            <th>البريد الإلكتروني</th>
            <th>الهاتف</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا الطالب؟')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
