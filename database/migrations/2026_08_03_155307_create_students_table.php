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
       Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('name');
            $table->enum('gender', ['MALE', 'FEMALE']);
            $table->unsignedTinyInteger('age');
            $table->string('cnic_number')->unique();
            $table->string('cnic_document'); // file path
            $table->string('image'); // file path
            $table->string('father_name');
            $table->string('father_cnic');
            $table->string('father_occupation');

            // Contact Information
            $table->string('contact_number');
            $table->string('father_cell_number');
            $table->string('email')->unique();
            $table->text('address');

            // Education Detail
            $table->string('recent_education'); // 8TH, MATRIC (PART-I), etc.
            $table->string('marks'); // obtained/out_of
            $table->string('enrolled_program'); // current enroll program (was duplicate "current_education")
            $table->string('educational_place');
            $table->string('additional_document')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
