<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('day');
            $table->integer('rates');
            $table->timestamps();
        });

        DB::table('rates')->insert(array('day'=>'Lunes', 'rates'=>'0'));
        DB::table('rates')->insert(array('day'=>'Martes', 'rates'=>'0'));
        DB::table('rates')->insert(array('day'=>'Miercoles', 'rates'=>'0'));
        DB::table('rates')->insert(array('day'=>'Jueves', 'rates'=>'0'));
        DB::table('rates')->insert(array('day'=>'Viernes', 'rates'=>'0'));
        DB::table('rates')->insert(array('day'=>'Sabado', 'rates'=>'0'));
        DB::table('rates')->insert(array('day'=>'Domingo','rates'=>'0'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
