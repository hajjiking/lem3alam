<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('phone_verified_at')->nullable()->after('phone');
            $table->timestamp('suspended_until')->nullable()->after('status');
            $table->timestamp('banned_at')->nullable()->after('suspended_until');
            $table->string('ban_reason')->nullable()->after('banned_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_verified_at', 'suspended_until', 'banned_at', 'ban_reason']);
        });
    }
};
