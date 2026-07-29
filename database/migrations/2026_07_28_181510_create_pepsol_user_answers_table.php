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
        Schema::create('pepsol_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pepsol_user_quiz_attempt_id')->constrained('pepsol_user_quiz_attempts')->cascadeOnDelete();
            $table->foreignId('pepsol_question_id')->constrained('pepsol_questions')->cascadeOnDelete();
            $table->foreignId('selected_option_id')->nullable()->constrained('pepsol_question_options')->cascadeOnDelete();
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pepsol_user_answers');
    }
};
