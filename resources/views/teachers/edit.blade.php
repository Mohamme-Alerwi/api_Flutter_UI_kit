@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">تعديل بيانات المعلم</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $teacher->phone) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">التخصص</label>
            <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $teacher->specialization) }}">
        </div>

        <button type="submit" class="btn btn-success">تحديث</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
