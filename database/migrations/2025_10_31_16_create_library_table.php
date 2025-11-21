<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('library', function (Blueprint $table) {
    $table->id();
    $table->string('book_title');          // عنوان الكتاب
    // $table->string('book_code')->unique(); // رقم الكتاب
    $table->string('author');              // المؤلف
    $table->string('publisher')->nullable(); // الناشر
    $table->string('category')->nullable();  // التصنيف
    $table->unsignedBigInteger('class_id');  // الصف
    $table->unsignedBigInteger('subject_id');// المادة
    $table->string('file_name')->nullable(); // اسم الملف
    $table->string('file_path')->nullable(); // مسار الملف
    $table->timestamps();                   // تاريخ الإضافة والتعديل

    // الربط بالصفوف والمواد
    $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
    $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
});

}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library');
    }
};
