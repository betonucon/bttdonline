<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendor;
use App\Bank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PenggunaController extends Controller
{
    public function index(request $request){
        $menu='Pengguna Internal';
        $menu_detail=name();
        $data=User::with(['role'])->where('role_id','!=',7)->orderBy('name','Asc')->paginate(20);
        return view('pengguna.index',compact('menu','menu_detail','data'));
       
    }
    
    

    public function ubah(request $request){
        $data = User::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <input type="hidden" name="username" value="'.$data['nik'].'">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" disabled class="form-control" value="'.$data['username'].'">
                </div>
                <div class="form-group">
                    <label>Nama </label>
                    <input type="text" name="name" class="form-control" value="'.$data['name'].'">
                </div>
                <div class="form-group">
                    <label>Nama Panggilan (Max 10 Karakter)</label>
                    <input type="text" name="initial" class="form-control" value="'.$data['initial'].'">
                </div>
                
                
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="'.$data['email'].'">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Role Akses </label>
                    <select name="role_id" class="form-control" placeholder="Ketik disini">
                        <option '; if($data['role_id']==''){echo'selected';} echo' value="">Pilih Role Akses---</option>
                        <option '; if($data['role_id']==2){echo'selected';} echo' value="2">LOKET</option>
                        <option '; if($data['role_id']==3){echo'selected';} echo' value="3">OFFICER</option>
                        <option '; if($data['role_id']==4){echo'selected';} echo' value="4">SPV</option>
                        <option '; if($data['role_id']==5){echo'selected';} echo' value="5">SPT</option>
                        <option '; if($data['role_id']==6){echo'selected';} echo' value="6">MANAGER</option>
                    </select>
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
        if (trim($request->username) == '') {$error[] = '- Masukan Username';}
        if (trim($request->name) == '') {$error[] = '- Masukan Nama Pengguna';}
        if (trim($request->initial) == '') {$error[] = '- Masukan Nama Panggilan Max 10 Karakter';}
        if (trim($request->email) == '') {$error[] = '- Masukan Email Pengguna';}
        if (trim($request->role_id) == '') {$error[] = '- Pilih Akses Role';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=User::where('username',$request->username)->orWhere('email',$request->email)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:red;color:#fff;font-size:12px"><b>Error</b><br />-NIK atau Email Sudah terdaftar</p>';
            }else{
                $data           = New User;
                $data->username   = $request->username;
                $data->name   = $request->name;
                $data->initial   = $request->initial;
                $data->email   = $request->email;
                $data->role_id   = $request->role_id;
                $data->password   = Hash::make($request->username);
                $data->save();
                if($data){
                    echo'ok';
                }
                 
            }
        }
    }
    

    public function simpan_ubah(request $request){
        if (trim($request->name) == '') {$error[] = '- Masukan Nama Pengguna';}
        if (trim($request->email) == '') {$error[] = '- Masukan Email Pengguna';}
        if (trim($request->initial) == '') {$error[] = '- Masukan Nama Panggilan Max 10 Karakter';}
        if (trim($request->role_id) == '') {$error[] = '- Pilih Akses Role';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
            
                $data           = User::find($request->id);
                $data->name   = $request->name;
                $data->initial   = $request->initial;
                $data->email   = $request->email;
                $data->role_id   = $request->role_id;
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
                $cek=User::where('id',$_POST['id'][$x])->delete();
                
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan dihapus</p>';
        }

    }

    
}
