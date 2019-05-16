<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pengiriman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_surat')->unsigned();
            $table->integer('id_pengirim')->unsigned();
            $table->integer('id_penerima')->unsigned();
            $table->char('metode_pembayaran', 1);
            $table->integer('berat');
            $table->integer('jumlah_biaya');
            $table->boolean('status')->default(0);
            $table->string('foto')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_surat')->references('id')->on('surat')->onDelete('cascade');
            $table->foreign('id_pengirim')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_penerima')->references('id')->on('pelanggan')->onDelete('cascade');
            
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
