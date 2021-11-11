<?php

namespace App\Http\Controllers;
use App\Bank;
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

    public function parsing_bank(){
        error_reporting(0);
        $contents = file_get_contents('SAPtoWEB/TESTING VENDOR MASTER.txt');
        $rows = explode("\n", trim($contents));
        // dd($rows);
        $delete=Bank::truncate();
        if($delete){
            foreach($rows as $x=>$row) {
                if($x==0){

                }else{
                    $results= explode('|', trim($row));
                    // echo ltrim($results[0],0).'-'.$results[1].'-'.$results[2].'-'.$results[3].'-'.$results[4].'-'.$results[5].'-'.$results[14].'-'.$results[16].'<br>';
                    $data           = New Bank;
                    $data->LIFNR    = ltrim($results[0],0);
                    $data->nmbank   = $results[3];
                    $data->norek   = $results[4];
                    $data->matauang   = $results[2];
                    $data->pemilik   = $results[6];
                    $data->kota   = $results[11].' '.$results[12];
                    $data->save();
                }
            }
        }else{
            echo'error';
        }
        
    }
    public function parsing_txt_ZFI004N(){
        error_reporting(0);
        $contents = file_get_contents('SAPtoWEB/TESTING ZFI004N.txt');
        $rows = explode("\n", trim($contents));
        // dd($rows);
        
            foreach($rows as $x=>$row) {
                if($x==0){

                }else{
                    // $results= explode('|', trim($row));
                    echo ltrim($results[0],0).'-'.$results[1].'-'.$results[2].'-'.$results[3].'-'.$results[4].'-'.$results[5].'-'.$results[14].'-'.$results[16].'<br>';
                    // $data           = New Bank;
                    // $data->LIFNR    = ltrim($results[0],0);
                    // $data->nmbank   = $results[3];
                    // $data->norek   = $results[4];
                    // $data->matauang   = $results[2];
                    // $data->pemilik   = $results[6];
                    // $data->kota   = $results[11].' '.$results[12];
                    // $data->save();
                }
            }
        
        
    }

    
}
