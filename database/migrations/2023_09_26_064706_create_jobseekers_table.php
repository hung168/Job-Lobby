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
        Schema::create('jobseekers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key column
            $table->string('jobseeker_profile_pic')->nullable(); // profile picture
            $table->string('name'); // Name of the job seeker
            $table->string('address')->nullable(); // Address of the job seeker
            $table->date('date_of_birth')->nullable(); // Date of birth
            $table->string('gender')->nullable(); // Gender 
            $table->string('nationality')->nullable(); // Nationality
            $table->string('email')->unique()->nullable(); // Email address (unique)
            $table->string('telephone')->nullable(); // Telephone number
            $table->string('field_of_major')->nullable(); // Field of Major
            $table->string('education_level')->nullable(); // Education Level number
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobseekers');
    }
};
