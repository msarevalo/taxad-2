<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('text');
            $table->timestamps();
        });

        DB::table('terms')->insert(array('text'=>'El nombre de usuario y la contraseña que se asignen a cada uno de estos con el fin de acceder a esta herramienta, son de carácter confidencial y personal. Cada novedad relacionada con los usuarios debe ser notificadas oportunamente por el conductor a INVERSIONES ANYGUEY SAS a fin de realizar los cambios correspondiente. La utilización del nombre y contraseña es responsabilidad del usuario y se encuentra restringido exclusivamente al usuario a quien este nombre y contraseña son asignados. El usuario debe seguir las instrucciones impartidas por INVERSIONES ANYGUEY SAS las cuales serán remitidas vía correo electrónico o bien podrán estar estipuladas directamente en esta herramienta. El Usuario se compromete a mantenerse informado con respecto a estas instrucciones y a cumplirlas. No está permitido compartir y manipular información que no sea para efectos de control y seguimiento a las actividades derivadas en la herramienta.'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
}
