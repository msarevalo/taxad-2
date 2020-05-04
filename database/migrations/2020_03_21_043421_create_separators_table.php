<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeparatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('separators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('subsequent_menu');
            $table->integer('state')->default(1);
            $table->timestamps();
        });

        DB::table('separators')->insert(array('id'=>'1', 'name'=>'TAXAD | Taxi Administrator', 'subsequent_menu'=>1));
        DB::table('separators')->insert(array('id'=>'2', 'name'=>'ADMINISTRACION', 'subsequent_menu'=>2));
        DB::table('separators')->insert(array('id'=>'3', 'name'=>'OPCIONES', 'subsequent_menu'=>18));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('separators');
    }
}
