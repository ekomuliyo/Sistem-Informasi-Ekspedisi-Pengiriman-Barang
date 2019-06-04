<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Koli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koli', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_pengiriman')->unsigned();
            $table->string('deskripsi');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_pengiriman')->references('id')->on('pengiriman')->onDelete('cascade');
            
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
