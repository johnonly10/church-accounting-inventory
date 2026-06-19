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
        Schema::create('pepsol_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pepsol_id')->constrained('pepsols')->cascadeOnDelete();
            $table->foreignId('pepsol_name_id')->constrained('pepsol_names')->cascadeOnDelete();
            $table->foreignId('pepsol_topic_id')->constrained('pepsol_topics')->cascadeOnDelete();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('summary')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pepsol_lessons');
    }
};
