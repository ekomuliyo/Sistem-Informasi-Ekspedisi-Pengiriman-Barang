<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kurir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurir', function(Blueprint $table){
            $table->increments('id');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('nama_kendaraan');
            $table->string('nomor_polisi');
            $table->integer('id_user')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
