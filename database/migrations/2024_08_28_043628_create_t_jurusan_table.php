<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRJurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_jurusan', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_jurusan');
    }
}
