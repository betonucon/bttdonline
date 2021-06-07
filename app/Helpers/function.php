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
function rolepengguna(){
   $data=App\Rolenya::where('id',Auth::user()['role_id'])->first();
   return $data['name'];
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