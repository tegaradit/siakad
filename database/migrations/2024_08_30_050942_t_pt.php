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
        Schema::create('t_pt', function (Blueprint $table) {
            $table->string('id_pt', 64)->primary();
            $table->string('kode_pt', 10);
            $table->string('nama_pt', 100);
            $table->string('nama_singkat', 100)->charset('utf8mb4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pt');
    }
};
