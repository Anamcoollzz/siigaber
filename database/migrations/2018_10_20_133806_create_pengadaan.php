<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->double('jumlah');
            $table->double('biaya');
            $table->double('biaya_transport');
            $table->enum('jenis_pengadaan',['Beras','Gabah']);
            $table->integer('id_mitra_kerja')->unsigned();
            $table->foreign('id_mitra_kerja')->on('mitra_kerja')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan');
    }
}