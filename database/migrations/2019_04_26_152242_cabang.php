<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cabang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alamat');
            $table->string('no_hp');
            $table->rememberToken();
            $table->integer('id_user')->unsigned();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });

        DB::table('cabang')->insert([
            'alamat' => 'Jl. Kebon Kacang I No.27 (Samping Metro Tanah Abang)',
            'no_hp' => '081288482941',
            'id_user' => 2
        ]);

        DB::table('cabang')->insert([
            'alamat' => 'Jl. Pandawa Nomor 53B RT.17 RW.04 Lemabang Palembang',
            'no_hp' => '082114353116',
            'id_user' => 3
        ]);

        DB::table('cabang')->insert([
            'alamat' => 'Jl. Garuda ujung depan SMP 37',
            'no_hp' => '081275572008',
            'id_user' => 4
        ]);

        DB::table('cabang')->insert([
            'alamat' => 'Jl. Parak Kubang Belakang Pasar Aur Kuning No.40 ',
            'no_hp' => '081294999742',
            'id_user' => 5
        ]);
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
