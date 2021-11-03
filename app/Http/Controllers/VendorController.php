<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendor;
use App\Bank;
use App\Poling;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class VendorController extends Controller
{
    public function index(request $request){
        if(Auth::user()['role_id']==7){
            return view('error');
        }else{
            $menu='Daftar Vendor';
            $menu_detail=name();
            $cek=strlen($request->name);
            if($cek>0){
                $data=Vendor::where('name','LIKE','%'.$request->name.'%')->orWhere('LIFNR','LIKE','%'.$request->name.'%')->orderBy('name','Asc')->paginate(50);
            }else{
                $data=Vendor::orderBy('name','Asc')->paginate(20); 
            }
            return view('vendor.index',compact('menu','menu_detail','data'));
        }
        
        
       
    }
    
    public function bank(request $request){
        if(Auth::user()['role_id']==7){
            return view('error');
        }else{
            $menu='Rekening Vendor';
            $menu_detail=name();
            $cek=strlen($request->name);
            if($cek>0){
                $data=Bank::where('LIFNR','LIKE','%'.$request->name.'%')->where('matauang','!=','')->orderBy('LIFNR','Asc')->paginate(20);
            }else{
                $data=Bank::where('matauang','!=','')->orderBy('LIFNR','Asc')->paginate(20);
            }
            
            return view('vendor.bank',compact('menu','menu_detail','data'));
        }
        
       
       
    }
    public function ubah(request $request){
        $data = Vendor::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <input type="hidden" name="username" value="'.$data['nik'].'">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kode Vendor</label>
                    <input type="text" disabled class="form-control" value="'.$data['LIFNR'].'">
                </div>
                <div class="form-group">
                    <label>Nama Vendor</label>
                    <input type="text" name="name" class="form-control" value="'.$data['name'].'">
                </div>
                
                
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="'.$data['email'].'">
                </div>
                <div class="form-group">
                    <label>NPWP</label>
                    <input type="text" name="npwp" class="form-control" value="'.$data['npwp'].'">
                </div>
                
            </div>
        ';
    }
    public function ubah_bank(request $request){
        $data = Bank::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <div class="col-md-6">
                <fieldset>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Vendor </label>
                        <input type="text" name="LIFNR" class="form-control" value="'.$data['LIFNR'].'" placeholder="Ketik disini" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Bank</label>
                        <input type="text" name="bank_key" class="form-control" value="'.$data['bank_key'].'" placeholder="Ketik disini" />
                    </div>
                
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No Rekening </label>
                        <input type="text" name="norek" class="form-control" value="'.$data['norek'].'" placeholder="Ketik disini" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mata Uang </label>
                        <input type="text" name="matauang" class="form-control" value="'.$data['matauang'].'" placeholder="Ketik disini" />
                    </div>
                    
                </fieldset>
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
                    <th width="10%" >NIK</th>
                    <th width="10%" >BPJS</th>
                    <th width="20%" >Nama </th>
                    <th >Alamat</th>
                    <th width="20%" >TTGL</th>
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
        $cek=Pengguna::where('nik',$request->nik)->count();
        if($cek>0){
            $data=Pengguna::where('nik',$request->nik)->first();
            echo'ok@'.$data['nik'].'@'.$data['no_bpjs'].'@'.$data['name'].'@'.$data['alamat'];
        }else{
            echo'nol';
        }
        

    }
    public function simpan(request $request){
        if (trim($request->name) == '') {$error[] = '- Masukan Nama Vendor';}
        if (trim($request->email) == '') {$error[] = '- Masukan Email Vendor';}
        if (trim($request->npwp) == '') {$error[] = '- Masukan No NPWP';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $vendor=Vendor::where('id',$request->id)->first();
            $cek=Vendor::where('email',$request->email)->orWhere('npwp',$request->npwp)->count();
           
                $data           = Vendor::find($request->id);
                $data->name   = $request->name;
                $data->email   = $request->email;
                $data->npwp   = $request->npwp;
                $data->save();
                if($data){
                    $user           = User::where('username',$vendor['LIFNR'])->first();
                    $user->email   = $request->email;
                    $user->name   = $request->name;
                    $user->save();
                    echo'ok';
                }
                 
            
        }
    }
    public function reset_password(request $request){
        $data=User::where('username',$request->username)->where('role_id',7)->update([
            'password'=>Hash::make($request->username),
            'sts_password'=>null,
        ]);
        echo'ok';
    }

    public function simpan_bank(request $request){
        if (trim($request->LIFNR) == '') {$error[] = '- Masukan Kode Vendor';}
        if (trim($request->bank_key) == '') {$error[] = '- Masukan Nama Bank';}
        if (trim($request->norek) == '') {$error[] = '- Masukan Nomor Rekening';}
        if (trim($request->matauang) == '') {$error[] = '- Masukan Mata Uang';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data         = New Bank;
                $data->LIFNR   = $request->LIFNR;
                $data->bank_key   = $request->bank_key;
                $data->norek   = $request->norek;
                $data->matauang   = $request->matauang;
                $data->save();
                if($data){
                    
                    echo'ok';
                }
                 
            
        }
    }
    public function simpan_ubah_bank(request $request){
        if (trim($request->LIFNR) == '') {$error[] = '- Masukan Kode Vendor';}
        if (trim($request->bank_key) == '') {$error[] = '- Masukan Nama Bank';}
        if (trim($request->norek) == '') {$error[] = '- Masukan Nomor Rekening';}
        if (trim($request->matauang) == '') {$error[] = '- Masukan Mata Uang';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
                $data         = Bank::find($request->id);
                $data->LIFNR   = $request->LIFNR;
                $data->bank_key   = $request->bank_key;
                $data->norek   = $request->norek;
                $data->matauang   = $request->matauang;
                $data->save();
                if($data){
                    
                    echo'ok';
                }
                 
            
        }
    }
    

    public function simpan_ubah(request $request){
        if (trim($request->name) == '') {$error[] = '- Masukan Nama Vendor';}
        if (trim($request->email) == '') {$error[] = '- Masukan Email Vendor';}
        if (trim($request->npwp) == '') {$error[] = '- Masukan No NPWP';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $vendor=Vendor::where('id',$request->id)->first();
            
                $data           = Vendor::find($request->id);
                $data->name   = $request->name;
                $data->email   = $request->email;
                $data->npwp   = $request->npwp;
                $data->save();
                if($data){
                    $user           = User::where('username',$vendor['LIFNR'])->first();
                    $user->email   = $request->email;
                    $user->name   = $request->name;
                    $user->save();
                    echo'ok';
                }
                 
            
        }
    }
    public function simpan_npwp(request $request){
        if (trim($request->no_tlp) == '') {$error[] = '- Masukan No Telepon/Handphone';}
        if (trim($request->npwp) == '') {$error[] = '- Masukan No NPWP';}
        if (trim($request->pic) == '') {$error[] = '- Masukan Nama Penanggung Jawab';}
        if (trim($request->jabatan) == '') {$error[] = '- Masukan Nama Jabatan';}
        if (trim($request->email) == '') {$error[] = '- Masukan Email';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
            
                $data           = Vendor::where('LIFNR',Auth::user()['username'])->first();
                $data->npwp   = $request->npwp;
                $data->email   = $request->email;
                $data->no_tlp   = $request->no_tlp;
                $data->pic   = $request->pic;
                $data->jabatan   = $request->jabatan;
                $data->save();
                if($data){
                    echo'ok';
                }
                 
            
        }
    }
    public function simpan_ubah_vendor(request $request){
        if (trim($request->no_tlp) == '') {$error[] = '- Masukan No Telepon/Handphone';}
        if (trim($request->npwp) == '') {$error[] = '- Masukan No NPWP';}
        if (trim($request->pic) == '') {$error[] = '- Masukan Nama Penanggung Jawab';}
        if (trim($request->jabatan) == '') {$error[] = '- Masukan Nama Jabatan';}
        if (trim($request->email) == '') {$error[] = '- Masukan Email';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
            
                $data           = Vendor::where('LIFNR',Auth::user()['username'])->first();
                $data->npwp   = $request->npwp;
                $data->email   = $request->email;
                $data->no_tlp   = $request->no_tlp;
                $data->pic   = $request->pic;
                $data->jabatan   = $request->jabatan;
                $data->save();
                if($data){
                    echo'ok';
                }
                 
            
        }
    }
    public function poling(request $request){
        $data   = New Poling;
        $data->LIFNR =Auth::user()['username'];
        $data->tanggal =date('Y-m-d');
        $data->sts =$request->sts;
        $data->save();

        if($data){
            Auth::logout();
            return redirect('/');
        }
    }
    public function simpan_password(request $request){
        if (trim($request->password) == '') {$error[] = '- Masukan Password Baru';}
        if (trim($request->konfirmasi_password) == '') {$error[] = '- Masukan Konfirmasi Password';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            if($request->password==$request->konfirmasi_password){
                $data           = User::find(Auth::user()['id']);
                $data->password   = Hash::make($request->password);
                $data->sts_password   = 1;
                $data->save();
                if($data){
                    echo'ok';
                }
            }else{
                echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br /> Konfirmasi Password Salah</p>';
            }
            
                
                 
            
        }
    }

    

    public function hapus(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            
            for($x=0;$x<$jum;$x++){
                $cek=Vendor::where('id',$_POST['id'][$x])->first();
                $data=Vendor::where('id',$_POST['id'][$x])->delete();
                $useer=User::where('username',$cek['LIFNR'])->delete();
              
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan dihapus</p>';
        }

    }
    public function hapus_bank(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            
            for($x=0;$x<$jum;$x++){
                $data=Bank::where('id',$_POST['id'][$x])->delete();
              
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan dihapus</p>';
        }

    }

    
}
