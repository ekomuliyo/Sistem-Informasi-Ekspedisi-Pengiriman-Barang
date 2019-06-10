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
            $table->string('no_resi');
            $table->string('nama_pengirim');
            $table->string('no_hp_pengirim');
            $table->integer('id_kecamatan_pengirim')->unsigned();
            $table->string('alamat_pengirim');
            $table->string('nama_penerima');
            $table->string('no_hp_penerima');
            $table->integer('id_kecamatan_penerima')->unsigned();
            $table->string('alamat_penerima');
            $table->char('metode_pembayaran', 1);
            $table->float('berat');
            $table->integer('jumlah_biaya');
            $table->integer('jumlah_bayar')->nullable();
            $table->boolean('status_valid')->default(0);
            $table->boolean('status_surat')->default(0);
            $table->boolean('status_bayar')->default(1);
            $table->string('foto')->nullable();
            $table->integer('id_user')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_kecamatan_pengirim')->references('id')->on('kecamatan')->onDelete('cascade');                                       
            $table->foreign('id_kecamatan_penerima')->references('id')->on('kecamatan')->onDelete('cascade'); 
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
