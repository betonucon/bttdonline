<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spt extends Model
{
    protected $table = 'spt';
    public $timestamps = false;
    protected $fillable = ['LIFNR','link','tanggal'];
    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }

}
