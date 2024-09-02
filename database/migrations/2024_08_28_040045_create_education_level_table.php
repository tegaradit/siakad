<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('education_level', function (Blueprint $table) {
            $table->tinyInteger('id_jenj_didik')->primary();
            $table->string('nm_jenj_didik', 50)->nullable();
            $table->tinyInteger('u_jenj_lemb')->nullable();
            $table->tinyInteger('u_jenj_org')->nullable();
            $table->tinyInteger('a_aktif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_level');
    }

};