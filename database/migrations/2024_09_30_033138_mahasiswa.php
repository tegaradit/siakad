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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->uuid('id_pd')->primary();
            $table->string('nm_pd', 100)->nullable();
            $table->char('jk', 1)->nullable();
            $table->string('jln', 80)->nullable();
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            $table->string('nm_dsn', 60)->nullable();
            $table->string('ds_kel', 60)->nullable();
            $table->char('kode_pos', 5)->nullable();
            $table->char('nisn', 10)->nullable();
            $table->char('nik', 16)->nullable();
            $table->string('tmpt_lahir', 255)->nullable(); //--> this has been change, length from 32 to 255
            $table->date('tgl_lahir')->nullable();
            $table->string('nm_ayah', 100)->nullable();
            $table->date('tgl_lahir_ayah')->nullable();
            $table->char('nik_ayah', 16)->nullable();
            $table->decimal('id_jenjang_pendidikan_ayah', 2, 0)->nullable();
            $table->integer('id_pekerjaan_ayah')->nullable();
            $table->integer('id_penghasilan_ayah')->nullable();
            $table->integer('id_kebutuhan_khusus_ayah')->nullable();
            $table->string('nm_ibu_kandung', 100)->nullable();
            $table->date('tgl_lahir_ibu')->nullable();
            $table->char('nik_ibu', 16)->nullable();
            $table->decimal('id_jenjang_pendidikan_ibu', 2, 0)->nullable();
            $table->integer('id_pekerjaan_ibu')->nullable();
            $table->integer('id_penghasilan_ibu')->nullable();
            $table->integer('id_kebutuhan_khusus_ibu')->nullable();
            $table->string('nm_wali', 100)->nullable();
            $table->date('tgl_lahir_wali')->nullable();
            $table->decimal('id_jenjang_pendidikan_wali', 2, 0)->nullable();
            $table->integer('id_pekerjaan_wali')->nullable();
            $table->integer('id_penghasilan_wali')->nullable();
            $table->integer('id_kk')->nullable();
            $table->string('no_tel_rmh', 20)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 60)->nullable();
            $table->decimal('a_terima_kps', 1, 0)->default(0);
            $table->string('no_kps', 80)->default('');
            $table->char('npwp', 15)->default('');
            $table->char('id_wil', 8)->default('999999');
            $table->decimal('id_jns_tinggal', 2, 0)->default(0);
            $table->smallInteger('id_agama')->default(98);
            $table->decimal('id_alat_transport', 2, 0)->default(0);
            $table->char('kewarganegaraan', 2)->nullable();
            $table->integer('no_daftar_lama')->nullable();
            $table->text('foto'); //--> this has been change, Dtype from string to text
            $table->char('id_kabupaten', 6)->nullable();
            $table->string('id_kecamatan', 100);
            $table->tinyInteger('id_goldarah');
            $table->string('asal_sma', 50);
            $table->string('jenjangsekolah', 30); //--> this has been change, length from 3 to 30
            $table->string('jurusan_sekolah_asal', 30);
            $table->string('nomor_sttb', 50);
            $table->decimal('rata_nilai_sttb', 5, 2);
            $table->tinyInteger('status_data')->default(1);
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
        Schema::dropIfExists('mahasiswa');
    }
};
