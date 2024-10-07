<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dosen_walis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lecture_id');
            $table->uud('id_pd');
            $table->timestamps();

            $table->foreign('lecture_id')->references('id')->on('lecturer')->onDelete('cascade');
            $table->foreign('id_pd')->references('id_pd')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_walis');
    }
};