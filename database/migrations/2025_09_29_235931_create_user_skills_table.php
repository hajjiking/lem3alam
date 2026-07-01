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
        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->enum('experience_level', ['beginner', 'intermediate', 'advanced', 'expert'])->default('intermediate');
            $table->integer('years_experience')->nullable();
            $table->text('description')->nullable(); // Custom description of their experience
            $table->boolean('is_verified')->default(false); // For future skill verification
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'skill_id']);
            $table->index(['user_id', 'experience_level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_skills');
    }
};
