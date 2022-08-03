<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKalibrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalibrasis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alatukur_id')->unsigned();
            $table->date('tgl_kalibrasi');
            $table->date('tgl_nextkalibrasi');
            $table->date('tgl_sertifikat')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('alatukur_id')->references('id')->on('alatukurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kalibrasis');
    }
}
