<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتبة الكتب</title>
    <style>
        /* Reset بسيط */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f8;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #1976d2;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a.button {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 6px;
            color: #fff;
            margin: 0 4px;
            font-size: 14px;
        }

        a.edit {
            background-color: #4caf50;
        }

        a.delete {
            background-color: #f44336;
        }

        a.add {
            display: inline-block;
            margin-bottom: 10px;
            background-color: #1976d2;
        }

        /* Hover effects */
        a.button:hover {
            opacity: 0.9;
        }

        @media(max-width: 768px) {
            th, td {
                font-size: 12px;
                padding: 8px 5px;
            }
            a.button {
                font-size: 12px;
                padding: 4px 8px;
            }
        }
    </style>
</head>
<body>
    <h1>مكتبة الكتب</h1>
    <div class="container">
        <a href="{{ route('books.create') }}" class="button add">إضافة كتاب جديد</a>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان الكتاب</th>
                    <th>المؤلف</th>
                    <th>الناشر</th>
                    <th>الفئة</th>
                    <th>الملف</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->book_title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher ?? '-' }}</td>
                    <td>{{ $book->category ?? '-' }}</td>
                    <td>
                        @if($book->file_path)
                            <a href="{{ $book->file_path }}" target="_blank">تحميل الملف</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="button edit">تعديل</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete" onclick="return confirm('هل أنت متأكد من حذف الكتاب؟')">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
