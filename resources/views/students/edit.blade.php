<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل طالب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h1 class="mb-4 text-center">تعديل بيانات الطالب</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}">
        </div>

        <button type="submit" class="btn btn-success">تحديث</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>

</body>
</html>
