<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            
            // العلاقات
            $table->unsignedBigInteger('student_id');
            // $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('subject_id');

            // الحقول الأساسية
            $table->decimal('score', 5, 2); // الدرجة التي حصل عليها الطالب
            $table->decimal('total_score', 5, 2); // الدرجة النهائية
            $table->enum('evaluation', ['ضعيف', 'مقبول', 'جيد', 'ممتاز']); // التقييم
            
            // نوع الاختبار
            $table->enum('exam_type', ['تجريبي', 'شهري', 'نهائي']);
            
            // ورقة الامتحان (صورة)
            $table->string('exam_paper')->nullable(); // حفظ اسم/مسار الصورة
            
            $table->timestamps();

            // العلاقات الخارجية
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
