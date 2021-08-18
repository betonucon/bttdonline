<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BukpotController;
class WsdlController extends Controller
{
    public function SI_REPORT_PPN()
    {
        $url = asset('XML/SI_REPORT_PPN.wsdl');
        $server = new \SoapServer($url);
        $server->setClass( BukpotController::class);
        $server->handle();
    }

    
}
