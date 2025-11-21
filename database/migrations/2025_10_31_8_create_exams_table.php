<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            
            // الربط مع جدول الصفوف
            $table->unsignedBigInteger('class_id');
           
// $table->foreignId('grade_id')->constrained('classes')->onDelete('cascade');

            // الربط مع جدول المواد
            $table->unsignedBigInteger('subject_id');

            // الحقول المطلوبة
            $table->enum('importance', ['عالية', 'متوسطة', 'منخفضة']);
            $table->enum('status', ['قادم', 'منتهي', 'ملغي']);
            $table->enum('type', ['شهري', 'نهائي', 'تجريبي']);
            $table->text('note')->nullable();

            $table->timestamps();
             $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
