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
      Schema::create('attendance', function (Blueprint $table) {
    $table->id();

    // ربط الطالب
    $table->unsignedBigInteger('student_id');
    $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

    // ربط الصف
    $table->unsignedBigInteger('grade_id');
    $table->foreign('grade_id')->references('id')->on('classes')->onDelete('cascade');

    // ربط الشعبة
    $table->unsignedBigInteger('section_id');
    $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

    // التاريخ (النظام يحدده أوتوماتيكياً)
    $table->date('date')->default(DB::raw('CURRENT_DATE'));

    // حالة الحضور
    $table->enum('status', ['حاضر', 'غائب'])->default('حاضر');

    // السلوك
    $table->enum('behavior', ['منتظم', 'مشاغب'])->default('منتظم');

    // الملاحظات
    $table->text('notes')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
    
};
