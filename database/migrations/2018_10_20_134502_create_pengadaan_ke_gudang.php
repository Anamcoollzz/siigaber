<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengadaanKeGudang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_ke_gudang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_gudang')->unsigned();
            $table->foreign('id_gudang')->on('gudang')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->double('jumlah');
            $table->string('status', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan_ke_gudang');
    }
}
