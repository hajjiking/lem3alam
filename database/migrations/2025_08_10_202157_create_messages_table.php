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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id')->nullable(); // Related task (optional)
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->text('content');
            $table->json('content_translations')->nullable(); // French/Arabic
            $table->json('attachments')->nullable(); // File attachments
            $table->enum('type', ['text', 'file', 'system'])->default('text');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_deleted_by_sender')->default(false);
            $table->boolean('is_deleted_by_receiver')->default(false);
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('set null');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');

            $table->index(['sender_id', 'receiver_id']);
            $table->index(['task_id', 'created_at']);
            $table->index(['receiver_id', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
