<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('foto')->default('/images/user-icon.png');
            $table->string('level')->default('pelanggan');
            $table->boolean('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'nama' => 'direktur',
            'email' => 'direktur@mail.com',
            'level' => 'direktur',
            'password' => '$2y$10$DEUNj6RIfF/KLYGTOrpcteSGkjMZZbnGhkC81lVKb9b8HCeK9ppAK'
        ]);

        DB::table('users')->insert([
            'nama' => 'Cabang Jakarta',
            'email' => 'cabangjakarta@mail.com',
            'level' => 'admin',
            'password' => '$2y$10$DurJBMhpVP0y47Sqx/hxiOWXFneseII6s2qaYYcVNco5YAPy6w7hq'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
