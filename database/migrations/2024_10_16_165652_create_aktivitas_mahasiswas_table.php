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
        Schema::create('aktivitas_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_reg_pd'); 
            $table->char('semester_id', 6);
            $table->text('title');
            $table->string('location', 80);
            $table->string('sk_number', 20); 
            $table->date('sk_date'); 
            $table->text('description');
            $table->unsignedBigInteger('activity_type_id');
            $table->timestamps();

            //fk
            $table->foreign('id_reg_pd')->references('id_reg_pd')->on('mahasiswa_pt')->onDelete('cascade');
            $table->foreign('semester_id')->references('semester_id')->on('semester')->onDelete('cascade');
            $table->foreign('activity_type_id')->references('id')->on('activity_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_mahasiswas');
    }
};
