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
    Schema::create('parent_complaints', function (Blueprint $table) {
        $table->id();
        $table->string('student_name');
        $table->string('student_id');
        $table->string('parent_name');
        $table->string('phone');
        $table->string('complaint_type');
        $table->text('complaint_text');
        $table->string('priority')->default('عادية');
        $table->string('attachment')->nullable();
        $table->timestamp('submission_date')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_complaints');
    }
};
