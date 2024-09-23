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
        schema::create('educational_unit', function(Blueprint $table){
            $table->string('id_sp', 40)->primary();
            $table->string('nm_lemb', 100)->nullable();
            $table->char('nss', 12)->nullable();
            $table->char('npsn', 8)->nullable();
            $table->string('nm_singkat', 20)->nullable();
            $table->string('jln', 80)->nullable();
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            $table->string('nm_dsn', 60)->nullable();
            $table->string('ds_kel', 60)->nullable(); //10
            $table->char('kode_pos', 5)->nullable();
            $table->decimal('lintang', 11, 7)->nullable();
            $table->decimal('bujur', 11, 7)->nullable();
            $table->string('no_tel', 20)->nullable();
            $table->string('no_fax', 20)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('website', 256)->nullable();
            $table->char('stat_sp', 1)->nullable();
            $table->string('sk_pendirian_sp', 80)->nullable();
            $table->date('tgl_sk_pendirian_sp')->nullable();//10
            $table->date('tgl_berdiri')->nullable();
            $table->string('sk_izin_operasi', 80)->nullable();
            $table->date('tgl_sk_izin_operasi')->nullable();
            $table->string('no_rek', 20)->nullable();
            $table->string('nm_bank', 50)->nullable();
            $table->string('unit_cabang', 60)->nullable();
            $table->string('nm_rek', 50)->nullable();
            $table->decimal('a_mbs', 1, 0)->nullable();
            $table->decimal('luas_tanah_milik', 7, 0)->nullable();
            $table->decimal('luas_tanah_bukan_milik', 7, 0)->nullable();//10
            $table->decimal('a_lptk', 1, 0)->nullable();
            $table->bigInteger('kode_reg')->nullable();
            $table->char('npwp', 15)->nullable();
            $table->string('nm_wp', 100)->nullable();
            $table->char('flag', 1)->nullable();
            $table->string('id_pembina', 40)->nullable();
            $table->string('id_blob', 40)->nullable();
            $table->decimal('id_stat_milik', 1, 0)->nullable();
            $table->char('id_wil', 8)->nullable();
            $table->integer('id_kk')->nullable();//10
            $table->smallInteger('id_bp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_unit');
    }
};