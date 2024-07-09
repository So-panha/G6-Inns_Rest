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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('capacity');
            $table->integer('status')->default(0);
            $table->integer('check_in')->default(0);
            $table->integer('bed_type')->nullable();
            $table->integer('type_of_room')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->string('description');
            $table->integer('guest_house_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->SoftDeletes('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
