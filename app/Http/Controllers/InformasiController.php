<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendor;
use App\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class InformasiController extends Controller
{
    public function index(request $request){
        $menu='Daftar Pengumuman';
        $menu_detail=name();
        $data=Pengumuman::orderBy('id','Desc')->paginate(20);
        return view('pengumuman.index',compact('menu','menu_detail','data'));
       
    }
    

    public function ubah(request $request){
        $data = Pengumuman::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <div class="col-md-6">
                <fieldset>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Informasi </label>
                        <textarea name="name" class="form-control" rows="5" placeholder="Ketik disini">'.$data['name'].'</textarea>
                    </div>
                    
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Start Date </label>
                        <input type="text" id="mulai2" name="start_dt" value="'.$data['start_dt'].'" class="form-control" placeholder="Ketik disini" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">End Date </label>
                        <input type="text" id="sampai2" name="end_dt" value="'.$data['end_dt'].'" class="form-control" placeholder="Ketik disini" />
                    </div>
                    
                </fieldset>
            </div>
        ';
        echo'
            <script>
                $("#mulai2").datepicker({
                    format: "yyyy-mm-dd"
                });
                $("#sampai2").datepicker({
                    format: "yyyy-mm-dd"
                });
            </script>
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
        if (trim($request->name) == '') {$error[] = '- Masukan Informasi Pengumuman';}
        if (trim($request->start_dt) == '') {$error[] = '- Masukan Start Date';}
        if (trim($request->end_dt) == '') {$error[] = '- Masukan End Date';}
        if (trim($request->file) == '') {$error[] = '- Masukan file pengumuman';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $patr='/\s+/';
            $cek=explode('/',$_FILES['file']['type']);
            $file_tmp=$_FILES['file']['tmp_name'];
            $file=explode('.',$_FILES['file']['name']);
            $filename=preg_replace($patr,'_',$request->name).'.'.$cek[1];
            $lokasi='_file_pengumuman/';
            
            if($cek[1]=='pdf'){
                if(move_uploaded_file($file_tmp, $lokasi.$filename)){
                    $data           = New Pengumuman;
                    $data->name   = $request->name;
                    $data->start_dt   = $request->start_dt;
                    $data->end_dt   = $request->end_dt;
                    $data->file   = $filename;
                    $data->ipeng_dt   = date('Y-m-d H:i:s');
                    $data->save();
                    
                    echo'ok';
                }else{
                    echo'gagal upload';
                }
            }else{
                echo'Format file harus PDF';
            }     
            
        }
    }
    

    public function simpan_ubah(request $request){
        if (trim($request->name) == '') {$error[] = '- Masukan Informasi Pengumuman';}
        if (trim($request->start_dt) == '') {$error[] = '- Masukan Start Date';}
        if (trim($request->end_dt) == '') {$error[] = '- Masukan End Date';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            if($request->file==''){
                $data           = Pengumuman::find($request->id);
                $data->name   = $request->name;
                $data->start_dt   = $request->start_dt;
                $data->end_dt   = $request->end_dt;
                $data->ipeng_dt   = date('Y-m-d H:i:s');
                $data->save();
                if($data){
                   echo'ok';
                }
            }else{

                $patr='/\s+/';
                $cek=explode('/',$_FILES['file']['type']);
                $file_tmp=$_FILES['file']['tmp_name'];
                $file=explode('.',$_FILES['file']['name']);
                $filename=preg_replace($patr,'_',$request->name).'.'.$cek[1];
                $lokasi='_file_pengumuman/';
                
                if($cek[1]=='pdf'){
                    if(move_uploaded_file($file_tmp, $lokasi.$filename)){
                        $data           = Pengumuman::find($request->id);
                        $data->name   = $request->name;
                        $data->start_dt   = $request->start_dt;
                        $data->end_dt   = $request->end_dt;
                        $data->ipeng_dt   = date('Y-m-d H:i:s');
                        $data->file   = $filename;
                        $data->save();
                        if($data){
                            echo'ok';
                        }
                    }else{
                        echo'gagal upload';
                    }
                }else{
                    echo'Format file harus PDF';
                }     
            }
            
                
                 
            
        }
    }

    

    public function hapus(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            
            for($x=0;$x<$jum;$x++){
                $cek=Pengumuman::where('id',$_POST['id'][$x])->delete();
                
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan dihapus</p>';
        }

    }

    
}
