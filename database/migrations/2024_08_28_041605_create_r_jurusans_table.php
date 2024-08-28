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
        Schema::create('r_jurusans', function (Blueprint $table) {
            $table->char('id_jur', 10)->primary();
            $table->string('nm_jur', 60)->nullable();
            $table->string('nm_intl_jur', 60)->nullable();
            $table->tinyInteger('u_sma')->nullable();
            $table->tinyInteger('u_smk')->nullable();
            $table->tinyInteger('u_pt')->nullable();
            $table->tinyInteger('u_slb')->nullable();
            $table->tinyInteger('id_jenj_didik')->nullable();
            $table->string('id_induk_jurusan', 10)->nullable();
            $table->string('id_kel_bidang', 20)->nullable();
            $table->integer('a_aktif')->notNullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_jurusans');
    }
};
