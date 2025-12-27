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
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('test_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('question_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('option_id')
                ->constrained()
                ->onDelete('cascade');

            $table->timestamps();

            // Ek student ek question ka ek hi answer de
            $table->unique(['user_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
