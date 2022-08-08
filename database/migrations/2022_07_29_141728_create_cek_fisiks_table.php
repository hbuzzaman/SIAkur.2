<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCekFisiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cek_fisiks', function (Blueprint $table) {
            $table->id();
            $table->integer('alatukur_id')->unsigned();
            $table->integer('check1')->nullable();
            $table->integer('check2')->nullable();
            $table->integer('check3')->nullable();
            $table->integer('check4')->nullable();
            $table->integer('check5')->nullable();
            $table->string('judge');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('cek_fisiks');
    }
}
