<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cetakppn extends Model
{
    protected $table = 'cetak_ppn';
    public $timestamps = false;
    function ppn(){
        return $this->belongsTo('App\Ppn','ppn_id','id');
    }
    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }
}
