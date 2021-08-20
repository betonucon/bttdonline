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

    public function parsing_txt(){
        error_reporting(0);
        $contents = file_get_contents('SAPtoWEB/test.txt');
        $rows = explode("\n", trim($contents));
        foreach($rows as $x=>$row) {
            if($x==0){

            }else{
                $results= explode('|', trim($row));
                echo $results[0].'-'.$results[1].'-'.$results[2].'-'.$results[3].'<br>';
                
            }
        }
        
        
    }

    
}
