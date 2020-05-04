<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->integer('state')->default('1');
            $table->timestamps();
        });

        DB::table('expense_categories')->insert(array('category'=>'Reparacion Motor'));
        DB::table('expense_categories')->insert(array('category'=>'Electrico'));
        DB::table('expense_categories')->insert(array('category'=>'Seguros'));
        DB::table('expense_categories')->insert(array('category'=>'Suspension'));
        DB::table('expense_categories')->insert(array('category'=>'GPS'));
        DB::table('expense_categories')->insert(array('category'=>'Llantas'));
        DB::table('expense_categories')->insert(array('category'=>'Clutch'));
        DB::table('expense_categories')->insert(array('category'=>'Aceite'));
        DB::table('expense_categories')->insert(array('category'=>'Motor'));
        DB::table('expense_categories')->insert(array('category'=>'Frenos'));
        DB::table('expense_categories')->insert(array('category'=>'Caja'));
        DB::table('expense_categories')->insert(array('category'=>'Rodamiento'));
        DB::table('expense_categories')->insert(array('category'=>'Gas'));
        DB::table('expense_categories')->insert(array('category'=>'SOAT'));
        DB::table('expense_categories')->insert(array('category'=>'Miscelaneo'));
        DB::table('expense_categories')->insert(array('category'=>'Revision Tecnomecanica'));
        DB::table('expense_categories')->insert(array('category'=>'Puerta'));
        DB::table('expense_categories')->insert(array('category'=>'Traspaso'));
        DB::table('expense_categories')->insert(array('category'=>'Administracion'));
        DB::table('expense_categories')->insert(array('category'=>'Patios'));
        DB::table('expense_categories')->insert(array('category'=>'Direccion Hidraulica'));
        DB::table('expense_categories')->insert(array('category'=>'Gasolina'));
        DB::table('expense_categories')->insert(array('category'=>'Impuestos'));
        DB::table('expense_categories')->insert(array('category'=>'Transmision'));
        DB::table('expense_categories')->insert(array('category'=>'Radiador'));
        DB::table('expense_categories')->insert(array('category'=>'Exhosto'));
        DB::table('expense_categories')->insert(array('category'=>'Seguridad Social'));
        DB::table('expense_categories')->insert(array('category'=>'Alineacion'));
        DB::table('expense_categories')->insert(array('category'=>'Revision Preventiva'));
        DB::table('expense_categories')->insert(array('category'=>'Taximetro'));
        DB::table('expense_categories')->insert(array('category'=>'Radio'));
        DB::table('expense_categories')->insert(array('category'=>'Otro'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_categories');
    }
}
