<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    // إضافة كتاب جديد
    public function store(Request $request) {
        $validated = $request->validate([
            'book_title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'grade_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'file' => 'nullable|file|max:10240', // 10MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('library_files', $filename, 'public');

            $validated['file_name'] = $filename;
            // مسار يمكن الوصول إليه من المتصفح و Flutter
            $validated['file_path'] = url("storage/library_files/$filename");
        }

        $library = Library::create($validated);

        return response()->json([
            'message' => 'تم إضافة الكتاب بنجاح',
            'library' => $library
        ], 201);
    }

    // عرض جميع الكتب
    public function apiIndex()
    {
        $books = Library::all();
        // إصلاح مسار الملفات لكل كتاب للتأكد من أنه رابط كامل
        $books->transform(function($book) {
            if ($book->file_name && !str_starts_with($book->file_path, 'http')) {
                $book->file_path = url("storage/library_files/{$book->file_name}");
            }
            return $book;
        });
        return response()->json($books);
    }

    // تعديل بيانات كتاب
    public function update(Request $request, $id)
    {
        $library = Library::findOrFail($id);

        $validated = $request->validate([
            'book_title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'grade_id' => 'sometimes|exists:classes,id',
            'subject_id' => 'sometimes|exists:subjects,id',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file')) {
            // حذف الملف القديم
            if ($library->file_name && Storage::disk('public')->exists("library_files/{$library->file_name}")) {
                Storage::disk('public')->delete("library_files/{$library->file_name}");
            }

            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('library_files', $filename, 'public');

            $validated['file_name'] = $filename;
            $validated['file_path'] = url("storage/library_files/$filename");
        }

        $library->update($validated);

        return response()->json([
            'message' => 'تم تعديل بيانات الكتاب بنجاح',
            'library' => $library
        ]);
    }

    // حذف كتاب
    public function destroy($id)
    {
        $library = Library::findOrFail($id);

        if ($library->file_name && Storage::disk('public')->exists("library_files/{$library->file_name}")) {
            Storage::disk('public')->delete("library_files/{$library->file_name}");
        }

        $library->delete();

        return response()->json(['message' => 'تم حذف الكتاب بنجاح']);
    }

}
// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Library;
// use Illuminate\Support\Facades\Storage;

// class LibraryController extends Controller
// {
//     // عرض جميع الكتب
//     public function index()
//     {
//         $books = Library::all();
//         return view('books.index', compact('books'));
//     }

//     // إظهار صفحة إضافة كتاب جديد
//     public function create()
//     {
//         return view('books.create');
//     }

//     // حفظ كتاب جديد
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'book_title' => 'required|string|max:255',
//             'author' => 'required|string|max:255',
//             'publisher' => 'nullable|string|max:255',
//             'category' => 'nullable|string|max:100',
//             'file' => 'nullable|file|max:10240', // 10MB
//         ]);

//         if ($request->hasFile('file')) {
//             $file = $request->file('file');
//             $filename = time().'_'.$file->getClientOriginalName();
//             $file->storeAs('library_files', $filename, 'public');
//             $validated['file_name'] = $filename;
//             $validated['file_path'] = url("storage/library_files/$filename");
//         }

//         Library::create($validated);

//         return redirect()->route('books.index')->with('success', 'تم إضافة الكتاب بنجاح');
//     }

//     // إظهار صفحة تعديل كتاب
//     public function edit($id)
//     {
//         $book = Library::findOrFail($id);
//         return view('books.edit', compact('book'));
//     }

//     // تحديث بيانات كتاب
//     public function update(Request $request, $id)
//     {
//         $book = Library::findOrFail($id);

//         $validated = $request->validate([
//             'book_title' => 'required|string|max:255',
//             'author' => 'required|string|max:255',
//             'publisher' => 'nullable|string|max:255',
//             'category' => 'nullable|string|max:100',
//             'file' => 'nullable|file|max:10240',
//         ]);

//         if ($request->hasFile('file')) {
//             // حذف الملف القديم
//             if ($book->file_name && Storage::disk('public')->exists("library_files/{$book->file_name}")) {
//                 Storage::disk('public')->delete("library_files/{$book->file_name}");
//             }
//             $file = $request->file('file');
//             $filename = time().'_'.$file->getClientOriginalName();
//             $file->storeAs('library_files', $filename, 'public');
//             $validated['file_name'] = $filename;
//             $validated['file_path'] = url("storage/library_files/$filename");
//         }

//         $book->update($validated);

//         return redirect()->route('books.index')->with('success', 'تم تعديل بيانات الكتاب بنجاح');
//     }

//     // حذف كتاب
//     public function destroy($id)
//     {
//         $book = Library::findOrFail($id);
//         if ($book->file_name && Storage::disk('public')->exists("library_files/{$book->file_name}")) {
//             Storage::disk('public')->delete("library_files/{$book->file_name}");
//         }
//         $book->delete();
//         return redirect()->route('books.index')->with('success', 'تم حذف الكتاب بنجاح');
//     }
// }


// }

// namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
// use App\Models\Library;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash; // لا حاجة هنا للـ Hash للكتب

// class LibraryController extends Controller
// {
//     // عرض جميع الكتب
//     public function index()
//     {
//         $books = Library::all();
//         return view('book.index', compact('books'));
//     }

//     // صفحة إضافة كتاب
//     public function create()
//     {
//         return view('book.create');
//     }

//     // تخزين كتاب بدون CSRF
//     public function store(Request $request)
//     {
//         $title = $request->query('title');
//         $author = $request->query('author');
//         $year = $request->query('year');

//         if (!Library::where('title', $title)->exists()) {
//             Library::create([
//                 'title' => $title,
//                 'author' => $author,
//                 'year' => $year,
//             ]);
//         }

//         return redirect('/book'); // العودة لقائمة الكتب
//     }

//     // حذف كتاب بدون CSRF
//     public function destroy($id)
//     {
//         $book = Library::find($id);
//         if ($book) {
//             $book->delete();
//         }

//         return redirect('/book');
//     }
// }