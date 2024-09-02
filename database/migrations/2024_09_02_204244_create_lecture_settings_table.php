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
        Schema::create('lecture_settings', function (Blueprint $table) {
            $table->id();
            $table->uuid('prodi_id');
            $table->int('max_number_of_meets');
            $table->int('min_number_of_presence');
            $table->boolean('kehadiranis_prodi');
            $table->timestamps();

            //FK
            $table->foreign('prodi_id')->references('id')->on('t_prodi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture_settings');
    }
};
