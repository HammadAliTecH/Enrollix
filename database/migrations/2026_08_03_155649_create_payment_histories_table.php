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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('pay_amount');
            $table->string('payment_mode');
            $table->date('pay_date');
            $table->foreignId('user_id')->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('payment_plan_id')->constrained('payment_plans')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
