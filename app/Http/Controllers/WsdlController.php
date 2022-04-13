<?php

namespace App\Http\Controllers;
use App\Bank;
use App\Bttd;
use App\Vendor;
use App\Pph;
use File;
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
        $contents = file_get_contents('SAPtoWEB/ZFI094_Vendor_Bank_Detail.txt');
        $rows = explode("\n", trim($contents));
        $file=File::copy(public_path('SAPtoWEB/ZFI094_Vendor_Bank_Detail.txt'), public_path('SAPtoWEB/arsip/ZFI094_Vendor_Bank_Detail'.date('ymd').'.txt'));
        
            foreach($rows as $x=>$row) {
                if($x==0){

                }else{
                    $results= explode('|', trim($row));
                    $tanggal=date('Y-m-d',strtotime($results[5]));
                    
                    $data=Bank::updateOrCreate([
                        'LIFNR'=>ltrim($results[0],0), 
                        'matauang'=>$results[2],
                        
                    ],[
                        'LIFNR'=>ltrim($results[0],0),
                        'matauang'=>$results[2],
                        'bank_key'=>$results[1],
                        'norek'=>$results[4],
                        'nmbank'=>$results[3],
                        'lastupdate'=>$tanggal,
                    ]
                );
                   
                }
            }
        
        
        
    }

    public function parsing_vendor(){
        error_reporting(0);
        $contents = file_get_contents('SAPtoWEB/ZFI094_Vendor_General_Master.txt');
        $rows = explode("\n", trim($contents));
        $file=File::copy(public_path('SAPtoWEB/ZFI094_Vendor_General_Master.txt'), public_path('SAPtoWEB/arsip/ZFI094_Vendor_General_Master'.date('ymd').'.txt'));
        
            foreach($rows as $x=>$row) {
                $results= explode('|', trim($row));
                if($x>=8738){
                   
                    $data=Vendor::updateOrCreate([
                        'LIFNR'=>ltrim($results[0],0), 
                        
                        ],[
                            'LIFNR'=>ltrim($results[0],0),
                            'name'=>$results[1],
                        ]
                    );
                }else{
                    
                    
                    
                   
                }
            }
        
        
        
    }
    public function parsing_pph(){
        error_reporting(0);
        $contents = file_get_contents('SAPtoWEB/ZFI080_E-COUPON.txt');
        $rows = explode("\n", trim($contents));
        $file=File::copy(public_path('SAPtoWEB/ZFI080_E-COUPON.txt'), public_path('SAPtoWEB/arsip/ZFI080_E-COUPON'.date('ymd').'.txt'));
            foreach($rows as $x=>$row) {
                if($x==0){

                }else{
                    $results= explode('|', trim($row));
                    $tanggal=date('Y-m-d',strtotime($results[2]));
                    
                    $data=Pph::updateOrCreate([
                            'nodoc'     => $results[0],
                            'Docno'     => $results[1],
                            
                        ],[
                            'nodoc'     => $results[0],
                            'Docno'     => $results[1],
                            'DateDocno'    => $tanggal, 
                            'vocer' => $results[3], 
                            'HeaderText' => $results[4], 
                            'LIFNR' => ltrim($results[5],0), 
                            'Reference' => $results[7], 
                            'tgl_faktur' => $results[8], 
                            'AmountDpp' => ubah_angka($results[9]), 
                            'AmountPph' => ubah_angka($results[10]), 
                            'lastdate' => date('Y-m-d'), 
                        ]
                    );
                   
                }
            }
        
        
        
    }
    public function parsing_voucher(){
        // error_reporting(0);
        $contents = file_get_contents('public/SAPtoWEB/ZFI004N_APPVOU.txt');
        $rows = explode("\n", trim($contents));
        // $file=File::copy(public_path('SAPtoWEB/ZFI004N_APPVOU.txt'), public_path('SAPtoWEB/arsip/ZFI004N_APPVOU'.date('ymd').'.txt'));
            foreach($rows as $x=>$row) {
                $results= explode('|', trim($row));
                if($x==0){

                }else{
                    $save=Bttd::where('Reference',$results[2])->update([
                        'no_voucher'=>$results[4],
                        'sts_sap'=>1,
                        'update_sap'=>date('Y-m-d'),
                        'app_level1'=>$results[25],
                        'app_tgl_level1'=>det_time($results[25],$results[26],$results[27]),
                        'app_level2'=>$results[28],
                        'app_tgl_level2'=>det_time($results[28],$results[29],$results[30]),
                        'app_level3'=>$results[31],
                        'app_tgl_level3'=>det_time($results[31],$results[32],$results[33]),
                        'app_level4'=>$results[34],
                        'app_tgl_level4'=>det_time($results[34],$results[35],$results[36]),
                        'app_level5'=>$results[37],
                        'app_tgl_level5'=>det_time($results[37],$results[38],$results[39]),
                        
                    ]);
                    if($save){
                        echo'ok<br>';
                    }else{
                        echo'Gagal<br>';
                    }
                   
                }
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
