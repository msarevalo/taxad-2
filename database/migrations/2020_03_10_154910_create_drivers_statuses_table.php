<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers_statuses', function (Blueprint $table) {
            $table->integer('id');
            $table->string('state');
            $table->timestamps();
        });

        DB::table('drivers_statuses')->insert(array('id'=>'0', 'state'=>'Inactivo'));
        DB::table('drivers_statuses')->insert(array('id'=>'1', 'state'=>'Activo'));
        DB::table('drivers_statuses')->insert(array('id'=>'2', 'state'=>'Por Aprobar'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers_statuses');
    }
}
