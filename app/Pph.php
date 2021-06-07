<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pph extends Model
{
    protected $table = 'pph';
    public $timestamps = false;
    protected $fillable = ['HeaderText','Reference','LIFNR','Docno','AmountDpp','AmountPph','DateDocno','sts'];
    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }
    function cetak(){
        return $this->belongsTo('App\Cetakpph','id','pph_id');
    }
}
