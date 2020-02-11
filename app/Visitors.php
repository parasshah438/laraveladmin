<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    Protected  $table = "visitors";


    protected $fillable = [
        'username'
    ];
}

