<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailGudang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_gudang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_gudang')->unsigned();
            $table->foreign('id_gudang')->on('gudang')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_jenis_beras')->unsigned();
            $table->foreign('id_jenis_beras')->on('jenis_beras')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->double('jml_gabah')->default(0);
            $table->double('jml_beras')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_gudang');
    }
}
