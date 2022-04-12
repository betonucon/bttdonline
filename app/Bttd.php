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
    function users(){
        return $this->belongsTo('App\User','LIFNR','username');
    }

    function rolenya(){
        return $this->belongsTo('App\Rolenya','lokasi','id');
    }
    function username1(){
        return $this->belongsTo('App\User','app_level1','username');
    }
    function username2(){
        return $this->belongsTo('App\User','app_level2','username');
    }
    function username3(){
        return $this->belongsTo('App\User','app_level3','username');
    }
    function username4(){
        return $this->belongsTo('App\User','app_level4','username');
    }
    function username5(){
        return $this->belongsTo('App\User','app_level5','username');
    }
}
