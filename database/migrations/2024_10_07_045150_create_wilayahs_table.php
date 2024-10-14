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
        Schema::create('wilayah', function (Blueprint $table) {
            $table->char('id_wil', 8)->primary();
            $table->string('nm_wil', 50)->nullable();
            $table->char('asal_wil', 8)->nullable();
            $table->char('kode_bps', 7)->nullable();
            $table->char('kode_dagri', 7)->nullable();
            $table->string('kode_keu', 10)->nullable();
            $table->char('id_induk_wilayah', 8)->nullable();
            $table->smallInteger('id_level_wil')->nullable();
            $table->char('id_negara', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah');
    }
};
