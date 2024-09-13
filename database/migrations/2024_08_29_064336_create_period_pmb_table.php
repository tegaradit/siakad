<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* 
-       semester_id     : 20231 → tahun 2023 semester 1 → PK
-       period_number   : 1/2/3 (int) gelombang pendaftarn
-       start_date
-       end_date
-       status      	: 0: Tutup, 1: Buka
-       created_at
-       updated_at
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('period_pmb', function (Blueprint $table) {
            $table->id();
            $table->char('semester_id', 6);
            $table->foreign('semester_id', 'period_semester_references')->references('semester_id')->on('semester')->onDelete('cascade');
            $table->tinyInteger('period_number');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_pmb');
    }
};
