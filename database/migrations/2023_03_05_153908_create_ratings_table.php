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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->double('rating');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->foreignId('submission_id')->constrained(); // id of item that is rated
            $table->foreignId('user_id')->constrained(); // id of the 'rater'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
