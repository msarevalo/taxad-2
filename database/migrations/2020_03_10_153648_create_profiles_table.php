<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profile_name');
            $table->integer('state')->default(1);
            $table->timestamps();
        });

        DB::table('profiles')->insert(array('profile_name'=>'Superadmin'));
        DB::table('profiles')->insert(array('profile_name'=>'Admin'));
        DB::table('profiles')->insert(array('profile_name'=>'Conductor'));
        DB::table('profiles')->insert(array('profile_name'=>'Socio'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
