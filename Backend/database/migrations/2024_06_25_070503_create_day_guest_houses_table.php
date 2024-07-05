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
        Schema::create('day_guest_houses', function (Blueprint $table) {
            $table->unsignedInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->unsignedInteger('guesthouse_id');
            $table->foreign('guesthouse_id')->references('id')->on('guest_houses')->onDelete('cascade');
            $table->string('from_hours');
            $table->string('from_minutes');
            $table->string('to_hours');
            $table->string('to_minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_guest_houses');
    }
};
