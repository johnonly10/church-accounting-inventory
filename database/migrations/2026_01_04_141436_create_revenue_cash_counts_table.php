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
        Schema::create('revenue_cash_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revenue_id')->constrained('revenues')->cascadeOnDelete();
            $table->unsignedInteger('bill_1000')->default(0);
            $table->unsignedInteger('bill_500')->default(0);
            $table->unsignedInteger('bill_200')->default(0);
            $table->unsignedInteger('bill_100')->default(0);
            $table->unsignedInteger('bill_50')->default(0);
            $table->unsignedInteger('bill_20')->default(0);
            $table->unsignedInteger('coin_20')->default(0);
            $table->unsignedInteger('coin_10')->default(0);
            $table->unsignedInteger('coin_5')->default(0);
            $table->unsignedInteger('coin_1')->default(0);
            $table->unsignedInteger('centimo_25')->default(0);
            $table->unsignedInteger('centimo_10')->default(0);
            $table->unsignedInteger('centimo_5')->default(0);
            $table->unsignedInteger('centimo_1')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue_cash_counts');
    }
};
