<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSppkKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppk_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id')->on('sppk_kategori')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sppk_kriteria');
    }
}
