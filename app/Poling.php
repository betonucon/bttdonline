<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poling extends Model
{
    protected $table = 'poling';
    public $timestamps = false;
    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }
}
