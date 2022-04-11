<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    public $timestamps = false;
    protected $fillable = [
        'LIFNR',
        'matauang',
        'bank_key',
        'norek',
        'nmbank',
        'lastupdate',
    ];
    function vendor(){
        return $this->belongsTo('App\Vendor','LIFNR','LIFNR');
    }
}
