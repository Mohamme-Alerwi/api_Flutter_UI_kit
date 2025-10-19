<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل كتاب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h1 class="mb-4 text-center">تعديل بيانات الكتاب</h1>

    <!-- عرض الأخطاء -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- نموذج تعديل الكتاب -->
    <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- هذا مهم جداً لتجنب 419 -->

        <div class="mb-3">
            <label for="book_title" class="form-label">عنوان الكتاب</label>
            <input type="text" id="book_title" name="book_title" class="form-control" value="{{ old('book_title', $book->book_title) }}" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">المؤلف</label>
            <input type="text" id="author" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
        </div>

        <div class="mb-3">
            <label for="publisher" class="form-label">الناشر</label>
            <input type="text" id="publisher" name="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}">
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">الفئة</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $book->category) }}">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">ملف الكتاب (اختياري)</label>
            <input type="file" id="file" name="file" class="form-control">
            @if($book->file_path)
                <a href="{{ $book->file_path }}" target="_blank" class="mt-2 d-block">تحميل الملف الحالي</a>
            @endif
        </div>

        <button type="submit" class="btn btn-success">تحديث</button>
        <a href="{{ route('book.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>

</body>
</html>
