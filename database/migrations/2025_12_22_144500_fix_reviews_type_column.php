<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('reviews', 'type')) {
            if (DB::getDriverName() === 'mysql') {
                DB::statement("ALTER TABLE reviews MODIFY COLUMN type VARCHAR(50) NULL DEFAULT 'task'");
            }
        } else {
            Schema::table('reviews', function (Blueprint $table) {
                $table->string('type', 50)->nullable()->default('task');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting this is risky if data exists, but we can try to revert to a smaller size if needed.
        // For now, leaving it as is safe.
    }
};
