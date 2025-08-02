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
            $table->string('status')->nullable();
            $table->string('surname')->nullable();
            $table->string('othernames')->nullable();
            $table->string('guardian')->nullable();
            $table->string('date_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('current_address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state_origin')->nullable();
            $table->string('local_govt_area')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('class')->nullable();
            $table->string('section')->nullable();
            $table->string('department')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('passport_photo')->nullable();
            $table->string('remark')->nullable();
            $table->string('username')->nullable();
            $table->string('password');
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
