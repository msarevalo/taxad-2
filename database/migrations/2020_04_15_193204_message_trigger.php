<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MessageTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared('
        CREATE TRIGGER tr_message_notification AFTER INSERT ON `message` FOR EACH ROW
            BEGIN
                INSERT INTO notifications (`sending_user`, `message`,`created_at`, `updated_at`) 
                VALUES (NEW.user, NEW.id, NEW.date,null);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::unprepared('DROP TRIGGER `tr_message_notification`');
    }
}
