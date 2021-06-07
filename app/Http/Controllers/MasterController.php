<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tagihan;
use App\Spt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class MasterController  extends Controller
{
    public function index(request $request){
        $menu='Jenis Tagihan';
        $menu_detail=name();
        $data=Tagihan::orderBy('name','Asc')->paginate(20);
        return view('tagihan.index',compact('menu','menu_detail','data'));
       
    }
    public function index_spt(request $request){
        $menu='SPT Vendor';
        $menu_detail=name();
        $data=Spt::with(['vendor'])->orderBy('LIFNR','Asc')->paginate(20);
        return view('spt.index',compact('menu','menu_detail','data'));
       
    }
    
    

    public function ubah(request $request){
        $data = Tagihan::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Nama </label>
                    <input type="text" name="name" class="form-control" value="'.$data['name'].'">
                </div>
                
                
                
            </div>
            
        ';
    }
    public function ubah_spt(request $request){
        $data = Spt::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Link SPT </label>
                    <input type="text" name="link" class="form-control" value="'.$data['link'].'">
                </div>
                
                
                
            </div>
            
        ';
    }

    

    public function view_data(request $request){
        $cek=strlen($request->name);
        if($cek>0){
            $data = Pengguna::where('nik','LIKE','%'.$request->name.'%')->orWhere('name','LIKE','%'.$request->name.'%')->get();
        }else{
            $data = Pengguna::orderBy('name','Asc')->get();
        }
        echo'
        <style>
            p{
                margin:0px !important;
            }
            th{
              background:#82efef;  
            }
        </style>
        <table id="data-table-fixed-header" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="3%">NO</th>
                    <th width="3%" ></th>
                    <th width="10%" >Username</th>
                    <th>Name</th>
                    <th width="20%" >Email </th>
                    <th width="20%" >Role</th>
                    <th width="4%" ></th>
                </tr>
            </thead>
            <tbody>';
            foreach($data as $no=>$o){

                echo'
                <tr class="odd gradeX">
                    <td class="ttd">'.($no+1).'</td>
                    <td class="ttd"><input type="checkbox" name="id[]" value="'.$o['id'].'"></td>
                    <td class="ttd">'.$o['nik'].'</td>
                    <td class="ttd">'.$o['no_bpjs'].'</td>
                    <td class="ttd">'.$o['name'].'</td>
                    <td class="ttd">'.$o['alamat'].'</td>
                    <td class="ttd">'.$o['tempat_lahir'].', '.$o['tanggal_lahir'].'</td>
                    <td class="ttd">
                        <span class="btn btn-xs btn-success" onclick="ubah('.$o['id'].')"><i class="fa fa-edit"></i></span>
                    </td>
                </tr>';
            }
        echo'
            
            </tbody>
        </table>
        
        ';
    }
    
    public function cari_nik(request $request){
        $cek=User::where('username',$request->username)->count();
        if($cek>0){
            $data=User::where('username',$request->username)->first();
            echo'ok@'.$data['username'].'@'.$data['name'];
        }else{
            echo'nol';
        }
        

    }
    public function simpan(request $request){
        if (trim($request->name) == '') {$error[] = '- Masukan Nama Tagihan';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data           = New Tagihan;
                $data->name   = $request->name;
                $data->save();
                if($data){
                    echo'ok';
                }
                 
            
        }
    }
    public function simpan_spt(request $request){
        if (trim($request->LIFNR) == '') {$error[] = '- Masukan Nama Vendor';}
        if (trim($request->link) == '') {$error[] = '- Masukan Link SPT';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data           = New Spt;
                $data->link   = $request->link;
                $data->LIFNR   = $request->LIFNR;
                $data->save();
                if($data){
                    echo'ok';
                }
                 
            
        }
    }
    public function simpan_ubah_spt(request $request){
        if (trim($request->link) == '') {$error[] = '- Masukan Link SPT';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data           = Spt::find($request->id);
                $data->link   = $request->link;
                $data->save();
                if($data){
                    echo'ok';
                }
                 
            
        }
    }
    

    public function simpan_ubah(request $request){
        if (trim($request->name) == '') {$error[] = '- Masukan Nama Tagihan';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
            
                $data           = Tagihan::find($request->id);
                $data->name   = $request->name;
                $data->save();
                if($data){
                   echo'ok';
                }
                 
            
        }
    }

    

    public function hapus(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            
            for($x=0;$x<$jum;$x++){
                $cek=Tagihan::where('id',$_POST['id'][$x])->delete();
                
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan dihapus</p>';
        }

    }
    public function hapus_spt(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            
            for($x=0;$x<$jum;$x++){
                $cek=Spt::where('id',$_POST['id'][$x])->delete();
                
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan dihapus</p>';
        }

    }

    
}
