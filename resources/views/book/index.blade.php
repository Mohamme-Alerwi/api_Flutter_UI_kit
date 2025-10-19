<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الكتب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h1 class="mb-4 text-center">قائمة الكتب</h1>

    <a href="{{ url('book/create') }}" class="btn btn-success mb-3">إضافة كتاب جديد</a>

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
                    <a href="{{ url('book/delete/'.$book->id) }}" onclick="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
