<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('profile');
            $table->integer('menu');
            $table->integer('read')->default(0);
            $table->integer('create')->default(0);
            $table->integer('edit')->default(0);
            $table->integer('delete')->default(0);
            $table->timestamps();
        });

        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>1, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>2, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>3, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>4, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>5, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>6, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>7, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>8, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>9, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>11, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>10, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>12, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>13, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>14, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>15, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>16, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>17, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>18, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>19, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>20, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>21, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>22, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));
        DB::table('permissions')->insert(array('profile'=>'1', 'menu'=>23, 'read'=>1, 'create'=>1, 'edit'=>1, 'delete'=>'1'));


    }

    /**
     * Rereadse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
