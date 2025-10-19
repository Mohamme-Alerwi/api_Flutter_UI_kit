<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة كتاب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h1 class="mb-4 text-center">إضافة كتاب جديد</h1>

    <form action="{{ url('book/store') }}" method="get">
        <div class="mb-3">
            <label class="form-label">عنوان الكتاب</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">المؤلف</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">سنة النشر</label>
            <input type="number" name="year" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">إضافة الكتاب</button>
    </form>
</div>

</body>
</html>
