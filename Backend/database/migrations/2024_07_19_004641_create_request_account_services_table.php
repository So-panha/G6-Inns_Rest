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
        Schema::create('request_account_services', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('image_1');
            $table->string('image_2');
            $table->text('message');
            $table->boolean('status')->default(0);
            $table->boolean('response');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_account_services');
    }
};
