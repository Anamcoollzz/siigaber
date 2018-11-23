<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSppkDetailDaerah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppk_detail_daerah', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_prioritas_sub_kriteria')->unsigned();
            $table->foreign('id_prioritas_sub_kriteria')->references('id')->on('sppk_prioritas_sub_kriteria')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_daerah_tujuan')->unsigned();
            $table->foreign('id_daerah_tujuan')->references('id')->on('sppk_daerah_tujuan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sppk_detail_daerah');
    }
}
