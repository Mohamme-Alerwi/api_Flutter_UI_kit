<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Absence_request', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->enum('request_type', ['parent', 'teacher'])->default('parent'); // نوع المعتذر 
            $table->date('date'); // تاريخ الإجازة
            $table->string('reason'); // سبب الإجازة
            $table->text('details')->nullable(); // تفاصيل إضافية
            $table->string('attachment')->nullable(); // مسار الملف المرفق
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // حالة الطلب
            $table->timestamps();

         });
    }

    public function down(): void
    {
        Schema::dropIfExists('Absence_request');
    }
};
