<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>إضافة طالب</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h1 class="mb-4 text-center">إضافة طالب جديد</h1>

    <form action="{{ url('students/store') }}" method="get">
        <div class="mb-3">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>الهاتف</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">إضافة</button>
    </form>
</div>

</body>
</html>
