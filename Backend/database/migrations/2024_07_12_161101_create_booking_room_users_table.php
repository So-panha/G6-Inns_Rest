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
        Schema::create('booking_room_users', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->integer('number_of_rooms');
            $table->date('departure_date');
            $table->date('arrival_date');

            $table->foreignId('user_id')->references('id')->on('user_normals');
            $table->foreignId('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_room_users');
    }
};
