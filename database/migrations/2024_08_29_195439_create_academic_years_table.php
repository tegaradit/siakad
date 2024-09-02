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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->char('id', 4)->primary();  // Mendefinisikan kolom id dengan tipe CHAR dan panjang 4
            $table->string('name', 10);        // Menggunakan metode string untuk VARCHAR
            $table->date('start_date');        // Menambahkan kolom tanggal untuk start_date
            $table->date('end_date');          // Menambahkan kolom tanggal untuk end_date
            $table->timestamps();              // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};
