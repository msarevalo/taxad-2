<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIconGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icon_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('icon_groups')->insert(array('name'=>'Usuario'));
        DB::table('icon_groups')->insert(array('name'=>'Transporte'));
        DB::table('icon_groups')->insert(array('name'=>'Tiempo'));
        DB::table('icon_groups')->insert(array('name'=>'Ayuda'));
        DB::table('icon_groups')->insert(array('name'=>'Alertas'));
        DB::table('icon_groups')->insert(array('name'=>'Administrativo'));
        DB::table('icon_groups')->insert(array('name'=>'Estaditico'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icon_groups');
    }
}
