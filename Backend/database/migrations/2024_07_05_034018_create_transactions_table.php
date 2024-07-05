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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('client_name');
            $table->string('client_avatar');
            $table->string('payment_type');
            $table->date('paid_date');
            $table->decimal('amount', 10, 2);
            $table->string('status'); // 'Pending', 'Success', etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
