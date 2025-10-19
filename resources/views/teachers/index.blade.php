<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المعلمين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h1 class="mb-4 text-center">قائمة المعلمين</h1>

    <a href="{{ url('teachers/create') }}" class="btn btn-primary mb-3">إضافة معلم جديد</a>

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
                    <a href="{{ url('teachers/delete/'.$teacher->id) }}" onclick="return confirm('هل أنت متأكد من حذف هذا المعلم؟')" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
