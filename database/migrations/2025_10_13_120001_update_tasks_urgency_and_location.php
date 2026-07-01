<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }
        // Add 'urgent' to urgency enum and make location nullable
        DB::statement("ALTER TABLE tasks MODIFY COLUMN urgency ENUM('low','medium','high','urgent') NOT NULL DEFAULT 'medium'");
        DB::statement('ALTER TABLE tasks MODIFY COLUMN location VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }
        // Revert urgency to original enum and location to NOT NULL
        DB::statement("ALTER TABLE tasks MODIFY COLUMN urgency ENUM('low','medium','high') NOT NULL DEFAULT 'medium'");
        DB::statement('ALTER TABLE tasks MODIFY COLUMN location VARCHAR(255) NOT NULL');
    }
};
