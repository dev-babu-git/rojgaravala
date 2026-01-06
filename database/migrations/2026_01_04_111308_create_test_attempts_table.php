<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_attempts', function (Blueprint $table) {

            $table->id();

            // USER (nullable for guest)
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
 
            // TEST
            $table->foreignId('test_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Will store user id after login
            $table->unsignedBigInteger('attempt_user_id')->nullable();

            // Attempt status
            $table->enum('status', ['started', 'completed'])
                  ->default('started');

            // Result data
            $table->integer('score')->nullable();
            $table->integer('total_questions')->nullable();
            $table->integer('correct_answers')->nullable();

            // Timing
            $table->timestamp('started_at')->nullable();
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();

            // Prevent duplicate active attempts
            $table->unique(['test_id', 'attempt_user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};
