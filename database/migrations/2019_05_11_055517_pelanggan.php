<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function(Blueprint $table){
            $table->increments('id');
            $table->string('no_hp')->default('-');
            $table->char('jenis_kelamin', 1)->default(1);
            $table->date('tgl_lahir')->nullable();
            $table->integer('id_kecamatan')->unsigned()->nullable();
            $table->string('alamat')->default('-');
            $table->integer('id_user')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
