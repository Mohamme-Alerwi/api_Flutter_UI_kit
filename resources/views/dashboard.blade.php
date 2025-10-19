<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center mb-4">لوحة التحكم</h1>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>عدد الطلاب</h5>
                <h2>{{ $students_count }}</h2>
                <a href="{{ route('students.index') }}" class="btn btn-primary mt-2">عرض الطلاب</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>عدد المعلمين</h5>
                <h2>{{ $teachers_count }}</h2>
                <a href="{{ route('teachers.index') }}" class="btn btn-success mt-2">عرض المعلمين</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>عدد الكتب</h5>
                <h2>{{ $books_count }}</h2>
                <a href="{{ route('book.index') }}" class="btn btn-warning mt-2">عرض الكتب</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
