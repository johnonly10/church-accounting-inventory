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
        Schema::table('revenue_cash_counts', function (Blueprint $table) {
            $table->foreignId('revenue_type_id')->constrained('revenue_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('revenue_cash_counts', function (Blueprint $table) {
            $table->dropForeign(['revenue_type_id']);
            $table->dropColumn(['revenue_type_id']);
        });
    }
};
