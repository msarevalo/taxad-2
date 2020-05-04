<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //

    public static function leido($id,$data){
      DB::table('notifications')->where('id', $id)->update($data);
   }

}
