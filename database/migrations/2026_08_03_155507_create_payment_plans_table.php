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
        Schema::create('payment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->integer('total_installments');
            $table->integer('total_fee');
            $table->date('starting_date');
            $table->date('due_date');
            $table->integer('fee_per_installment');
            $table->integer('installment_no');
            $table->enum('status' , ['pending' , 'paid'])->default('pending');
            $table->foreignId('student_course_id')->constrained('student_course')
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
        Schema::dropIfExists('payment_plans');
    }
};
