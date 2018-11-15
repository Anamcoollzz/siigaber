<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggilingan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggilingan', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->double('biaya');
            $table->double('biaya_transport')->default(0);
            $table->string('status', 50)->default('menunggu persetujuan');
            $table->integer('id_mitra_kerja')->unsigned();
            $table->foreign('id_mitra_kerja')->on('mitra_kerja')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_jenis_beras')->unsigned();
            $table->foreign('id_jenis_beras')->on('jenis_beras')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggilingan');
    }
}
