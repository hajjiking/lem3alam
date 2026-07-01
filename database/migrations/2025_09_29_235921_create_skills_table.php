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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('name_translations')->nullable(); // For multilingual support
            $table->text('description')->nullable();
            $table->json('description_translations')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('icon')->nullable(); // CSS class or icon name
            $table->string('color')->nullable(); // Hex color for UI
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['category_id', 'is_active']);
            $table->index(['slug', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
