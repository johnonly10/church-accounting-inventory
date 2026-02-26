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
        Schema::create('pepsol_lesson_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pepsol_lesson_part_id')->constrained('pepsol_lesson_parts')->cascadeOnDelete();
            $table->text('body');
            $table->text('quote');
            $table->text('scripture');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('file')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pepsol_lesson_blocks');
    }
};
