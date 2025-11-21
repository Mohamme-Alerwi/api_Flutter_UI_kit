@extends('layouts.app')

@section('title', 'المعلمين')
@section('page-title', 'قائمة المعلمين')

@section('content')
<a href="{{ route('teachers.create') }}" class="btn btn-primary mb-3">إضافة معلم جديد</a>

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
        @foreach($teachers as $teacher)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->email }}</td>
            <td>{{ $teacher->phone }}</td>
            <td>
                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا المعلم؟')">
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
