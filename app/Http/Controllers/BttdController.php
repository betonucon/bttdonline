<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendor;
use App\Traking;
use App\Struk;
use App\Bttd;
use App\Bank;
use App\Tagihan;
use PDF;
use App\Detailtagihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class BttdController extends Controller
{
    public function index(request $request){
        if(Auth::user()['role_id']==7){
            $menu='Daftar BTTD';
            $menu_detail=name();
            $data=Bttd::with(['vendor','rolenya'])->where('sts',1)->where('LIFNR',Auth::user()['username'])->orderBy('id','Desc')->paginate(20);
            return view('bttd.index',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
        
       
    }
    public function view_traking(request $request){
        $data=Bttd::where('Reference',$request->inv)->orWhere('HeaderText',$request->inv)->first();
        $count=Bttd::where('Reference',$request->inv)->orWhere('HeaderText',$request->inv)->count();
        $get=Traking::with(['user'])->where('bttd_id',$data['id'])->orderBy('id','Desc')->get();
        if($count>0){
            echo'
                <h4>Traking Dokumen</h4>
                <table class="table m-b-0">
                    <thead>
                        <tr>
                            <th>Petugas</th>
                            <th>Role</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($get as $no=>$o){
                        echo'
                        <tr>
                            <td>==> '.$o['user']['name'].'</td>
                            <td>'.$o->user->role['name'].'</td>
                            <td>'.$o['tanggal'].'</td>
                        </tr>';

                    }
                    echo'
                    
                        
                    </tbody>
                </table>

            ';
        }else{
            echo'
            <div class="alert alert-success fade show m-b-0">
                <span class="close" data-dismiss="alert">×</span>
                <strong>Ops</strong>
                Nomor Invoice / Faktur Tidak Terdaftar
            </div>
            ';
        }
    }
    public function index_dikembalikan(request $request){
        $menu='Daftar BTTD dikembalikan';
        $menu_detail=name();
        if(Auth::user()['role_id']==7){
            $data=Bttd::with(['vendor','rolenya'])->where('sts',2)->where('LIFNR',Auth::user()['username'])->orderBy('id','Desc')->paginate(20);
        }
        else{
            $data=Bttd::with(['vendor','rolenya'])->where('sts',2)->orderBy('id','Desc')->paginate(20);
        }
        
        return view('bttd.index_dikembalikan',compact('menu','menu_detail','data'));
       
    }
    public function index_cari(request $request){
        $menu='Traking BTTD';
        $menu_detail=name();
        if($request->inv==''){
            $inv='';
        }else{
            $inv=$request->inv;
        }
        
        return view('bttd.index_cari',compact('menu','menu_detail','inv'));
       
    }
    public function index_loket(request $request){
        if(Auth::user()['role_id']==2){
            $menu='Daftar BTTD';
            $menu_detail=name();
            $data=Bttd::with(['vendor','rolenya'])->where('sts',1)->where('lokasi',7)->orderBy('lokasi','Desc')->paginate(20);
            return view('bttd.index_loket',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
        
       
    }
    public function nilai(request $request){
        echo number_format($request->a,0);
    }
    
    public function index_officer(request $request){
        if(Auth::user()['role_id']==3){
            $menu='Daftar BTTD';
            $menu_detail=name();
            $data=Bttd::with(['vendor','rolenya'])->where('sts_officer',0)->where('lokasi',3)->orderBy('lokasi','Desc')->paginate(20);
            return view('bttd.index_officer',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
        
       
    }

    public function cari_nama_bank(request $request){
        
        $data=Bank::where('norek',$request->norek)->first();
        echo $data['nmbank'];   
       
    }
    public function index_officer_terima(request $request){
        if(Auth::user()['role_id']==3){
            $menu='Daftar BTTD Officer';
            $menu_detail=name();
            $data=Bttd::with(['vendor','rolenya'])->where('sts_officer',1)->where('lokasi',3)->orderBy('sts_sap','Asc')->paginate(20);
            return view('bttd.index_officer_terima',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
        
       
    }
    public function index_loket_terima(request $request){
        if(Auth::user()['role_id']==2){
            $menu='Daftar BTTD Diterima';
            $menu_detail=name();
            $data=Bttd::with(['vendor','rolenya'])->where('lokasi',2)->orderBy('lokasi','Desc')->paginate(20);
            return view('bttd.index_loket_terima',compact('menu','menu_detail','data'));
        }else{
            return view('error');
        }
        
        
       
    }
    public function buat(request $request){
        if(Auth::user()['role_id']==7){
            $menu='Buat BTTD';
            $menu_detail=name();
            if($request->kategori=='nonfaktur'){
                $kategori='nonfaktur';
            }else{
                $kategori='faktur';
            }
            return view('bttd.buat',compact('menu','menu_detail','kategori'));
        }else{
            return view('error');
        }
        
        
       
    }
    public function ubah(request $request){
        if(Auth::user()['role_id']==7){
            $menu='Ubah BTTD';
            $menu_detail=name();
            if($request->kategori=='2'){
                $kategori='nonfaktur';
            }else{
                $kategori='faktur';
            }
            $cek=Bttd::where('id',$request->id)->where('lokasi',7)->where('LIFNR',Auth::user()['username'])->where('kategori',$request->kategori)->count();
            if($cek>0){
                $data=Bttd::with(['vendor'])->where('LIFNR',Auth::user()['username'])->where('id',$request->id)->where('lokasi',7)->where('kategori',$request->kategori)->first();
                return view('bttd.ubah',compact('menu','menu_detail','kategori','data'));
            }else{
                return redirect('bttd');
            }
        }else{
            return view('error');
        }
        
            
       
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
    
    public function tagihan(request $request){
        $data=Detailtagihan::where('tagihan_id',$request->id)->get();
        echo'
            <style>

                .tth{
                    background:aqua;
                    color:#000;
                    padding:1%;
                }
                .ttd{
                    background:#fff;
                    color:#000;
                    padding:1%;
                }
            </style>
            <table width="100%" border="1" style="margin:1%">
                <tr>
                    <th class="tth" width="5%">No</th>
                    <th class="tth">Nama Tagihan</th>
                </tr>';
            foreach($data as $no=>$o){
                echo'
                    <tr>
                        <td class="ttd">'.($no+1).'</td>
                        <td class="ttd">'.$o['name'].'</td>
                    </tr>
                ';
            }
        echo'
         </table>
        ';

    }
    public function Lama_simpan(request $request){
        
            $image = $request->file('file');
            $imageFileName =$request->Reference.'.'. $image->getClientOriginalExtension();
            $filePath =$imageFileName;
            $file = \Storage::disk('google');
            
            
            
            if($file->put($filePath, file_get_contents($image))){
                    echo linkdrive($imageFileName);
                
            }else{
                echo'Gagal';
            }
        
    }
    
    public function simpan(request $request){
        if (trim($request->InvoiceDate) == '') {$error[] = '- Masukan Tanggal Faktur Pajak/Invoice';}
        if (trim($request->Reference) == '') {$error[] = '- Masukan No Faktur Pajak';}
        if (trim($request->Amount) == '') {$error[] = '- Masukan Nilai  Invoice';}
        if (trim($request->AmountInvoice) == '') {$error[] = '- Masukan Nilai Faktur';}
        if (trim($request->PurchaseOrder) == '') {$error[] = '- Masukan Nomor PO';}
        if (trim($request->PartBank) == '') {$error[] = '- Pilih Nomor Rekening';}
        if (trim($request->HeaderText) == '') {$error[] = '- Masukan No Invoice';}
        if (trim($request->DocCurrency) == '') {$error[] = '- Pilih Mata Yang';}
        if (trim($request->InvoiceDate) == '') {$error[] = '- Masukan Tanggal Faktur/Invoice';}
        if (trim($request->nama_bank) == '') {$error[] = '- Masukan Nama BANK';}
        if (trim($request->tagihan_id) == '') {$error[] = '- Pilih Jenis Tagihan';}
        if (trim($request->email) == '') {$error[] = '- Masukan Nomor Telepon/Handphone';}
        if (trim($request->file) == '') {$error[] = '- Upload dokumen tagihan';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=Bttd::where('HeaderText',$request->HeaderText)->orWhere('Reference',$request->Reference)->count();
            $cekstruk=Struk::where('Reference',$request->Reference)->count();
            if($cek>0){
                echo '<p style="padding:5px;background:red;color:#fff;font-size:12px"><b>Error</b><br />-No Faktur Pajak atau Invoice Sudah terdaftar</p>';
            }else{
                if($cekstruk>0){
                    $image = $request->file('file');
                    $size = $image->getSize();
                    $imageFileName =$request->Reference.'.'. $image->getClientOriginalExtension();
                    $filePath =$imageFileName;
                    $file = \Storage::disk('public_uploads');
                    
                    
                    if($image->getClientOriginalExtension()=='pdf' && $size<'554881'){
                        if($file->put($filePath, file_get_contents($image))){
                            $data           = New Bttd;
                            $data->LIFNR   = Auth::user()['username']; 
                            $data->Reference   = $request->Reference;
                            $data->Amount   = $request->Amount;
                            $data->AmountInvoice   = $request->AmountInvoice;
                            $data->PurchaseOrder   = $request->PurchaseOrder;
                            $data->PartBank   = $request->PartBank;
                            $data->kategori   = $request->kategori;
                            $data->HeaderText   = $request->HeaderText;
                            $data->DocCurrency   = $request->DocCurrency;
                            $data->InvoiceDate   = date('Y-m-d',strtotime($request->InvoiceDate));
                            $data->nama_bank   = $request->nama_bank;
                            $data->tagihan_id   = $request->tagihan_id;
                            $data->no_tlp   = $request->email;
                            $data->email   = email_vendor();
                            $data->lokasi   = 7;
                            $data->sts   = 1;
                            $data->linknya   = $imageFileName;
                            $data->file   = $imageFileName;
                            
                            $data->save();
                            if($data){
                                echo'ok';
                            }
                        }else{

                        }
                    }else{
                        echo '<p style="padding:5px;background:red;color:#fff;font-size:12px"><b>Error</b><br />-Format file harus .pdf | Ukuran file Maximal 500kb</p>';
                    }
                }else{
                    echo '<p style="padding:5px;background:red;color:#fff;font-size:12px"><b>Error</b><br />-Isi nilai Struk</p>';
                } 
            }
        }
    }
    

    public function simpan_voucher(request $request){
        if (trim($request->no_voucher) == '') {$error[] = '- Isi Nomor Voucher';}
        if (trim($request->tempo) == '') {$error[] = '- Isi tempo';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
                $data           = Bttd::find($request->bttd_id);
                $data->no_voucher   = $request->no_voucher; 
                $data->tempo   = $request->tempo; 
                $data->sts_sap   = 1; 
                $data->save();

                if($data){
                    echo'ok';
                }
        }
    }
    public function simpan_ubah(request $request){
        if (trim($request->InvoiceDate) == '') {$error[] = '- Masukan Tanggal Faktur Pajak/Invoice';}
        if (trim($request->Reference) == '') {$error[] = '- Masukan No Faktur Pajak';}
        if (trim($request->Amount) == '') {$error[] = '- Masukan Nilai  Invoice';}
        if (trim($request->AmountInvoice) == '') {$error[] = '- Masukan Nilai Faktur';}
        if (trim($request->PurchaseOrder) == '') {$error[] = '- Masukan Nomor PO';}
        if (trim($request->PartBank) == '') {$error[] = '- Pilih Nomor Rekening';}
        if (trim($request->HeaderText) == '') {$error[] = '- Masukan No Invoice';}
        if (trim($request->DocCurrency) == '') {$error[] = '- Pilih Mata Yang';}
        if (trim($request->InvoiceDate) == '') {$error[] = '- Masukan Tanggal Faktur/Invoice';}
        if (trim($request->nama_bank) == '') {$error[] = '- Masukan Nama BANK';}
        if (trim($request->tagihan_id) == '') {$error[] = '- Pilih Jenis Tagihan';}
        if (trim($request->email) == '') {$error[] = '- Masukan Nomor Telepon/Handphone';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            if($request->file==''){
                $data           = Bttd::find($request->id);
                $data->LIFNR   = Auth::user()['username']; 
                $data->InvoiceDate   = date('Y-m-d',strtotime($request->InvoiceDate));
                $data->Reference   = $request->Reference;
                $data->Amount   = $request->Amount;
                $data->AmountInvoice   = $request->AmountInvoice;
                $data->PurchaseOrder   = $request->PurchaseOrder;
                $data->PartBank   = $request->PartBank;
                $data->kategori   = $request->kategori;
                $data->HeaderText   = $request->HeaderText;
                $data->DocCurrency   = $request->DocCurrency;
                $data->nama_bank   = $request->nama_bank;
                $data->tagihan_id   = $request->tagihan_id;
                $data->no_tlp   = $request->email;
                $data->email   = email_vendor();
                $data->sts   = 1;
                $data->save();
                if($data){
                    echo'ok';
                }
            }else{
                    $image = $request->file('file');
                    $imageFileName =$request->Reference.'.'. $image->getClientOriginalExtension();
                    $filePath =$imageFileName;
                    $file = \Storage::disk('public_uploads');
                    
                    $size = $image->getSize();
                    if($image->getClientOriginalExtension()=='pdf' && $size<'554881'){
                    
                        // echo hapuslinkdrive($imageFileName);
                        if(hapuslinkdrive($imageFileName)){
                            if($file->put($filePath, file_get_contents($image))){
                                $data           = Bttd::find($request->id);
                                $data->LIFNR   = Auth::user()['username']; 
                                $data->Reference   = $request->Reference;
                                $data->Amount   = $request->Amount;
                                $data->AmountInvoice   = $request->AmountInvoice;
                                $data->PurchaseOrder   = $request->PurchaseOrder;
                                $data->PartBank   = $request->PartBank;
                                $data->kategori   = $request->kategori;
                                $data->HeaderText   = $request->HeaderText;
                                $data->DocCurrency   = $request->DocCurrency;
                                $data->InvoiceDate   = date('Y-m-d',strtotime($request->InvoiceDate));
                                $data->nama_bank   = $request->nama_bank;
                                $data->tagihan_id   = $request->tagihan_id;
                                $data->no_tlp   = $request->email;
                                $data->email   = email_vendor();
                                $data->linknya   = $imageFileName;
                                $data->file   = $imageFileName;
                                $data->sts   = 1;
                                $data->save();
                                if($data){
                                    echo'ok';
                                }
                            }else{
                                echo'Gagal';
                            }
                        }else{
                            echo'Gagal Hapus';
                        }
                    }else{
                        echo '<p style="padding:5px;background:red;color:#fff;font-size:12px"><b>Error</b><br />-Format file harus .pdf | Ukuran file Maximal 500kb</p>';
                    }
            }    
            
        }
    }

    

    public function simpan_revisi(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            
            for($x=0;$x<$jum;$x++){
                $data       =Bttd::find($_POST['id'][$x]);
                $data->sts  =2;
                $data->keterangan =$request->keterangan;
                $data->save();
                
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan direvisi</p>';
        }

    }
    public function simpan_terima(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            for($x=0;$x<$jum;$x++){
                $data       =Bttd::where('id',$_POST['id'][$x])->where('lokasi','!=',Auth::user()['role_id'])->first();
                $data->lokasi  =Auth::user()['role_id'];
                $data->diterima  =date('Y-m-d');
                $data->save();

                $trak       = New Traking;
                $trak->role_id  =Auth::user()['role_id'];
                $trak->username  =Auth::user()['username'];
                $trak->bttd_id  =$_POST['id'][$x];
                $trak->tanggal  =date('Y-m-d');
                $trak->save();

                
            }
            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan diterima</p>';
        }

    }
    public function simpan_kirim(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            for($x=0;$x<$jum;$x++){
                $data       =Bttd::where('id',$_POST['id'][$x])->first();
                $data->lokasi  =3;
                $data->sts_officer  =0;
                $data->diterima  =date('Y-m-d');
                $data->save();

                

                
            }
            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan kirim</p>';
        }

    }
    public function struk(request $request){
        // $data=Bttd::where('Reference',$request->Reference)->first();
        echo'
            <style>
                th{
                  padding:5px;
                }
                .contrl{
                    padding: 3px;
                    height: 25px;
                }
            </style>

        ';
        if($request->tagihan_id==''){
           
            echo '
                

            ';
            
        }else{
            $jumnilai=Struk::where('Reference',$request->Reference)->count();

             if($jumnilai>0){
                echo '
                <div class="form-group">
                    <label>Denda</label>
                    <input type="number" class="form-control" value="'.datastruk($request->Reference)['denda'].'" name="denda">
                    <label>Tarif PPH</label>
                    <select class="form-control contrl" name="tarif">
                        <option value="0"'; if(datastruk($request->Reference)['tarif']==0){echo'selected';} echo'>0%</option>
                        <option value="1.5"'; if(datastruk($request->Reference)['tarif']=='1.5'){echo'selected';} echo'>1.5%</option>
                        <option value="2"'; if(datastruk($request->Reference)['tarif']==2){echo'selected';} echo'>2%</option>
                        <option value="3"'; if(datastruk($request->Reference)['tarif']==3){echo'selected';} echo'>3%</option>
                        <option value="4"'; if(datastruk($request->Reference)['tarif']==4){echo'selected';} echo'>4%</option>
                        <option value="6"'; if(datastruk($request->Reference)['tarif']==6){echo'selected';} echo'>6%</option>
                    </select>';
                    if(cek_struknya($request->tagihan_id)==3){
                        echo'
                        <label>Denda</label>
                        <input type="number" class="form-control" value="'.datastruk($request->Reference)['um'].'" name="um">';
                        
                    }else{
                        echo'
                        <input type="hidden" class="form-control" value="0" name="um">';
                    }
                }else{
                    echo '
                    <div class="form-group">
                        <label>Denda</label>
                        <input type="number" class="form-control" value="" name="denda">
                        <label>Tarif PPH</label>
                        <select class="form-control contrl" name="tarif">
                            <option value="0">0%</option>
                            <option value="1.5">1.5%</option>
                            <option value="2">2%</option>
                            <option value="4">4%</option>
                            <option value="6">6%</option>
                        </select>';
                        if(cek_struknya($request->tagihan_id)==3){
                            echo'
                            <label>Denda</label>
                            <input type="number" class="form-control" value="" name="um">';
                            
                        }else{
                            echo'
                            <input type="hidden" class="form-control" value="0" name="um">';
                        }
                }
                echo'
                </div>
                <table width="100%">
                    <tr>
                        <th  class="th" width="5%">NO</th>
                        <th  class="th" width="15%">Discount</th>
                        <th  class="th" width="15%">Qty</th>
                        <th  class="th" width="35%">Harga Satuan</th>
                        <th  class="th" >Jumlah</th>
                    </tr>
                </table>
                <div style="overflow-y:scroll;height:400px">
                <table width="100%">';
                    for($x=1;$x<50;$x++){

                        $cek=Struk::where('Reference',$request->Reference)->where('urut',$x)->count();
                        $struk=Struk::where('Reference',$request->Reference)->where('urut',$x)->first();
                        if($cek>0){
                            $discount=$struk['discount'];
                            $qty=$struk['qty'];
                            $harga_satuan=$struk['harga_satuan'];
                            $total_harga=$struk['total_harga'];
                        }else{
                            $discount=0;
                            $qty=0;
                            $harga_satuan=0;
                            $total_harga=0;
                        }
                        echo'
                            <tr>
                                <td width="5%" class="ttdstruk" style="vertical-align:top"><input type="hidden" class="form-control contrl"  value="'.$x.'" name="urut[]">'.$x.'</td>
                                <td width="15%" class="ttdstruk"><input type="number" class="form-control contrl"  value="'.$discount.'" name="discount[]" onkeyup="cek_discount('.$x.',this.value)" id="discount'.$x.'"><label style="color:#585858;padding-left:1%" id="discountnilai'.$x.'">'.number_format($discount,0).'</label></td>
                                <td width="15%" class="ttdstruk" style="vertical-align: top;"><input type="number" class="form-control contrl"  value="'.$qty.'" name="qty[]" onkeyup="cek_qty('.$x.',this.value)" id="qty'.$x.'"><label style="color:#585858;padding-left:1%" id="qtynilai'.$x.'"></label></td>
                                <td width="35%" class="ttdstruk"><input type="number" class="form-control contrl"  value="'.$harga_satuan.'" name="harga_satuan[]" onkeyup="hitung_total_harga('.$x.',this.value)" id="harga_satuan'.$x.'"><label style="color:#585858;padding-left:1%" id="harga_satuannilai'.$x.'">'.number_format($harga_satuan,0).'</label></td>
                                <td class="ttdstruk"><input type="number" readonly class="form-control contrl"  value="'.$total_harga.'" name="total_harga[]" id="total_harga'.$x.'"><label style="color:#585858;padding-left:1%" id="total_harganilai'.$x.'">'.number_format($total_harga,0).'</label></td>
                            </tr>

                        ';
                    }
                    echo'
                </table>
                </div>
                <style>
                    .th{
                        background: #7a7a86 !important;
                        padding: 1%;
                        color: #fff !important;
                    }
                    .ttdstruk{
                        border-bottom: solid 1px #d8d8e6;
                        padding:2px;
                        background: #efefe1 !important;
                    }
                </style>

            ';
        }
        echo '

        <script>
            function cek_discount(a,nilai){
                $("#total_harga"+a).val(0);
                $("#harga_satuan"+a).val(0);
                $("#harga_satuannilai"+a).html(0);
                $.ajax({
                    type: "GET",
                    url: "'.url('bttd/nilai').'",
                    data: "a="+nilai,
                    success: function(msg){
                        $("#discountnilai"+a).html(msg);
                        
                    }
                }); 
                
            }
            function cek_qty(a,nilai){
                $("#total_harga"+a).val(0);
                $("#harga_satuan"+a).val(0);
                $("#harga_satuannilai"+a).html(0);
                $("#qtynilai"+a).html(nilai);
            }
            function hitung_total_harga(a,nilai){
                var discount=$("#discount"+a).val();
                var qty=$("#qty"+a).val();
                var total_harga=(parseInt(qty)*parseInt(nilai))-parseInt(discount);
                    $("#total_harga"+a).val(total_harga);
                    $.ajax({
                        type: "GET",
                        url: "'.url('bttd/nilai').'",
                        data: "a="+nilai,
                        success: function(msg){
                            $("#harga_satuannilai"+a).html(msg);
                            
                        }
                    }); 
                    $.ajax({
                        type: "GET",
                        url: "'.url('bttd/nilai').'",
                        data: "a="+total_harga,
                        success: function(msg){
                            $("#total_harganilai"+a).html(msg);
                            
                        }
                    }); 
            }
        </script>
    ';   
    }
    public function proses_cetak(request $request){
        echo'
        <iframe src="'.url('bttd/cetak?id='.$request->id).'" width="100%" height="500px">
        </iframe>
        ';
    }
    public function cetak(request $request){
        $data=Bttd::with(['vendor'])->where('id',$request->id)->first();
        $pdf = PDF::loadView('pdf.cetak', compact('data'));
        $pdf->setPaper('A4', 'Potrait');
        return $pdf->stream();
    }
    public function hapus(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            
            for($x=0;$x<$jum;$x++){
                $cek=Bttd::where('id',$_POST['id'][$x])->where('lokasi',7)->delete();
                
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan dihapus</p>';
        }

    }
    public function simpan_struk(request $request){
        if (trim($request->Reference) == '') {$error[] = '- Masukan nomor Faktur / Invoice';}
        if (isset($error)) {echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            error_reporting(0);
            $jum=count($request->urut);
            $cek=Bttd::where('Reference',$request->Reference)->count();
            if($cek>0){
                if($request->act=='ubah'){
                    $hapus=Struk::where('Reference',$request->Reference)->delete();
               

                    for($x=0;$x<$jum;$x++){
                        if($_POST['harga_satuan'][$x]>0){

                            $data       =New Struk;
                            $data->discount  =$_POST['discount'][$x];
                            $data->urut  =$_POST['urut'][$x];
                            $data->qty  =$_POST['qty'][$x];
                            $data->harga_satuan  =$_POST['harga_satuan'][$x];
                            $data->total_harga  =$_POST['total_harga'][$x];
                            $data->Reference =$request->Reference;
                            $data->denda =$request->denda;
                            $data->tarif =$request->tarif;
                            $data->save();
                        }
                        
                    }

                    echo'ok';
                }else{
                    echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br /> Nomor Faktur atau Invoice sudah terdaftar</p>';
                }
                
            }else{
                $hapus=Struk::where('Reference',$request->Reference)->delete();
               

                    for($x=0;$x<$jum;$x++){
                        if($_POST['harga_satuan'][$x]>0){

                            $data       =New Struk;
                            $data->discount  =$_POST['discount'][$x];
                            $data->urut  =$_POST['urut'][$x];
                            $data->qty  =$_POST['qty'][$x];
                            $data->harga_satuan  =$_POST['harga_satuan'][$x];
                            $data->total_harga  =$_POST['total_harga'][$x];
                            $data->Reference =$request->Reference;
                            $data->denda =$request->denda;
                            $data->tarif =$request->tarif;
                            $data->save();
                        }
                        
                    }

                    echo'ok';
            }  
            
        }
    }
    public function terima_officer(request $request){
        error_reporting(0);
        $jum=count($request->id);
        if($jum>0){
            
            for($x=0;$x<$jum;$x++){
                $data            =Bttd::find($_POST['id'][$x]);
                $data->sts_officer = 1;
                $data->save();

                $trak       = New Traking;
                $trak->role_id  =Auth::user()['role_id'];
                $trak->username  =Auth::user()['username'];
                $trak->bttd_id  =$_POST['id'][$x];
                $trak->tanggal  =date('Y-m-d');
                $trak->save();
                
            }

            echo'ok';
        }else{
            echo '<i class="fa fa-times-circle-o" style="font-size: 50px;"></i><br><br><p style="padding:5px;color:#000;font-size:15px"><b>Error</b>: <br />-Pilih Data Yang akan diproses</p>';
        }

    }

    
}
