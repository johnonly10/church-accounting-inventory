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
        Schema::create('pepsols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pepsol_category_id')->nullable()->constrained('pepsol_categories')->nullOnDelete();
            $table->foreignId('pepsol_type_id')->nullable()->constrained('pepsol_types')->nullOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->text('guidelines')->nullable();
            $table->text('orientation')->nullable();
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pepsols');
    }
};
