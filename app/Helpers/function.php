<?php

function name(){
    return ' BTTD Online PT Krakatau Steel';
}
function barcoderider($id,$w,$h){
   $d = new Milon\Barcode\DNS2D();
   $d->setStorPath(__DIR__.'/cache/');
   return $d->getBarcodeHTML($id, 'QRCODE',$w,$h);
}
function barcode($id){
   $d = new Milon\Barcode\DNS2D();
   $d->setStorPath(__DIR__.'/cache/');
   return $d->getBarcodePNGPath($id, 'PDF417');
}
function proses_upload($filename,$file){
   $documentFiles = Storage::disk('google')->files('\\');
   foreach ($documentFiles as $key => $documentFile){

      if ($key == 0) {
         $path = Storage::disk('google')->get($documentFile);
         $file_ftp = Storage::disk(‘google’)->put($documentFile, $path);
      }
   }
   
}

function linkdrive($filename){
   $dir = '/';
   $recursive = false; // Get subdirectories also?
   $contents = collect(Storage::cloud()->listContents($dir, $recursive));
   $file = $contents
       ->where('type', '=', 'file')
       ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
       ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
       ->first(); // there can be duplicate file names!
   return Storage::cloud()->url($file['path']);
}
function hapuslinkdrive($filename){
   $dir = '/';
   $recursive = false; // Get subdirectories also?
   $contents = collect(Storage::cloud()->listContents($dir, $recursive));
   $file = $contents
       ->where('type', '=', 'file')
       ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
       ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
       ->first(); // there can be duplicate file names!
   return Storage::cloud()->delete($file['path']);
}
function bulnya($id){
   if($id>9){
      $data=$id;
   }else{
      $data='0'.$id;
   }
   return $data;
}
function bulan($bulan)
{
   Switch ($bulan){
      case '01' : $bulan="Januari";
         Break;
      case '02' : $bulan="Februari";
         Break;
      case '03' : $bulan="Maret";
         Break;
      case '04' : $bulan="April";
         Break;
      case '05' : $bulan="Mei";
         Break;
      case '06' : $bulan="Juni";
         Break;
      case '07' : $bulan="Juli";
         Break;
      case '08' : $bulan="Agustus";
         Break;
      case '09' : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}

function cetak_pph(){
   
   $data=App\Cetakpph::with(['pph','vendor'])->where('LIFNR',Auth::user()['username'])->where('tanggal',date('Y-m-d'))->whereBetween('urut',[1,15])->get();
   
   return $data;
}
function cetak_ppn(){
   $data=App\Cetakppn::with(['ppn','vendor'])->where('LIFNR',Auth::user()['username'])->where('tanggal',date('Y-m-d'))->whereBetween('urut',[1,15])->get();
   
   return $data;
}
function cek_password(){
   $data=App\User::where('username',Auth::user()['username'])->where('sts_password',null)->count();
   
   return $data;
}
function tanggal($tanggal){
    $tgl=explode('-',$tanggal);
    $ttg=$tgl[2].' '.bulan($tgl['1']).' '.$tgl['0'];
    return $ttg;
}

function waktu($id){
    $data=date('d/m/Y',strtotime($id));
    return $data;
}
function uang($id){
    $data=number_format($id);
    return $data;
}
function npwp(){
   $data=App\Vendor::where('LIFNR',Auth::user()['username'])->first();
   return $data['npwp'];
}
function no_tlp(){
   $data=App\Vendor::where('LIFNR',Auth::user()['username'])->first();
   return $data['no_tlp'];
}
function pic(){
   $data=App\Vendor::where('LIFNR',Auth::user()['username'])->first();
   return $data['pic'];
}
function jabatan(){
   $data=App\Vendor::where('LIFNR',Auth::user()['username'])->first();
   return $data['jabatan'];
}
function email_vendor(){
   $data=App\Vendor::where('LIFNR',Auth::user()['username'])->first();
   return $data['email'];
}
function keuangan($bulan,$tahun){
   $data=App\Bttd::whereMonth('diterima',$bulan)->whereYear('diterima',$tahun)->sum('Amount');
   return $data;
}
function nilai_poling($bulan,$tahun,$sts){
   $data=App\Poling::whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->where('sts',$sts)->count();
   return $data;
}
function persen_nilai_poling($bulan,$tahun,$sts){
   $total=App\Poling::whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->count();
   $data=App\Poling::whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->where('sts',$sts)->count();
   if($total==0){
      $tot=1;
   }else{
      $tot=$total;
   }
   $per=100/$tot;
   $persen=$per*$data;
   return number_format($persen,1);
}
function total_tagihan_pertanggal($tanggal){
   $data=App\Bttd::where('diterima',$tanggal)->sum('Amount');
   return $data;
}
function total_dokumen_pertanggal($tanggal){
   $data=App\Bttd::where('diterima',$tanggal)->count();
   return $data;
}
function get_data_bttd($bulan,$tahun){
   $data=App\Bttd::select('diterima')->whereMonth('diterima',$bulan)->whereYear('diterima',$tahun)->groupBy('diterima')->get();
   return $data;
}
function keuangan_sap($bulan,$tahun){
   $data=App\Bttd::whereMonth('diterima',$bulan)->whereYear('diterima',$tahun)->where('sts_sap',1)->sum('Amount');
   return $data;
}
function dokumen($bulan,$tahun){
   $data=App\Bttd::whereMonth('diterima',$bulan)->whereYear('diterima',$tahun)->count('Amount');
   return $data;
}
function emailnya(){
   $data=App\Vendor::where('LIFNR',Auth::user()['username'])->first();
   return $data['email'];
}
function tgl($tgl){
   $data=date('d/m/y',strtotime($tgl));
   return $data;
}
function matauang(){
   $data=App\Matauang::orderBy('name','Asc')->get();
   return $data;
}
function tagihan(){
   $data=App\Tagihan::orderBy('name','Asc')->get();
   return $data;
}
function cek_tagihan($id){
   $data=App\Tagihan::where('id',$id)->first();
   $text='<font style="text-transform: capitalize !important;">'.$data['name'].'</font>';
   return $text;
}
function cek_struknya($id){
   $data=App\Tagihan::where('id',$id)->first();
   
   return $data['struknya'];
}
function materai($nilai){
   if($nilai>9000000){
      $data=10000;
   }else{
      $data=6000;
   }
   return $data;
}
function tgl_terima($id){
   $data=App\Traking::where('bttd_id',$id)->where('role_id',Auth::user()['role_id'])->first();
   
   return $data['tanggal'];
}
function struk_get($id){
   $data=App\Struk::where('Reference',$id)->orderBy('urut','Asc')->get();
   
   return $data;
}
function datastruk($id){
   $data=App\Struk::where('Reference',$id)->orderBy('urut','Asc')->firstorfail();
   
   return $data;
}
function detail_tagihan($id){
   $data=App\Detailtagihan::where('tagihan_id',$id)->where('name','!=','')->orderBy('id','Asc')->get();
   return $data;
}
function rolepengguna(){
   $data=App\Rolenya::where('id',Auth::user()['role_id'])->first();
   return $data['name'];
}
function cek_kategori_tagihan($id){
   if($id==1){
      $data='Barang dan Jasa';
   }
   if($id==2){
      $data='Transportir';
   }
   if($id==3){
      $data='Khusus';
   }
   if($id==''){
      $data='Belum ada';
   }
   return $data;
}
function total_dokumen(){
   $data=App\Bttd::where('LIFNR',Auth::user()['username'])->count();
   return $data;
}
function rekening_vendor(){
   $data=App\Bank::where('LIFNR',Auth::user()['username'])->get();
   return $data;
}

?>