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
        Schema::create('pepsol_lesson_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pepsol_lesson_id')->constrained('pepsol_lessons')->cascadeOnDelete();
            $table->enum('part_key', ['header', 'body', 'end', 'conclusion']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pepsol_lesson_parts');
    }
};
