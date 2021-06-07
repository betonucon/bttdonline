<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cetakpph extends Model
{
    protected $table = 'cetak_pph';
    public $timestamps = false;
    function pph(){
        return $this->belongsTo('App\Pph','pph_id','id');
    }
    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }
}
