<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();

            $table->string('student_name');
            $table->string('position_name')->nullable(); // e.g., "Frontend Developer"
            $table->string('image')->nullable();         // stored filename
            $table->string('video_url')->nullable();     // optional YouTube/Vimeo/etc.
            $table->text('body')->nullable();            // short review text (optional)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_reviews');
    }
};
