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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // python, php
            $table->string('display_name'); // Python, PHP
            $table->string('slug')->unique();
            $table->string('version'); // 3.10.0
            $table->string('runtime'); // python3

            $table->boolean('is_active')->default(false);
            $table->boolean('is_default')->default(false);

            $table->string('icon')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
