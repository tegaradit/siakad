<?php

use App\Models\t_pt;
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
        schema::create('all_prodi', function(Blueprint $table){
            $table->string('id_prodi', 40)->primary();
            $table->string('id_pt', 40); //fk
            $table->string('kode_prodi', 6);
            $table->string('nama_prodi', 50);
            $table->char('status', 2);
            $table->tinyInteger('id_jenjang_pendidikan');
            $table->timestamps();

            //foreign key
<<<<<<< HEAD:database/migrations/2024_08_30_015531_t_all_prodi.php
            $table->foreign('id_pt')->references('id_pt')->on('t_pt')->onDelete('cascade');
            $table->foreign('id_jenjang_pendidikan')->references('id_jenj_didik')->on('education_level')->onDelete('cascade');
=======
            $table->foreign('id_pt')->references('id_university')->on('university')->onDelete('cascade');
>>>>>>> 94aa9a1dc6a7c0c20db96c2586ed287f19b6ac28:database/migrations/2024_08_30_015531_all_prodi.php
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_prodi');
    }
};