<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->foreignId('sreni_id')->constrained()->onDelete('cascade');
            $table->enum('exam_type', ['Exam', 'Test']); // Exam বা Test হবে
            $table->foreignId('subject_id')->nullable()->constrained()->onDelete('set null'); // Subject ID, Null থাকবে যদি না থাকে
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
