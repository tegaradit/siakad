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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->string('name', 100);
            $table->tinyInteger('floor_position')->unsigned(); // tinyint(4)
            $table->bigInteger('building_id')->unsigned()->change();
            $table->smallInteger('capacity')->unsigned(); // smallint
            $table->timestamps();

            //foreign key
            $table->foreign('building_id')->references('building_id')->on('buildings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};