<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlatukursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alatukurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_alat');
            $table->string('no_seri');
            $table->string('no_reg');
            $table->string('range');
            $table->string('resolusi');
            $table->integer('maker_id')->unsigned();
            $table->date('tgl_plan');
            $table->date('tgl_actual');
            $table->integer('departemen_id')->unsigned();
            $table->integer('lokasi_alatukur_id')->unsigned();
            $table->string('frekuensi');
            $table->string('gambar')->default(null);
            $table->string('kondisi');
            $table->string('status');
            $table->integer('pic_id')->unsigned();
            $table->timestamps();

            $table->foreign('maker_id')->references('id')->on('makers')->onDelete('cascade');
            $table->foreign('departemen_id')->references('id')->on('departemens')->onDelete('cascade');
            $table->foreign('lokasi_alatukur_id')->references('id')->on('lokasi_alatukurs')->onDelete('cascade');
            $table->foreign('pic_id')->references('id')->on('pics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alatukurs');
    }
}
