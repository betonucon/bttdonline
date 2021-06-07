<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ppn extends Model
{
    protected $table = 'ppn';
    public $timestamps = false;
    protected $fillable = ['HeaderText','Reference','LIFNR','Docno','AmountDpp','AmountPph','DateDocno','sts'];
    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }
    function cetak(){
        return $this->belongsTo('App\Cetakppn','id','ppn_id');
    }
}
