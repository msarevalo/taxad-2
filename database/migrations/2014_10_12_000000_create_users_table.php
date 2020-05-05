<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

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
            $table->string('username')->unique();
            $table->bigInteger('document')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('state')->default('2');
            $table->integer('profile')->default('3');
            $table->integer('new')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });

        $contraseña = Hash::make('ninguna123.');
        DB::table('users')->insert(array('username'=>'admin', 'document'=>'123', 'name'=>'admin', 'lastname'=>'', 'email'=>'admin@taxad.com', 'password'=>$contraseña, 'state'=>'1', 'profile'=>'1', 'new'=>'0'));
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
