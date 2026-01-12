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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revenue_collection_id')->nullable()->constrained('revenue_collections')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->enum('types', ['tithes', 'offering'])->index();
            $table->enum('payment_method', ['gcash', 'cash'])->default('cash')->index();
            $table->decimal('amount', 12, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
