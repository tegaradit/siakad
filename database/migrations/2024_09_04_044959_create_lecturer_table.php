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
        Schema::create('lecturer', function (Blueprint $table) {
            $table->id();
            $table->string('nuptk', 16);
            $table->string('nidn', 10)->nullable();
            $table->string('nik', 16)->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('name', 200);
            $table->char('active_status_id', 1);
            $table->date('birth_date');
            $table->string('birth_place', 100);
            $table->string('mothers_name', 200);
            $table->enum('mariage_status', ['belum kawin', 'kawin', 'cerai hidup', 'cerai mati']);
            $table->char('employee_level_id', 1);
            $table->enum('level_education', ['S1', 'S2', 'S3']);
            $table->string('phone_number', 13)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('assign_letter_number', 30)->nullable();
            $table->date('assign_letter_date')->nullable();
            $table->date('assign_letter_tmt')->nullable();
            $table->date('exit_date')->nullable();
            $table->string('prodi_id', 40);
            $table->timestamps();

            // Foreign keys
            $table->foreign('active_status_id')->references('id')->on('active_status');
            $table->foreign('employee_level_id')->references('id')->on('employee_level');
            $table->foreign('prodi_id', 'lecturer_references_all_prodi')->references('id_prodi')->on('all_prodi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer');
    }
};