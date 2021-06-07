<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bttd extends Model
{
    protected $table = 'bttd';
    public $timestamps = false;

    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }

    function rolenya(){
        return $this->belongsTo('App\Rolenya','lokasi','id');
    }
}
