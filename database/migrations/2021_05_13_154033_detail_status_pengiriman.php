<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailStatusPengiriman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_status_pengiriman', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_status_pengiriman')->unsigned();
            $table->string('keterangan');
            $table->integer('id_user')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_status_pengiriman')->references('id')->on('status_pengiriman')->onDelete('cascade'); 
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
