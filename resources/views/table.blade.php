<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إدارة المكتبة</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>📚 إدارة الكتب</h3>
    <a href="{{ route('books.create') }}" class="btn btn-warning text-white">
      <i class="bi bi-plus-circle me-2"></i>إضافة كتاب جديد
    </a>
  </div>

  <div class="bg-white p-4 rounded shadow-sm">
    <table class="table table-striped text-center align-middle">
      <thead class="table-warning">
        <tr>
          <th>#</th>
          <th>العنوان</th>
          <th>المؤلف</th>
          <th>الملف</th>
          <th>تحكم</th>
        </tr>
      </thead>
      <tbody>
        @foreach($books as $index => $book)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $book->title }}</td>
          <td>{{ $book->author }}</td>
          <td>
            @if($book->file_path)
              <a href="{{ asset('storage/'.$book->file_path) }}" class="btn btn-sm btn-outline-primary" download>
                <i class="bi bi-download"></i> تحميل
              </a>
            @else
              <span class="text-muted">لا يوجد ملف</span>
            @endif
          </td>
          <td>
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-success">تعديل</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <a href="{{ url('/') }}" class="btn btn-secondary mt-3"><i class="bi bi-arrow-right"></i> رجوع</a>
</div>

</body>
</html>
