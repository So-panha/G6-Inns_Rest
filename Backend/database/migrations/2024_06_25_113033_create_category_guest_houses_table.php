<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('category_guest_houses', function (Blueprint $table) {
            $table->unsignedInteger('guesthouse_id');
            $table->foreign('guesthouse_id', 'guesthouse_id_fk_667152')->references('id')->on('guest_houses')->onDelete('cascade');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_667152')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_guest_houses');
    }
};
