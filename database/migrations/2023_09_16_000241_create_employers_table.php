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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key column
            $table->string('name');
            $table->string('email')->unique()->nullable(); // Email address (unique)
            $table->string('function_title')->nullable(); // Function title
            $table->string('department')->nullable(); // Department 

            $table->string('company_name')->default('Default Company Name');
            $table->string('company_industry')->nullable();
            $table->string('company_overview')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('address')->nullable();
            $table->string('company_contact_number')->nullable(); 
            $table->string('company_website')->nullable(); 
            $table->string('company_size')->nullable(); 
            $table->string('company_working_hour')->nullable();
            $table->string('company_dress_code')->nullable();
            $table->string('company_benefits')->nullable(); 
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }

    public function before()
    {
        $this->before = [
            '2023_09_17_074515_create_listings_table',
        ];
    }
};
