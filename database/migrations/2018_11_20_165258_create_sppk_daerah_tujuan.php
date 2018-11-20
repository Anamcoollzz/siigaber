<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSppkDaerahTujuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppk_daerah_tujuan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_desa');
            $table->string('nama_kecamatan');
            $table->string('nama_kepala_desa');
            $table->double('kebutuhan');
            $table->double('jarak');
            $table->double('biaya');
            $table->date('tanggal_distribusi');
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
        Schema::dropIfExists('sppk_daerah_tujuan');
    }
}
