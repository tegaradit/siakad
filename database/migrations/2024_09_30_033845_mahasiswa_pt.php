<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MahasiswaPt extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa_pt', function (Blueprint $table) {
            $table->id('id_mpt');
            $table->string('id_reg_pd', 40);
            $table->integer('id_mhs')->nullable();
            $table->string('id_pd', 40)->nullable();
            $table->string('id_sp', 40)->nullable();
            $table->string('id_prodi', 40)->nullable();
            $table->string('nipd', 24)->nullable();
            $table->string('nipd_lama', 24)->nullable();
            $table->date('tgl_masuk_sp')->nullable();
            $table->date('tgl_keluar')->nullable();
            $table->string('ket', 128)->nullable();
            $table->char('skhun', 20)->nullable();
            $table->char('no_peserta_ujian', 20)->nullable();
            $table->string('no_seri_ijazah', 80)->nullable();
            $table->boolean('a_pernah_paud')->nullable();
            $table->boolean('a_pernah_tk')->nullable();
            $table->timestamp('tgl_create')->useCurrent()->useCurrentOnUpdate();
            $table->string('mulai_smt', 5)->nullable();
            $table->decimal('sks_diakui', 3, 0)->nullable();
            $table->boolean('jalur_skripsi')->nullable();
            $table->string('judul_skripsi', 500)->nullable();
            $table->date('bln_awal_bimbingan')->nullable();
            $table->date('bln_akhir_bimbingan')->nullable();
            $table->string('sk_yudisium', 80)->nullable();
            $table->date('tgl_sk_yudisium')->nullable();
            $table->double('ipk')->nullable();
            $table->string('sert_prof', 80)->nullable();
            $table->boolean('a_pindah_mhs_asing')->nullable();
            $table->string('id_pt_asal', 40)->nullable();
            $table->string('id_prodi_asal', 40)->nullable();
            $table->decimal('id_jns_daftar', 2, 0)->nullable();
            $table->char('id_jns_keluar', 1);
            $table->decimal('id_jalur_masuk', 4, 0)->nullable();
            $table->decimal('id_pembiayaan', 4, 0)->nullable();
            $table->tinyInteger('id_jenis_mhs');
            $table->integer('biaya_masuk');
            $table->tinyInteger('status_data')->default(1);
            $table->integer('no_daftar')->nullable();
            $table->string('nmpd', 100)->default('');
            $table->tinyInteger('semester')->nullable();
            $table->tinyInteger('id_jenj_didik_biaya')->nullable();
            $table->tinyInteger('gen_tag_before')->default(0);
            $table->tinyInteger('mulai_pada_smt')->default(1);
            $table->tinyInteger('id_model_bayar')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa_pt');
    }
}
