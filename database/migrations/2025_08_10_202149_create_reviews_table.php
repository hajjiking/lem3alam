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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('reviewer_id'); // Who is giving the review
            $table->unsignedBigInteger('reviewee_id'); // Who is being reviewed
            $table->integer('rating'); // 1-5 stars
            $table->text('comment')->nullable();
            $table->json('comment_translations')->nullable(); // French/Arabic
            $table->enum('type', ['client_to_tasker', 'tasker_to_client']);
            $table->boolean('is_public')->default(true);
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewee_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['task_id', 'reviewer_id', 'reviewee_id']); // One review per task per pair
            $table->index(['reviewee_id', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
