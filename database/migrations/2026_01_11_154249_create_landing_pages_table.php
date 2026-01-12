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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('header_text');
            $table->text('header_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('header_color')->nullable();
            $table->string('hero_color')->nullable();
            $table->string('language_color')->nullable();
            $table->string('body_color')->nullable();
            $table->string('footer_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
