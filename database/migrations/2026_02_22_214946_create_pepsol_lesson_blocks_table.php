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
            $table->enum('block_type', [
                'heading',
                'subheading',
                'paragraph',
                'quote',
                'scripture',
                'question',
                'prayer',
                'list',
                'divider'
            ]);
            $table->longText('content')->nullable();
            $table->string('reference')->nullable();
            $table->string('media')->nullable();
            $table->integer('sort_order')->default(1);
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
