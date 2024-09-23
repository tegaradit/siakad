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
        Schema::create('course', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('prodi_id', 40);
            $table->tinyInteger('education_level_id');
            $table->string('code', 10);
            $table->string('name', 200);
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('type_id');
            $table->integer('sks_mk');
            $table->integer('sks_tm');
            $table->integer('sks_pr');
            $table->integer('sks_pl');
            $table->integer('sks_sim');
            $table->enum('status',['Active','Deleted','Non-Active']);
            $table->boolean('is_sap');
            $table->boolean('is_silabus');
            $table->boolean('is_teaching_material');
            $table->boolean('is_praktikum');
            $table->date('effective_start_date');
            $table->date('effective_end_date');
            $table->timestamps();

            // Foreign keys
            $table->foreign('prodi_id', 'course_references_all_prodi')->references('id_prodi')->on('all_prodi')->onDelete('cascade');
            $table->foreign('education_level_id')->references('id_jenj_didik')->on('education_level')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('course_group')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('course_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};