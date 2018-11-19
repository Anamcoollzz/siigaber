<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdJenisBerasToPengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengadaan', function (Blueprint $table) {
            $table->integer('id_jenis_beras')->unsigned();
            $table->foreign('id_jenis_beras')->on('jenis_beras')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengadaan', function (Blueprint $table) {
            $table->dropForeign(['id_jenis_beras']);
        });
        Schema::table('pengadaan', function (Blueprint $table) {
            $table->dropColumn('id_jenis_beras');
        });
    }
}
