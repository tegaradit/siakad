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
            $table->foreign('curriculum_id')->references('curriculum_id')->on('curriculum')->onDelete('cascade');

            // Tambahkan foreign key yang mengacu pada kolom 'id' dari tabel courses yang juga menggunakan UUID
            $table->foreign('course_id')->references('id')->on('course')->onDelete('cascade');

            $table->integer('smt');
            
            // Membuat kolom SKS menjadi nullable
            $table->integer('sks_mk')->nullable();
            $table->integer('sks_tm')->nullable();
            $table->integer('sks_pr')->nullable();
            $table->integer('sks_pl')->nullable();
            $table->integer('sks_sim')->nullable();
            
            $table->boolean('is_mandatory');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculum_courses');
    }
};