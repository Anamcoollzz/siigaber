<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdTeratasPadaSppk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sppk', function (Blueprint $table) {
            $table->integer('id_teratas')->unsigned()->nullable();
            $table->foreign('id_teratas')->references('id')->on('sppk_daerah_tujuan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sppk', function (Blueprint $table) {
            $table->dropForeign(['id_teratas']);
        });
        Schema::table('sppk', function (Blueprint $table) {
            $table->dropColumn('id_teratas');
        });
    }
}
