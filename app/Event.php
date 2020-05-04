<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table= 'events';

    //
    protected $fillable = [
        'title', 'description', 'priority', 'owner', 'broadcast', 'date', 'state',
    ];

    //public $timestamps = false;
}