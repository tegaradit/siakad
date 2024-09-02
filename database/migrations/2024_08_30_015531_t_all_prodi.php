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
        schema::create('t_all_prodi', function(Blueprint $table){
            $table->string('id_prodi', 40)->primary();
            $table->string('id_pt', 40); //fk
            $table->foreign('id_pt')->references('id_pt')->on('t_pt')->onDelete('cascade');
            $table->string('kode_prodi', 6);
            $table->string('nama_prodi', 50);
            $table->char('status', 2);
            $table->tinyInteger('id_jenjang_pendidikan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_all_prodi');
    }
};