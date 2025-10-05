<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي
            // $table->string('teacher_code')->unique(); // كود المعلم
            $table->string('full_name'); // الاسم الكامل
$table->string('password');

            $table->string('specialization'); // التخصص
            $table->string('phone')->nullable(); // رقم الهاتف
            $table->string('email')->unique()->nullable(); // البريد الإلكتروني
            $table->date('hire_date')->nullable(); // تاريخ التعيين
            $table->decimal('salary', 10, 2)->nullable(); // الراتب
            $table->string('qualification')->nullable(); // المؤهل العلمي
            $table->string('photo_url')->nullable(); // رابط صورة
            $table->boolean('is_active')->default(true); // نشط/غير نشط
            $table->timestamps(); // created_at و updated_at تلقائي
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
