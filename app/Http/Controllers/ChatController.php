<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Chat;
class ChatController extends Controller
{
    public function kirim_chat(request $request){
       if(Auth::user()['role_id']==7){
            $from=Auth::user()['username'];
            $to='admin';
            
            $data  = New Chat;
            $data->chat  = $request->pesan;
            $data->from  = $from;
            $data->to  = $to;
            $data->sts  = 0;
            $data->waktu  = date('Y-m-d H:i:s');
            $data->save();

            echo $from;
       }else{
            $from='admin';
            $to=$request->to;
            
            $data  = New Chat;
            $data->chat  = $request->pesan;
            $data->from  = $from;
            $data->to  = $to;
            $data->sts  = 0;
            $data->waktu  = date('Y-m-d H:i:s');
            $data->save();
            echo $to;
       }
    }
    public function lihat(request $request){
        if(Auth::user()['role_id']==7){
            $cht=Chat::where('from','admin')->where('to',$request->from)->update([
                'sts'=>1,
            ]);
        }else{
            
            $cht=Chat::where('from',$request->from)->where('to','admin')->update([
                'sts'=>1,
            ]);
        }
        echo'
            <style>
                #chatnya{
                    width: 100%;
                    display: block;
                    background: #f9f9fb;
                    padding: 1%;
                    margin-bottom: 1%;
                }
            </style>

        ';
        foreach(chat_vendor($request->from) as  $o){
            if($o['from']=='admin'){
                $warna='#e7f9c6';
            }else{
                $warna='';
            }
            
            echo'
                <div class="media-body" id="chatnya" style="background:'.$warna.'">
                    <h6 class="media-heading">'.cek_user($o['from']).'</h6>
                    
                    <p style="margin-bottom: 0px;font-weight:bold">'.$o['chat'].'</p>
                    <div class="text-muted fs-10px">'.$o['waktu'].'</div>
                   
                </div>

            ';
        }
    }
}
