<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('curriculum_courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('curriculum_id');
            $table->uuid('course_id');  // Menggunakan UUID karena mengacu pada primary key UUID di tabel courses

            // Tambahkan foreign key yang mengacu pada kolom 'id' dari tabel dengan UUID
            $table->foreign('curriculum_id')->references('id')->on('curriculums')->onDelete('cascade');

            // Tambahkan foreign key yang mengacu pada kolom 'id' dari tabel courses yang juga menggunakan UUID
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->integer('smt');
            $table->integer('sks_mk');
            $table->integer('sks_tm');
            $table->integer('sks_pr');
            $table->integer('sks_pl');
            $table->integer('sks_sim');
            $table->boolean('is_mandatory');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculum_courses');
    }
};