<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSppkPrioritasKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppk_prioritas_kategori', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id')->on('sppk_kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_sppk')->unsigned();
            $table->foreign('id_sppk')->references('id')->on('sppk')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sppk_prioritas_kategori');
    }
}
