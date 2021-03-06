<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPenggilingan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penggilingan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_gudang')->unsigned();
            $table->foreign('id_gudang')->on('gudang')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_penggilingan')->unsigned();
            $table->foreign('id_penggilingan')->on('penggilingan')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->double('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penggilingan');
    }
}
