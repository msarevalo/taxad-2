<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('class');
            $table->integer('group');
            $table->timestamps();
        });

        DB::table('icons')->insert(array('name'=>'Usuario - Libro Direcciones - Fondo', 'class'=>'fa fa-address-book', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Usuario - Libro Direcciones', 'class'=>'fa fa-address-book-o', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Usuario - Tarjeta Direcciones - Fondo', 'class'=>'fa fa-address-card', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Usuario - Tarjeta Direcciones', 'class'=>'fa fa-address-card-o', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Estadistico - Grafica Area', 'class'=>'fa fa-area-chart', 'group'=>7));
        DB::table('icons')->insert(array('name'=>'Transporte - Vehiculo', 'class'=>'fa fa-car', 'group'=>2));
        DB::table('icons')->insert(array('name'=>'Estadistico - Grafica de Barras', 'class'=>'fa fa-bar-chart', 'group'=>7));
        DB::table('icons')->insert(array('name'=>'Alertas - Campana Fondo', 'class'=>'fa fa-bell', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Campana', 'class'=>'fa fa-bell-o', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Campana Slash Fondo', 'class'=>'fa fa-bell-slash', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Campana Slash Fondo', 'class'=>'fa fa-bell-slash-o', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Megafono', 'class'=>'fa fa-bullhorn', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Transporte - Bus', 'class'=>'fa fa-bus', 'group'=>2));
        DB::table('icons')->insert(array('name'=>'Tiempo - Calendario Cuadriculado', 'class'=>'fa fa-calendar', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Tiempo - Calendario Check', 'class'=>'fa fa-calendar-check-o', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Tiempo - Calendario Menos', 'class'=>'fa fa-calendar-minus-o', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Tiempo - Calendario Blanco', 'class'=>'fa fa-calendar-o', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Tiempo - Calendario Mas', 'class'=>'fa fa-calendar-plus-o', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Tiempo - Calendario Negar', 'class'=>'fa fa-calendar-times-o', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Administrativo - Piñon', 'class'=>'fa fa-cog', 'group'=>6));
        DB::table('icons')->insert(array('name'=>'Administrativo - Piñones', 'class'=>'fa fa-cogs', 'group'=>6));
        DB::table('icons')->insert(array('name'=>'Alertas - Burbuja Dialogo Fondo', 'class'=>'fa fa-comment', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Burbuja Dialogo', 'class'=>'fa fa-comment-o', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Burbuja Dialogo Puntos Fondo', 'class'=>'fa fa-commenting', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Burbuja Dialogo Puntos', 'class'=>'fa fa-commenting-o', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Burbujas Dialogo Fondo', 'class'=>'fa fa-comments', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Burbujas Dialogo', 'class'=>'fa fa-comments-o', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Estadistico - Tacometro', 'class'=>'fa fa-tachometer', 'group'=>7));
        DB::table('icons')->insert(array('name'=>'Estadistico - Pantalla', 'class'=>'fa fa-desktop', 'group'=>7));
        DB::table('icons')->insert(array('name'=>'Usuario - Licencia de Conducir Fondo', 'class'=>'fa fa-id-card', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Usuario - Licencia de Conducir', 'class'=>'fa fa-id-card-o', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Alertas - Sobre Fondo', 'class'=>'fa fa-envelope', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Sobre', 'class'=>'fa fa-envelope-o', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Sobre Abierto Fondo', 'class'=>'fa fa-envelope-open', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Sobre Abierto', 'class'=>'fa fa-envelope-open-o', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Sobre Cuadro', 'class'=>'fa fa-envelope-square', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Admiracion', 'class'=>'fa fa-exclamation', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Alertas - Admiracion Circulo', 'class'=>'fa fa-exclamation-circle', 'group'=>5));
        DB::table('icons')->insert(array('name'=>'Usuario - group de Usuarios', 'class'=>'fa fa-users', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Tiempo - Reloj Arena Lleno', 'class'=>'fa fa-hourglass', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Tiempo - Reloj Arena Medio', 'class'=>'fa fa-hourglass-start', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Tiempo - Reloj Arena Cuartos', 'class'=>'fa fa-hourglass-half', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Tiempo - Reloj Arena Fin', 'class'=>'fa fa-hourglass-end', 'group'=>3));
        DB::table('icons')->insert(array('name'=>'Usuario - Insignia Usuario', 'class'=>'fa fa-id-badge', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Ayuda - Info', 'class'=>'fa fa-info', 'group'=>4));
        DB::table('icons')->insert(array('name'=>'Ayuda - Info Circulo', 'class'=>'fa fa-info-circle', 'group'=>4));
        DB::table('icons')->insert(array('name'=>'Ayuda - Foco', 'class'=>'fa fa-lightbulb-o', 'group'=>4));
        DB::table('icons')->insert(array('name'=>'Estadistico - Grafica de Linea', 'class'=>'fa fa-line-chart', 'group'=>7));
        DB::table('icons')->insert(array('name'=>'Estadistico - Diagrama de Torta', 'class'=>'fa fa-pie-chart', 'group'=>7));
        DB::table('icons')->insert(array('name'=>'Administrativo - Rompecabeza', 'class'=>'fa fa-puzzle-piece', 'group'=>6));
        DB::table('icons')->insert(array('name'=>'Ayuda - Pregunta', 'class'=>'fa fa-question', 'group'=>4));
        DB::table('icons')->insert(array('name'=>'Ayuda - Pregunta Criculo Fondo', 'class'=>'fa fa-question-circle', 'group'=>4));
        DB::table('icons')->insert(array('name'=>'Ayuda - Pregunta Criculo', 'class'=>'fa fa-question-circle-o', 'group'=>4));
        DB::table('icons')->insert(array('name'=>'Administrativo - Slider', 'class'=>'fa fa-sliders', 'group'=>6));
        DB::table('icons')->insert(array('name'=>'Transporte - Taxi', 'class'=>'fa fa-taxi', 'group'=>2));
        DB::table('icons')->insert(array('name'=>'Transporte - Camion', 'class'=>'fa fa-truck', 'group'=>2));
        DB::table('icons')->insert(array('name'=>'Usuario - Usuario Fondo', 'class'=>'fa fa-user', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Usuario - Usuario Circulo Fondo', 'class'=>'fa fa-user-circle', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Usuario - Usuario Circulo', 'class'=>'fa fa-user-circle-o', 'group'=>1));
        DB::table('icons')->insert(array('name'=>'Usuario - Usuario', 'class'=>'fa fa-user-o', 'group'=>1));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icons');
    }
}
