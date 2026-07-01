<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('title_translations')->nullable(); // French/Arabic
            $table->text('description');
            $table->json('description_translations')->nullable(); // French/Arabic
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('assigned_tasker_id')->nullable();
            $table->decimal('budget_min', 10, 2);
            $table->decimal('budget_max', 10, 2);
            $table->enum('budget_type', ['fixed', 'hourly', 'project']);
            $table->string('location');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['open', 'assigned', 'in_progress', 'completed', 'cancelled'])->default('open');
            $table->enum('urgency', ['low', 'medium', 'high'])->default('medium');
            $table->datetime('deadline')->nullable();
            $table->json('required_skills')->nullable();
            $table->json('images')->nullable(); // Array of image paths
            $table->boolean('is_remote')->default(false);
            $table->integer('applications_count')->default(0);
            $table->datetime('assigned_at')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('assigned_tasker_id')->references('id')->on('users')->onDelete('set null');

            $table->index(['status', 'created_at']);
            $table->index(['category_id', 'status']);
            $table->index(['location', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
