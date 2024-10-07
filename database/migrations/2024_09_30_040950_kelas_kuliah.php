<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KelasKuliah extends Migration
{
    public function up()
    {
        Schema::create('kelas_kuliah', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('prodi_id', 36);
            $table->char('semester_id', 6);
            $table->foreign('prodi_id', 'prodiiiiiiii')->references('id_prodi')->on('all_prodi')->onDelete('cascade');
            $table->foreign('semester_id','semesterrr')->references('semester_id')->on('semester')->onDelete('cascade');
            $table->string('nama_kelas', 50);
            $table->tinyInteger('sks_mk');
            $table->tinyInteger('sks_tm');
            $table->tinyInteger('sks_pr');
            $table->tinyInteger('sks_lap');
            $table->tinyInteger('sks_sim');
            $table->date('start_date');
            $table->date('end_date');
            $table->uuid('course_id');
            $table->foreign('course_id','courseeeee')->references('id')->on('course')->onDelete('cascade');
            $table->integer('quota');
            $table->decimal('pn_presensi', 7, 2);
            $table->decimal('pn_tugas', 7, 2)->nullable();
            $table->decimal('pn_uas', 7, 2)->nullable();
            $table->integer('max_pertemuan');
            $table->integer('min_kehadiran');
            $table->string('enrollment_key', 20)->nullable();
            $table->tinyInteger('grade_status')->default(0);
            $table->string('uts_question', 255)->nullable(); // path to UTS question PDF
            $table->string('uas_question', 255)->nullable(); // path to UAS question PDF
            $table->enum('class_type', ['single', 'group']);
            $table->unsignedBigInteger('group_class_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas_kuliah');
    }
}
