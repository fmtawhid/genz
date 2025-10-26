<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->boolean('uses_transport')->default(false);
            $table->integer('transport_distance_km')->nullable();

            $table->boolean('uses_daycare')->default(false);
            $table->string('daycare_type')->nullable(); // যেমন Full, Half
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
