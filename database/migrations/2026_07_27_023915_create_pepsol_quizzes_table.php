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
        Schema::create('pepsol_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pepsol_lesson_id')->constrained('pepsol_lessons')->cascadeOnDelete();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('instructions')->nullable();
            $table->integer('passing_score')->default(5);
            $table->boolean('allow_retake')->default(true);
            $table->integer('max_attempts')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pepsol_quizzes');
    }
};
