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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('school_year')->nullable();
            $table->integer('term')->nullable();
            $table->string('class')->nullable();
            $table->string('section')->nullable();
            $table->string('subject')->nullable();
            $table->string('day')->nullable();
            $table->string('teacher')->nullable();
            $table->string('starting_time')->nullable();
            $table->string('ending_time')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
