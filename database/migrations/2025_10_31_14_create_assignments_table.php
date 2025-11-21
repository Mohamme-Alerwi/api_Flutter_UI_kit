<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            // $table->string('teacher_name');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('class_id'); // المفتاح الأجنبي → جدول الفصول

            // $table->string('grade_name');
            $table->string('section');
            $table->string('subject');
            $table->string('priority')->default('متوسط');
            $table->date('assignment_date');
            $table->date('due_date')->nullable();
            $table->string('assignment_file_path')->nullable(); // الملف الأصلي من المعلم
            $table->boolean('completed')->default(false); // تم التسليم؟
            $table->text('student_notes')->nullable(); // ملاحظات الطالب عند التسليم
            $table->string('submission_file_path')->nullable(); // ملف التسليم من الطالب
            $table->timestamps();
            
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
