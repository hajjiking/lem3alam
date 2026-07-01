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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Default name
            $table->json('name_translations'); // French/Arabic translations
            $table->text('description')->nullable();
            $table->json('description_translations')->nullable(); // French/Arabic descriptions
            $table->string('icon')->nullable(); // Icon for category
            $table->string('color', 7)->default('#3B82F6'); // Hex color for UI
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable(); // For subcategories
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
