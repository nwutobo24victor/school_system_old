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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('class')->nullable();
            $table->string('teacher')->nullable();
            $table->string('type')->nullable();
            $table->string('pass_mark')->nullable();
            $table->string('total_mark')->nullable();
            $table->string('subject')->nullable();
            $table->string('subject_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
