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
        Schema::create('disputes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('complainant_id'); // Who filed the dispute
            $table->unsignedBigInteger('respondent_id'); // Who the dispute is against
            $table->unsignedBigInteger('admin_id')->nullable(); // Admin handling the dispute
            $table->string('subject');
            $table->json('subject_translations')->nullable(); // French/Arabic
            $table->text('description');
            $table->json('description_translations')->nullable(); // French/Arabic
            $table->json('evidence')->nullable(); // Files, screenshots, etc.
            $table->enum('status', ['open', 'in_review', 'resolved', 'closed'])->default('open');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->text('admin_notes')->nullable();
            $table->text('resolution')->nullable();
            $table->json('resolution_translations')->nullable(); // French/Arabic
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('complainant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('respondent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');

            $table->index(['status', 'priority']);
            $table->index(['complainant_id', 'status']);
            $table->index(['task_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disputes');
    }
};
