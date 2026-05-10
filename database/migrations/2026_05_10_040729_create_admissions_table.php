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
        Schema::create('admissions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('merchant_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('course_id')->constrained()->cascadeOnDelete();

            $table->string('name');

            $table->string('email')->nullable();

            $table->string('phone');

            $table->text('goal')->nullable();

            $table->string('attachment')->nullable();

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};