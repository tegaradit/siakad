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
        Schema::create('identitas_pt', function (Blueprint $table) {
            $table->id();
            $table->string('current_id_sp', 40); //--> this field is correlations with field "id_sp" on table "educational_unit" 
            $table->char('current_npsn', 8); //--> this field is correlations with field "npsn" on table "educational_unit"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_pt');
    }
};
