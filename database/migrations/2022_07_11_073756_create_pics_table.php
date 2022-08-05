<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idkaryawan')->unique();
            $table->string('nama_pic');
            $table->integer('departemen_id')->unsigned();
            $table->string('foto')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('pics');
    }
}
