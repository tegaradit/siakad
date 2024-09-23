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
            $table->string('prodi_id', 40);
            $table->integer('max_number_of_meets');
            $table->integer('min_number_of_presence');
            $table->boolean('is_prodi');
            $table->timestamps();
    
            $table->foreign('prodi_id', 'lecture_settings_references_all_prodi')->references('id_prodi')->on('all_prodi')->onDelete('cascade');
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
