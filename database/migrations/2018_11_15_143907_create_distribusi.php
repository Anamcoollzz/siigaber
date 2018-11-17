<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistribusi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribusi', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_mulai');
            $table->double('biaya_transport')->default(0);
            $table->string('status', 50)->default('menunggu persetujuan');
            $table->integer('id_mitra_kerja')->unsigned()->nullable();
            $table->foreign('id_mitra_kerja')->on('mitra_kerja')->references('id')->onUpdate('set null')->onDelete('set null');
            $table->integer('id_jenis_beras')->unsigned();
            $table->foreign('id_jenis_beras')->on('jenis_beras')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tipe',30);
            $table->string('nama_desa')->nullable();
            $table->string('nama_kecamatan')->nullable();
            $table->string('nama_kepala_desa')->nullable();
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
        Schema::dropIfExists('distribusi');
    }
}
