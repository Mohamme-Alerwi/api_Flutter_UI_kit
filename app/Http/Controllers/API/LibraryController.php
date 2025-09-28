<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library;

class LibraryController extends Controller
{
    public function store(Request $request) {
    $validated = $request->validate([
        'book_title' => 'required|string|max:255',
        // 'book_code' => 'required|string|max:100|unique:library',
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
        $validated['file_path'] = $path;
    }

    $library = Library::create($validated);

    return response()->json([
        'message' => 'تم إضافة الكتاب بنجاح',
        'library' => $library
    ], 201);
}
 public function apiIndex()
    {
        $books = Library::all(); // جلب كل بيانات جدول library
        return response()->json($books);
    }

}
