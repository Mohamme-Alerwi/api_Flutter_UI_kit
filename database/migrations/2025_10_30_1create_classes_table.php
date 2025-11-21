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
        Schema::create('classes', function (Blueprint $table) {
    $table->id(); // المفتاح الأساسي (Primary Key)
    $table->string('class_name'); // اسم الفصل
    $table->string('academic_year'); // السنة الدراسية (مثلاً 2024-2025)
    $table->integer('class_capacity')->default(30); // السعة الافتراضية للفصل
    $table->timestamps(); // حقول created_at و updated_at تلقائي
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
