<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_peminjam');
            $table->integer('alatukur_id')->unsigned();
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->integer('departemen_id')->unsigned();
            $table->timestamps();

            $table->foreign('alatukur_id')->references('id')->on('alatukurs')->onDelete('cascade');
            $table->foreign('departemen_id')->references('id')->on('departemens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjams');
    }
}
