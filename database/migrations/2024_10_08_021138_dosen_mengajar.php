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
        Schema::create('dosen_mengajar', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to lecturer table
            $table->char('lecture_id', 6); // Fix typo 'lucture_id' to 'lecture_id'
            $table->foreign('lecture_id')->references('id')->on('lecturer')->onDelete('cascade');
            
            // Foreign key to kelas_kuliah table
            $table->char('class_id', 36);
            $table->foreign('class_id')->references('id')->on('kelas_kuliah')->onDelete('cascade');

            // Number of TM planned and real
            $table->integer('number_of_tm_plan')->default(0); // Remove length argument
            $table->integer('number_of_tm_real')->default(0);  // Remove length argument
            
            // RPS document (path to uploaded PDF)
            $table->string('rps_doc')->nullable(); // Allow null if no file uploaded

            // Timestamps for created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_mengajar');
    }
};
