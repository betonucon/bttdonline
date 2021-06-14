<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traking extends Model
{
    protected $table = 'traking';
    public $timestamps = false;

    function user(){
        return $this->belongsTo('App\User','username','username');
    }
}
