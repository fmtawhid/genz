<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assigned_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // Foreign key
            $table->foreignId('fee_id')->constrained('fees')->onDelete('cascade'); // Foreign key
            $table->string('month')->nullable(); // '2025-05' format
            $table->boolean('is_paid')->default(false);
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assigned_fees');
    }
};
