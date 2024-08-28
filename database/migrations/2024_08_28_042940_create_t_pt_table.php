<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pt', function (Blueprint $table) {
            $table->string('id_pt', 64)->primary();
            $table->string('kode_pt', 10);
            $table->string('nama_pt', 100);
            $table->string('nama_singkat', 100)->charset('utf8mb4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pt');
    }
}
