<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSppkSubKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppk_sub_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('id_kriteria')->unsigned();
            $table->foreign('id_kriteria')->references('id')->on('sppk_kriteria')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sppk_sub_kriteria');
    }
}
