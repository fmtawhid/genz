<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn([
                'trade_license',
                'wallet_balance',
                'bank_info',
                'store_name',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('trade_license')->nullable();
            $table->decimal('wallet_balance', 12, 2)->default(0);
            $table->text('bank_info')->nullable();
            $table->string('store_name')->nullable();
        });
    }
};