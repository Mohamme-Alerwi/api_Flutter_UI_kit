<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي تلقائيًا
            $table->unsignedBigInteger('grade_id'); // المفتاح الأجنبي → جدول الفصول
            $table->string('section_name'); // اسم الشعبة (أ، ب، ج)
            $table->integer('section_capacity')->nullable(); // سعة الشعبة
            $table->unsignedBigInteger('teacher_id')->nullable(); // معلم الشعبة (FK)
            $table->timestamps();

            // المفاتيح الأجنبية
            $table->foreign('grade_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
