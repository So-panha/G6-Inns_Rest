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
        Schema::create('booking_user_rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('number_of_rooms');
            $table->date('departure_date');
            $table->date('arrival_date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('paymented', 8, 2);
            $table->integer('checked')->default(0);
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('create_by_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_user_rooms');
    }
};
