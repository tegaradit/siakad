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
        Schema::create('curriculum', function (Blueprint $table) {
            $table->uuid('curriculum_id')->primary();
            $table->string('prodi_id', 40);
            $table->tinyInteger('education_level_id');
            $table->char('semester_id', 6);
            $table->string('name', 200);
            $table->integer('normal_semester_number');
            $table->integer('pass_credit_number');
            $table->integer('mandatory_credit_number');
            $table->integer('choice_credit_number');
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('prodi_id')->references('id_prodi')->on('all_prodi');
            $table->foreign('education_level_id')->references('id_jenj_didik')->on('education_level');
            $table->foreign('semester_id')->references('semester_id')->on('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum');
    }
};
