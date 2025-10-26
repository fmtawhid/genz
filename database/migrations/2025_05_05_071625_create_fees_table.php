<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->enum('fee_type', ['admission', 'monthly', 'exam', 'transport', 'daycare']);
            $table->string('label')->nullable(); 
            $table->foreignId('sreni_id')->nullable()->constrained('srenis')->onDelete('set null'); // Foreign key
            $table->integer('transport_distance_km')->nullable(); 
            $table->decimal('amount', 10, 2);
            $table->boolean('is_optional')->default(false); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
