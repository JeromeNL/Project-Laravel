<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->boolean('private')->default(false)->after('submissions_limit');
        });

        Schema::table('competition_user', function (Blueprint $table) {
            $table->boolean('accepted')->nullable(true)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn('private');
        });

        Schema::table('competition_user', function (Blueprint $table) {
            $table->dropColumn('accepted');
        });
    }
};
