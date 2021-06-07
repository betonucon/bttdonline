<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spt extends Model
{
    protected $table = 'spt';
    public $timestamps = false;

    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }

}
