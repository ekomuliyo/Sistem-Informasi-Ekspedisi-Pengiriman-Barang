<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusPengiriman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pengiriman', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_pengiriman')->unsigned();
            $table->boolean('status')->default(0);
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
