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
        Schema::create('t_prodi', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID as primary key
            $table->string('code', 6); // varchar(6)
            $table->string('name', 255); // varchar(255)
            $table->unsignedBigInteger('department_id'); // Foreign key to r_jurusan
            $table->unsignedBigInteger('education_level_id'); // Foreign key to id_jenj_didik
            $table->integer('credit_passed'); // integer
            $table->enum('status', ['A', 'H', 'B', 'N', 'K']); // enum
            $table->timestamps(); // created_at, updated_at

            // Foreign key constraints
            $table->foreign('department_id')->references('id')->on('r_jurusan')->onDelete('cascade');
            $table->foreign('education_level_id')->references('id')->on('id_jenj_didik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_prodi');
    }
};
