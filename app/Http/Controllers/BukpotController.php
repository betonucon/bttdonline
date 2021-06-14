<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendor;
use App\Cetakpph;
use App\Cetakppn;
use App\Bank;
use App\Pph;
use App\Ppn;
use Session;
use PDF;
use App\Imports\PphImport;
use App\Imports\PpnImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
class BukpotController extends Controller
{
    public function index(request $request){
        if(Auth::user()['role_id']==2){
            $menu='Bukti Potong PPH';
            $menu_detail=name();
            $data=Pph::with(['vendor'])->orderBy('Docno','Asc')->paginate(20);
            return view('bukpot.pph',compact('menu','menu_detail','data'));
       
        }else{
            return view('error');
        }
        
        
    }
    public function index_vendor(request $request){
        if(Auth::user()['role_id']==7){
            $menu='Bukti Potong PPH';
            $menu_detail=name();
            $data=Pph::with(['vendor'])->where('LIFNR',Auth::user()['username'])->where('sts',0)->orderBy('Docno','Asc')->paginate(20);
            return view('bukpot.pph_vendor',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
    }
    public function index_vendor_ppn(request $request){
        if(Auth::user()['role_id']==7){
            $menu='Bukti Potong PPN';
            $menu_detail=name();
            $data=Ppn::with(['vendor'])->where('LIFNR',Auth::user()['username'])->where('sts',0)->orderBy('id','Asc')->paginate(20);
            return view('bukpot.ppn_vendor',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
       
    }
    public function index_terima(request $request){
        if(Auth::user()['role_id']==7){
            $menu='Cetak E-Cupon PPH';
            $menu_detail=name();
            $data=Pph::with(['vendor','cetak'])->where('LIFNR',Auth::user()['username'])->where('sts',1)->orderBy('sts_cetak','Asc')->paginate(20);
            return view('bukpot.pph_terima',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
    }
    public function index_pengambilan(request $request){
        if(Auth::user()['role_id']==2){
            $menu='Penyerahan E-Cupon PPH';
            $menu_detail=name();
            $data=Pph::with(['vendor','cetak'])->where('sts_cetak',1)->orderBy('sts','Asc')->paginate(20);
            return view('bukpot.pph_pengambilan',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
        
       
    }
    public function index_terima_ppn (request $request){
        if(Auth::user()['role_id']==7){
            $menu='Cetak E-Cupon PPN';
            $menu_detail=name();
            $data=Ppn::with(['vendor','cetak'])->where('LIFNR',Auth::user()['username'])->where('sts',1)->orderBy('sts_cetak','Asc')->paginate(20);
            return view('bukpot.ppn_terima',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
    }
    public function index_ppn(request $request){
        if(Auth::user()['role_id']==2){
            $menu='Bukti Potong PPN';
            $menu_detail=name();
            $data=Ppn::with(['vendor'])->orderBy('Docno','Asc')->paginate(20);
            return view('bukpot.ppn',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
        
       
    }
    public function index_pengambilan_ppn(request $request){
        if(Auth::user()['role_id']==2){
            $menu='Penyerahan E-Cupon PPN';
            $menu_detail=name();
            $data=Ppn::with(['vendor','cetak'])->where('sts_cetak',1)->orderBy('sts','Asc')->paginate(20);
            return view('bukpot.ppn_pengambilan',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
        
       
    }
    

    public function ubah(request $request){
        $data = User::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <input type="hidden" name="username" value="'.$data['nik'].'">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kode </label>
                    <input type="text" disabled class="form-control" value="'.$data['username'].'">
                </div>
                <div class="form-group">
                    <label>Nama </label>
                    <input type="text" name="name" class="form-control" value="'.$data['name'].'">
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
        error_reporting(0);

        if (trim($request->file) == '') {$error[] = '- Upload file terlebih dahulu';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
		
            $filess = $request->file('file');
            $nama_file = rand().$filess->getClientOriginalName();
            $filess->move('_file_excel',$nama_file);
            Excel::import(new PphImport, public_path('/_file_excel/'.$nama_file));
            echo'ok';
        }
    }
    public function simpan_ppn(request $request){
        error_reporting(0);

        if (trim($request->file) == '') {$error[] = '- Upload file terlebih dahulu';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
		
            $filess = $request->file('file');
            $nama_file = rand().$filess->getClientOriginalName();
            $filess->move('_file_excel',$nama_file);
            Excel::import(new PpnImport, public_path('/_file_excel/'.$nama_file));
            echo'ok';
        }
    }
    

    public function simpan_ubah(request $request){
        if (trim($request->name) == '') {$error[] = '- Masukan Nama Pengguna';}
        if (trim($request->email) == '') {$error[] = '- Masukan Email Pengguna';}
        if (trim($request->role_id) == '') {$error[] = '- Pilih Akses Role';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            
            
                $data           = User::find($request->id);
                $data->name   = $request->name;
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
                $cek=Pph::where('id',$_POST['id'][$x])->where('sts',0)->delete();
                
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan dihapus</p>';
        }

    }
    
    public function cetak(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum==0 || $jum>15){
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br /> -Pilih data yang akan dicetak maksimal 15 dokumen</p>';
            
                
        }else{
            $data=Cetakpph::where('LIFNR',Auth::user()['username'])->delete();
                
                for($x=0;$x<$jum;$x++){

                    
                    $pph            = Pph::find($_POST['id'][$x]);
                    $pph->sts_cetak    = 1;
                    $pph->tanggal_cetak  = date('Y-m-d');
                    $pph->save();

                    $buk            = New Cetakpph;
                    $buk->pph_id    = $_POST['id'][$x];
                    $buk->LIFNR     = Auth::user()['username'];
                    $buk->tanggal   = date('Y-m-d');
                    $buk->urut   = ($x+1);
                    $buk->save();
                }
                echo'ok';
        }
    }
    public function penyerahan(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum==0 || $jum>15){
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br /> -Pilih data yang akan diserahkan</p>';
            
                
        }else{
               
            for($x=0;$x<$jum;$x++){

                
                $pph            = Pph::find($_POST['id'][$x]);
                $pph->sts    = 2;
                $pph->tanggal_terima  = date('Y-m-d');
                $pph->save();

            }
            echo'ok';
        }
    }
    public function penyerahan_ppn(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum==0 || $jum>15){
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br /> -Pilih data yang akan diserahkan</p>';
            
                
        }else{
               
            for($x=0;$x<$jum;$x++){

                
                $pph            = Ppn::find($_POST['id'][$x]);
                $pph->sts    = 2;
                $pph->tanggal_terima  = date('Y-m-d');
                $pph->save();

            }
            echo'ok';
        }
    }
    public function cetak_ppn(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum==0 || $jum>15){
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br /> -Pilih data yang akan dicetak maksimal 15 dokumen</p>';
            
                
        }else{
            $data=Cetakppn::where('LIFNR',Auth::user()['username'])->delete();
                
                for($x=0;$x<$jum;$x++){

                    
                    $pph            = Ppn::find($_POST['id'][$x]);
                    $pph->sts_cetak    = 1;
                    $pph->tanggal_cetak  = date('Y-m-d');
                    $pph->save();

                    $buk            = New Cetakppn;
                    $buk->ppn_id    = $_POST['id'][$x];
                    $buk->LIFNR     = Auth::user()['username'];
                    $buk->tanggal   = date('Y-m-d');
                    $buk->urut   = ($x+1);
                    $buk->save();
                }
                echo'ok';
        }
    }
    public function tampil(request $request){
        error_reporting(0);
        $exp=explode(',',$request->id);
        $ju=Cetakpph::with(['pph','vendor'])->where('LIFNR',Auth::user()['username'])->where('tanggal',date('Y-m-d'))->count();
        $tot=ceil($ju/5);
        if($tot==0){
            $jum=1;
        }else{
            $jum=$tot;
        }
        $pdf = PDF::loadView('pdf.cetak_pph', compact('jum'));
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream();
        // return view('pdf.cetak_pph', compact('jum'));
        
    }
    public function tampil_ppn(request $request){
        error_reporting(0);
        $exp=explode(',',$request->id);
        $ju=Cetakppn::where('LIFNR',Auth::user()['username'])->where('tanggal',date('Y-m-d'))->count();
        $tot=ceil($ju/5);
        if($tot==0){
            $jum=1;
        }else{
            $jum=$tot;
        }
        $pdf = PDF::loadView('pdf.cetak_ppn', compact('jum'));
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream();
        // echo $tot;
        
    }
    public function terima(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
                if (trim($request->penerima) == '') {$error[] = '- Isi nama penerima';}
                if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
                else{
                    for($x=0;$x<$jum;$x++){
                        $data   =Pph::find($_POST['id'][$x]);
                        $data->penerima = $request->penerima;
                        $data->tgl_terima=date('Y-m-d');
                        $data->sts=1;
                        $data->save();
                        
                    }

                    echo'ok';
                }
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan diproses</p>';
        }

    }
    public function terima_ppn(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            if (trim($request->penerima) == '') {$error[] = '- Isi nama penerima';}
            if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
            else{
                for($x=0;$x<$jum;$x++){
                    $data   =Ppn::find($_POST['id'][$x]);
                    $data->penerima = $request->penerima;
                    $data->tgl_terima=date('Y-m-d');
                    $data->sts=1;
                    $data->save();
                    
                }

                echo'ok';
            }
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan diproses</p>';
        }

    }

    
}
