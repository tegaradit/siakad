<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_prodi', function (Blueprint $table) {
            $table->char('id_prodi', 36)->primary();
            $table->string('nama_prodi', 100)->nullable();
            $table->char('smt_mulai', 5)->nullable();
            $table->string('kode_prodi', 10)->nullable();
            $table->string('nm_prodi_english', 100)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('website', 256)->nullable();
            $table->string('singkatan', 50)->nullable();
            $table->date('tgl_berdiri')->nullable();
            $table->string('sk_selenggara', 80)->nullable();
            $table->date('tgl_sk_selenggara')->nullable();
            $table->date('tmt_sk_selenggara')->nullable();
            $table->date('tst_sk_selenggara')->nullable();
            $table->decimal('kpst_pd', 5, 0)->nullable();
            $table->decimal('sks_lulus', 3, 0)->nullable();
            $table->string('gelar_lulusan', 10)->nullable();
            $table->char('status', 1)->nullable();
            $table->char('polesei_nilai', 1)->nullable();
            $table->decimal('a_kependidikan', 1, 0)->nullable();
            $table->decimal('sistem_ajar', 1, 0)->nullable();
            $table->decimal('luas_lab', 5, 0)->nullable();
            $table->decimal('kapasitas_prak_satu_shift', 4, 0)->nullable();
            $table->decimal('jml_mhs_pengguna', 6, 0)->nullable();
            $table->decimal('jml_jam_penggunaan', 5, 1)->nullable();
            $table->decimal('jml_prodi_pengguna', 3, 0)->nullable();
            $table->decimal('jml_modul_prak_sendiri', 4, 0)->nullable();
            $table->decimal('jml_modul_prak_lain', 4, 0)->nullable();
            $table->char('fungsi_selain_prak', 1)->nullable();
            $table->char('penggunaan_lab', 1)->nullable();
            $table->string('id_sp', 40)->nullable();
            $table->tinyInteger('id_jenj_didik')->nullable();
            $table->decimal('id_jns_sms', 2, 0)->nullable();
            $table->char('id_fungsi_lab', 1)->nullable();
            $table->char('id_kel_usaha', 8)->nullable();
            $table->string('id_blob', 40)->nullable();
            $table->char('id_wil', 8)->nullable();
            $table->string('id_jur', 25)->nullable();
            $table->smallInteger('id_fakultas')->default(0);
            $table->string('id_induk_sms', 40)->nullable();
            $table->char('kode', 3)->nullable();
            $table->tinyInteger('max_sks1')->nullable();

            $table->foreign('id_sp')->references('id_sp')->on('educational_unit')->onDelete('cascade');
            $table->foreign('id_jenj_didik')->references('id_jenj_didik')->on('education_level')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_prodi');
    }
};