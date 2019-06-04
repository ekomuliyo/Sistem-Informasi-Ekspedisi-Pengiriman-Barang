<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ongkir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ongkir', function(Blueprint $table){
            $table->increments('id');
            $table->string('asal');
            $table->integer('id_kecamatan')->unsigned();
            $table->string('estimasi');
            $table->integer('harga');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_kecamatan')->references('id')->on('kecamatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
