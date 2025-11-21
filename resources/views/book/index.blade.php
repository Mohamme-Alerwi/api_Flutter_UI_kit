@extends('layouts.app')

@section('title', 'الكتب')
@section('page-title', 'قائمة الكتب')

@section('content')
<a href="{{ route('books.create') }}" class="btn btn-success mb-3">إضافة كتاب جديد</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>الرقم</th>
            <th>عنوان الكتاب</th>
            <th>المؤلف</th>
            <th>سنة النشر</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->year }}</td>
            <td>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا الكتاب؟')">
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
