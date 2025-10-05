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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->unique()->nullable()->after('name');
            $table->string('profile_picture')->nullable()->after('nickname');
            $table->boolean('profile_completed')->default(false)->after('profile_picture');
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->boolean('is_admin')->default(false)->after('profile_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nickname', 'profile_picture', 'profile_completed', 'google_id', 'is_admin']);
        });
    }
};
