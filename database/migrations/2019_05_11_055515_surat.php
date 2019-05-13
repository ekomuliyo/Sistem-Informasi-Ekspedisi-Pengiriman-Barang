<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Surat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function(Blueprint $table){
            $table->increments('id');
            $table->string('nomor_surat');
            $table->integer('id_kurir')->unsigned();
            $table->date('tgl_surat');
            $table->string('keterangan')->default('sedang dalam perjalanan');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_kurir')->references('id')->on('kurir')->onDelete('cascade');
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
