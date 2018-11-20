<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSppkPrioritasKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppk_prioritas_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_prioritas_kategori')->unsigned();
            $table->foreign('id_prioritas_kategori')->references('id')->on('sppk_prioritas_kategori')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sppk_prioritas_kriteria');
    }
}
