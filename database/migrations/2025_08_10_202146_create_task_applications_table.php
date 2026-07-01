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
        Schema::create('task_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('tasker_id');
            $table->text('proposal');
            $table->json('proposal_translations')->nullable(); // French/Arabic
            $table->decimal('proposed_budget', 10, 2);
            $table->integer('estimated_duration'); // in hours
            $table->text('experience_description')->nullable();
            $table->json('portfolio_items')->nullable(); // Array of portfolio links/images
            $table->enum('status', ['pending', 'accepted', 'rejected', 'withdrawn'])->default('pending');
            $table->datetime('accepted_at')->nullable();
            $table->datetime('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('tasker_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['task_id', 'tasker_id']); // One application per tasker per task
            $table->index(['task_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_applications');
    }
};
