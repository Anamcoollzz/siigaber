<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSppkPrioritasSubKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppk_prioritas_sub_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->tinyInteger('prioritas');
            $table->double('bobot');
            $table->integer('id_sub_kriteria')->unsigned();
            $table->foreign('id_sub_kriteria')->references('id')->on('sppk_sub_kriteria')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_prioritas_kriteria')->unsigned();
            $table->foreign('id_prioritas_kriteria')->references('id')->on('sppk_prioritas_kriteria')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sppk_prioritas_sub_kriteria');
    }
}
