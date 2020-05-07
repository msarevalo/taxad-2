<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('route')->nullable();
            $table->integer('submenu');
            $table->integer('parent')->nullable();
            $table->string('class')->nullable();
            $table->integer('order');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('menus')->insert(array('id'=>'1', 'name'=>'Perfil', 'route'=>'/perfil', 'submenu'=>0, 'parent'=>0, 'class'=>'fa fa-address-card-o', 'order'=>-99));
        DB::table('menus')->insert(array('id'=>'2', 'name'=>'Dashboard', 'route'=>'/home', 'submenu'=>0, 'parent'=>0, 'class'=>'fa fa-tachometer', 'order'=>2));
        DB::table('menus')->insert(array('id'=>'3', 'name'=>'Administrativo', 'submenu'=>0, 'class'=>'fa fa-cogs', 'order'=>3));
        DB::table('menus')->insert(array('id'=>'4', 'name'=>'Menús', 'route'=>'/administrativo/menus', 'submenu'=>1, 'parent'=>3, 'order'=>4));
        DB::table('menus')->insert(array('id'=>'5', 'name'=>'Separadores', 'route'=>'/administrativo/separadores', 'submenu'=>1, 'parent'=>3, 'order'=>5));
        DB::table('menus')->insert(array('id'=>'6', 'name'=>'Permisos', 'route'=>'/administrativo/permisos', 'submenu'=>1, 'parent'=>3, 'order'=>6));
        DB::table('menus')->insert(array('id'=>'7', 'name'=>'Perfiles', 'route'=>'/administrativo/perfiles', 'submenu'=>1, 'parent'=>3, 'order'=>7));
        DB::table('menus')->insert(array('id'=>'23', 'name'=>'Legales', 'route'=>'/administrativo/legales', 'submenu'=>1, 'parent'=>3, 'order'=>8));
        DB::table('menus')->insert(array('id'=>'8', 'name'=>'Usuarios', 'submenu'=>0, 'class'=>'fa fa-users', 'order'=>8));
        DB::table('menus')->insert(array('id'=>'9', 'name'=>'Administradores', 'route'=>'/administradores', 'submenu'=>1, 'parent'=>8, 'order'=>9));
        DB::table('menus')->insert(array('id'=>'10', 'name'=>'Conductores', 'route'=>'/conductores', 'submenu'=>1, 'parent'=>8, 'order'=>10));
        DB::table('menus')->insert(array('id'=>'11', 'name'=>'Socios', 'route'=>'/socios', 'submenu'=>1, 'parent'=>8, 'order'=>11));
        DB::table('menus')->insert(array('id'=>'12', 'name'=>'Taxis', 'submenu'=>0, 'class'=>'fa fa-taxi', 'order'=>12));
        DB::table('menus')->insert(array('id'=>'13', 'name'=>'Tarifas', 'route'=>'/tarifa', 'submenu'=>1, 'parent'=>12, 'order'=>13));
        DB::table('menus')->insert(array('id'=>'14', 'name'=>'Categoria Gastos', 'route'=>'/categoria', 'submenu'=>1, 'parent'=>12, 'order'=>14));
        DB::table('menus')->insert(array('id'=>'15', 'name'=>'Descripcion Gastos', 'route'=>'/descripcion', 'submenu'=>1, 'parent'=>12, 'order'=>15));
        DB::table('menus')->insert(array('id'=>'16', 'name'=>'Marcas', 'route'=>'/marcas', 'submenu'=>1, 'parent'=>12, 'order'=>16));
        DB::table('menus')->insert(array('id'=>'22', 'name'=>'Servicios', 'route'=>'/servicios', 'submenu'=>1, 'parent'=>12, 'order'=>16));
        DB::table('menus')->insert(array('id'=>'17', 'name'=>'Vehiculos', 'route'=>'/taxis', 'submenu'=>1, 'parent'=>12, 'order'=>17));
        DB::table('menus')->insert(array('id'=>'18', 'name'=>'Calendario', 'route'=>'/calendario', 'submenu'=>0, 'parent'=>0, 'class'=>'fa fa-calendar', 'order'=>18));
        DB::table('menus')->insert(array('id'=>'19', 'name'=>'Notificaciones', 'route'=>'/buzon', 'submenu'=>0, 'parent'=>0, 'class'=>'fa fa-envelope', 'order'=>19));
        DB::table('menus')->insert(array('id'=>'20', 'name'=>'Reportes', 'route'=>'/reportes', 'submenu'=>0, 'parent'=>0, 'class'=>'fa fa-bar-chart', 'order'=>13));
        DB::table('menus')->insert(array('id'=>'21', 'name'=>'Cerrar Sesión', 'route'=>'logout', 'submenu'=>0, 'parent'=>0, 'class'=>'fa fa-sign-out', 'order'=>99));



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
